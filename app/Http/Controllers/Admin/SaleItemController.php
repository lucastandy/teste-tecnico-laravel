<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleItemsRequest;
use App\Models\Customers;
use App\Models\Sale;
use App\Models\SaleItems;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SaleItemController extends Controller
{
    public function index()
    {
        // $users = User::all();
        $sales_items = SaleItems::paginate(20);
        return view('admin.sales_items.index', ['menu' => 'sales_items', 'sales_items' => $sales_items]);
    }

    public function create($code_sale)
    {
        // Se não existir o código da venda em SaleItems, redirecionar para a tela inicial
        if (!SaleItems::where('code_sale', $code_sale)->exists()) {
            return redirect()->route('sale.index')->with('error', 'Venda inexistente ou sem itens!');
        }


        // Pegando os itens com base no código da venda
        $sale_items = SaleItems::where('code_sale', $code_sale)->get();

        // Calculando o valor total da venda. Preço unitario x quantidade
        $totalVenda = 0;
        foreach ($sale_items as $sale_item) {
            $totalVenda += $sale_item->unit_price * $sale_item->quantity;
        }

        // Pegando os dados da venda, pois aqui consigo pegar o nome do cliente
        $sale = Sale::where('code_sale', $code_sale)->first();

        // Pegando todos os registros da tabela customers
        $customers = Customers::all();

        // Pegando todos os registros da tabela products menos os que estão em aberto, na tabela sales_items
        $products = DB::table('products')->whereNotIn('id', $sale_items->pluck('product_id'))->get();

        // Pegando todos os registros da tabela coupons
        $coupons = DB::table('coupons')->get();

        // dd($coupons);

        return view('admin.sales_items.create', ['menu' => 'sales_items', 'customers' => $customers, 'products' => $products,'coupons' => $coupons, 'sale_items' => $sale_items,'sale' => $sale,'totalVenda' => $totalVenda]);
    }


    // Função para salvar os itens da venda
    public function store(SaleItemsRequest $request)
    {

        // Marcando o ponto inicial de uma transação
        DB::beginTransaction();
 
        try {

            // Cadastrando no banco de dados na tabela sale_items os valores dos campos
            $sale_items = SaleItems::create(['code_sale' => $request->code_sale, 'product_id' => $request->produto_id, 'quantity' => $request->qtd_desejada, 'unit_price' => $request->sale_price, 'status' => 1,'cadastrado_por' => Auth::id()]);
       

            // Criando log da operação
            Log::info('Venda Item cadastrada.', ['id' => $sale_items->id, $sale_items]);

            // Operação concluída com sucesso
            DB::commit();

            // Redirecionar o usuário e envia a mensagem de sucesso
           //  return redirect()->route('sale_item.create', ['code_sale' => $sale->code_sale])->with('success', 'Venda Iniciada com sucesso');

           return redirect()->route('sale_item.create', ['code_sale' => $request->code_sale])->with('success', 'Item Cadastrado com sucesso');
        } catch (Exception $e) {

            // Criando log da operação
            Log::warning('Item não cadastrado.', ['error' => $e->getMessage()]);

            // Operação não concluída
            DB::rollBack();

            // Redirecionar o usuário e envia a mensagem de erro
            return back()->withInput()->with('error', 'Item não cadastrado!');
        }
        
    }

    // Método para apagar o item da venda
    public function destroy($id)
    {
        // Consultando o código da venda
        $code_sale = DB::table('sale_items')->where('id', $id)->value('code_sale');

        // dd($code_sale);
    
        try {
            // Excluir o registro do banco de dados
            $item = SaleItems::find($id);
            $item->delete(); 

            // Criando log da operação
            Log::info('Item excluído.', ['id' => $item->id, 'action_user_id' => Auth::id()]);

            // Atualiza a página e envia a mensagem de sucesso
            return redirect()->route('sale_item.create', ['code_sale' => $code_sale])->with('success', 'Item apagado com sucesso!');
        } catch (Exception $e) {
            
            // Criando log da operação
            Log::info('Item não apagado.', ['error' => $e->getMessage()]);
            
            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('sale_item.create', ['code_sale' => $code_sale])->with('error', 'Item não foi apagado!');
        }
    }
}
