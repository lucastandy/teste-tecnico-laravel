<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleCompletedRequest;
use App\Jobs\JobSendSaleEmail;
use App\Models\SaleCoupon;
use App\Models\SaleItems;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SaleCompletedController extends Controller
{
    public function store(Request $request)
    {       
        
    
        // dd($request->applied_code, $request->coupon_id_applied);
    

        // Mostrar os dados da requisição. Trazendo os itens da venda.
        // dd($request->all());

        // if ($request->coupon_id_applied == null) {
        //     $coupon_applied = 0;
        // }else{
        //     $coupon_applied = $request->coupon_id_applied;
        // }

        // dd($coupon_applied);



        // Fazer um loop dos itens venda subtraindo a quantidade vendida na tabela produtos e atualizando o estoque
        $items = SaleItems::where('code_sale', $request->code_sale)->get();

        // dd($items);

        // Marcando o ponto inicial de uma transação
        DB::beginTransaction();

        try {
            foreach ($items as $item) {
                DB::table('products')
                    ->where('id', $item->product_id)
                    ->update([
                        'stock_quantity' => DB::raw('stock_quantity - ' . $item->quantity),
                    ]);
            }
    
            // Atualiza o status da tabela sale_items para concluída
            DB::table('sale_items')
                ->where('code_sale', $request->code_sale)
                ->update([
                    'status' => 2,
                ]);
    
            // Atualiza o status da venda para concluída
            DB::table('sales')
                ->where('code_sale', $request->code_sale)
                ->update([
                    'status' => 2,
                    'total' => $request->total_venda - ($request->total_venda * $request->discount_value),
                    'discount' => $request->discount_value == null ? 0 : $request->discount_value,
                    'date'=> date('Y-m-d'),
                ]);
    
                // Cadastrar Sale com cupom
                SaleCoupon::create([
                    'code_sale' => $request->code_sale,
                    'coupon_id' => $request->coupon_id_applied == null ? 0 : $request->coupon_id_applied,
                ]);

                // Pegando o id da venda
                $sale_id = DB::table('sales')->where('code_sale', $request->code_sale)->first();

                // Agendar o envio do e-mail no job
                JobSendSaleEmail::dispatch($sale_id->id)->onQueue('default');

            // Criando log da operação
            Log::info('Processo venda encerrado com sucesso.', ['code_sale' => $request->code_sale, 'action_user_id' => Auth::id()]);
 
            // Operação concluída com sucesso
            DB::commit();

            // Redirecionar o usuário e envia a mensagem de sucesso
            return redirect()->route('sale.show', ['code_sale' => $request->code_sale])->with('success', 'Venda encerrada com sucesso');

        } catch (Exception $e) {

            // Criando log da operação
            Log::warning('Item não vendido.', ['error' => $e->getMessage()]);

            // Operação não concluída
            DB::rollBack();
            
        }

        


    }

   
}
