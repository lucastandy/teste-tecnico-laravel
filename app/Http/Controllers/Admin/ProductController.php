<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Products;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        // $users = User::all();
        $products = Products::paginate(10);
        return view('admin.products.index', ['menu' => 'products', 'products' => $products]);
    }

    // Detalhes do produto
    public function show(Products $product)
    {

        // Carrega a view
        return view('admin.products.show', ['menu' => 'products', 'product' => $product]);
    }

    public function create()
    {

        $categories = DB::table('categories')->get();

        return view('admin.products.create', ['menu' => 'products', 'categories' => $categories]);
    }

    public function store(ProductRequest $request)
    {
        // O trecho de linha abaixo faz a validação dos campos
        $request->validated();

        //  dd($request);

        // Marcando o ponto inicial de uma transação
        DB::beginTransaction();

        try {

            // Image Upload
            if ($request->hasFile('imagem_nova') && $request->file('imagem_nova')->isValid()) {

                $requestImage = $request->file('imagem_nova');

                $extension = $requestImage->getClientOriginalExtension();

                $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . '.' . $extension;

                $requestImage->move(public_path('img/products'), $imageName);
            }


            // Cadastrando no banco de dados na tabela products os valores dos campos
            $product = Products::create(['name' => $request->name, 'category_id' => $request->category_id, 'description' => $request->description, 'purchase_price' => str_replace(',', '.', str_replace('.', '', $request->purchase_price)), 'sale_price' => str_replace(',', '.', str_replace('.', '', $request->sale_price)), 'stock_quantity' => $request->stock_quantity, 'image_path' => $imageName, 'cadastrado_por' => Auth::id()]); // Pegando o id do novo registro cadastrado 

            // Criando log da operação
            Log::info('Produto cadastrado.', ['id' => $product->id, $product]);

            // Operação concluída com sucesso
            DB::commit();

            // Redirecionar o usuário e envia a mensagem de sucesso
            return redirect()->route('product.index')->with('success', 'Produto cadastrado com sucesso');
        } catch (Exception $e) {

            // Criando log da operação
            Log::warning('Produto não cadastrado.', ['error' => $e->getMessage()]);

            // Operação não concluída
            DB::rollBack();

            // Redirecionar o usuário e envia a mensagem de erro
            return back()->withInput()->with('error', 'Produto não cadastrado!');
        }
    }

    // Método para carregar o formulário editar produto
    public function edit(Products $product)
    {

        // Carregar as categorias
        $categories = DB::table('categories')->get();

        // Formtando os campos de precos
        $product->purchase_price = number_format($product->purchase_price, 2, ',', '.');
        $product->sale_price = number_format($product->sale_price, 2, ',', '.');

        // Criando log da operação
        Log::info('Editar produto.', ['id' => $product->id]);

        // Carregar a view
        return view('admin.products.edit', ['menu' => 'products', 'product' => $product, 'categories' => $categories]);
    }


    public function update(ProductRequest $request, Products $product)
    {

        // Pegando todos os campos do formulário
        $data = $request->all();
        // dd($data);
    
        // O trecho de linha abaixo faz a validação dos campos


        $request->validated();

        // Marcando o ponto inicial de uma transação
        DB::beginTransaction();

        try {

            // Consultando o nome da imagem no banco de dados
            $imageNameTable = $product->image_path;

            // dd("imagem na tabela: ", $imageNameTable, "imagem nova: ", $request->imagem_nova);

            // Verificando se o campo imagem antiga é diferente da imagem cadastrada no banco de dados
            if ($request->imagem_antiga == $imageNameTable && $request->imagem_nova == null) {

                $imageName = $request->imagem_antiga;

                
            }else{
                


                // Image Upload
                if ($request->hasFile('imagem_nova') && $request->file('imagem_nova')->isValid()) {

                    $requestImage = $request->file('imagem_nova');

                    $extension = $requestImage->getClientOriginalExtension();

                    $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . '.' . $extension;

                    $requestImage->move(public_path('img/products'), $imageName);
                }

                
            }

            // Editando as informações do registro no banco de dados
            $product->update(['name' => $request->name, 'category_id' => $request->category_id, 'description' => $request->description, 'purchase_price' => str_replace(',', '.', str_replace('.', '', $request->purchase_price)), 'sale_price' => str_replace(',', '.', str_replace('.', '', $request->sale_price)), 'stock_quantity' => $request->stock_quantity, 'image_path' => $imageName]);

            // Criando log da operação
            Log::info('Produto editado.', ['id' => $product->id]);

            // Operação concluída com sucesso
            DB::commit();

            // Redirecionar o usuário e envia a mensagem de sucesso
            return redirect()->route('product.show', ['product' => $request->product])->with('success', 'Produto editado com sucesso!');
        } catch (Exception $e) {

            // Criando log da operação
            Log::warning('Produto não editado.', ['error' => $e->getMessage()]);

            // Operação não concluída
            DB::rollBack();

            // Redirecionar o usuário e envia a mensagem de erro
            return back()->withInput()->with('error', 'Produto não editado!');
        }
    }

    // Método para apagar o produto
    public function destroy(Products $product)
    {

        try {
            // Excluir o registro do banco de dados
            $product->delete();

            // Criando log da operação
            Log::info('Produto excluído.', ['id' => $product->id, 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('product.index')->with('success', 'Produto apagado com sucesso!');
        } catch (Exception $e) {

            // Criando log da operação
            Log::info('Produto não apagado.', ['error' => $e->getMessage()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('product.index')->with('error', 'O produto não foi excluído!');
        }
    }
}
