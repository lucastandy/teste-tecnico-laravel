<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRequest;
use App\Jobs\JobSendSaleEmail;
use App\Mail\SendSaleEmail;
use App\Models\Customers;
use App\Models\Sale;
use App\Models\SaleItems;
use Exception;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SaleController extends Controller
{
    public function index()
    {

        // Listar vendas onde o code_sale aparece em SaleItems
        $sales = Sale::select(
            'sales.id',
            'sales.code_sale',
            'sales.customer_id',
            'sales.cadastrado_por',
            'sales.date',
            'sales.total',
            'sales.status',
            'sales.discount'
        )
        ->join('sale_items', 'sales.code_sale', '=', 'sale_items.code_sale')
        ->whereNull('sale_items.deleted_at')
        ->groupBy(
            'sales.id',
            'sales.code_sale',
            'sales.customer_id',
            'sales.cadastrado_por',
            'sales.date',
            'sales.total',
            'sales.status',
            'sales.discount'
        )
        ->paginate(20);
       

        // $sales = Sale::paginate(20);
        // dd($sales->toArray());
        return view('admin.sales.index', ['menu' => 'sales', 'sales' => $sales]);
    }

    public function show($code_sale)
    {
        // dd($code_sale);
        $sale = Sale::where('code_sale', $code_sale)->first();
        // Pegando os itens com base no código da venda
        $sale_items = SaleItems::where('code_sale', $code_sale)->get();
        // dd($sale->toArray());
        return view('admin.sales.show', ['menu' => 'sales', 'sale' => $sale, 'sale_items' => $sale_items]);
    }

    public function create()
    {

        // Pegando todos os registros da tabela customers
        $customers = Customers::all();
        // Pegando todos os registros da tabela products
        $products = DB::table('products')->get();

        // dd($coupons);

        return view('admin.sales.create', ['menu' => 'sales', 'customers' => $customers, 'products' => $products]);
    }

    
    
    // Função para gerar um codigo aleatorio
    private function gerarCodigoAleatorio($tamanho = 10) {
        $caracteres = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $codigo = substr(str_shuffle($caracteres), 0, $tamanho);
        return $codigo;
        
    }
    public function store(SaleRequest $request)
    {
         // O trecho de linha abaixo faz a validação dos campos
         $request->validated();

        //  dd($request);
 
         // Marcando o ponto inicial de uma transação
         DB::beginTransaction();
 
         try {

            $codigo_gerado = $this->gerarCodigoAleatorio(10);

             // Cadastrando no banco de dados na tabela sales os valores dos campos
             $sale = Sale::create(['code_sale' => $codigo_gerado,'customer_id' => $request->customer_id, 'status' => 1,'cadastrado_por' => Auth::id()]); // Pegando o id do novo registro cadastrado

             // Cadastrando no banco de dados na tabela sale_items os valores dos campos
             $sale_items = SaleItems::create(['code_sale' => $sale->code_sale, 'product_id' => $request->produto_id, 'quantity' => $request->qtd_desejada, 'unit_price' => $request->sale_price, 'status' => 1,'cadastrado_por' => Auth::id()]);

            //  Pesquisar e-mail do cliente
            $customer = Customers::where('id', $request->customer_id)->first();

            //  Enviar e-mail para o cliente
            // Mail::to($customer->email)->send(new SendSaleEmail($sale));
            
            // Agendar o envio do e-mail no job
            // JobSendSaleEmail::dispatch($sale->id)->onQueue('default');

 
             // Criando log da operação
             Log::info('Venda cadastrada.', ['code_sale' => $sale->id, $sale]);
            //  Log::info('Venda Item cadastrada.', ['id' => $sale_items->id, $sale_items]);
 
             // Operação concluída com sucesso
             DB::commit();
 
             // Redirecionar o usuário e envia a mensagem de sucesso
            //  return redirect()->route('sale_item.create', ['code_sale' => $sale->code_sale])->with('success', 'Venda Iniciada com sucesso');

            return redirect()->route('sale_item.create', ['code_sale' => $codigo_gerado])->with('success', 'Venda Iniciada com sucesso');
         } catch (Exception $e) {
 
             // Criando log da operação
             Log::warning('Venda não cadastrada.', ['error' => $e->getMessage()]);
 
             // Operação não concluída
             DB::rollBack();
 
             // Redirecionar o usuário e envia a mensagem de erro
             return back()->withInput()->with('error', 'Venda não cadastrada!');
         }

        
    }

    // Método para apagar a venda
    public function destroy(Sale $sale)
    {

        try {
            // Excluir o registro do banco de dados
            $sale->delete();

            // Criando log da operação
            Log::info('Venda excluída.', ['id' => $sale->id, 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('sale.index')->with('success', 'Venda apagada com sucesso!');
        } catch (Exception $e) {

            // Criando log da operação
            Log::info('Venda não apagada.', ['error' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('sale.index')->with('error', 'A venda não foi excluída!');
        }
    }
}
