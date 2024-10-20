<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index()
    {
        // $users = User::all();
        $categories = Category::paginate(20);
        return view('admin.categories.index', ['menu' => 'categories', 'categories' => $categories]);
    }

    // Detalhes da categoria
    public function show (Category $category){
        
        // Carrega a view
        return view('admin.categories.show', ['menu' => 'categories', 'category' => $category]);
    }

    public function create()
    {
        return view('admin.categories.create', ['menu' => 'categories']);
    }

    public function store(CategoryRequest $request)
    {
        //  dd($request);
        
        // O trecho de linha abaixo faz a validação dos campos
         $request->validated();
 
         // Marcando o ponto inicial de uma transação
         DB::beginTransaction();
 
         try {
             // Cadastrando no banco de dados na tabela categories os valores dos campos
             $category = Category::create(['name' => $request->name, 'cadastrado_por' => Auth::id()]); // Pegando o id do novo registro cadastrado 
 
             // Criando log da operação
             Log::info('Categoria cadastrada.', ['id' => $category->id, $category]);
 
             // Operação concluída com sucesso
             DB::commit();
 
             // Redirecionar o usuário e envia a mensagem de sucesso
             return redirect()->route('category.index')->with('success', 'Categoria cadastrada com sucesso');
         } catch (Exception $e) {
 
             // Criando log da operação
             Log::warning('Categoria não cadastrada.', ['error' => $e->getMessage()]);
 
             // Operação não concluída
             DB::rollBack();
 
             // Redirecionar o usuário e envia a mensagem de erro
             return back()->withInput()->with('error', 'Categoria não cadastrada!');
         }
    }

    // Método para carregar o formulário editar Categoria
    public function edit(Category $category)
    {
        // Criando log da operação
        Log::info('Editar categoria.', ['id' => $category->id]);

        return view('admin.categories.edit', ['menu' => 'categories','category' => $category]);
    }

    // Método para registrar a alteração da categoria
    public function update(CategoryRequest $request, Category $category)
    {

        // O trecho de linha abaixo faz a validação dos campos
        $request->validated();

        // Marcando o ponto inicial de uma transação
        DB::beginTransaction();

        try{
            // Editando as informações do registro no banco de dados
            $category->update(['name' => $request->name]);

            // Criando log da operação
            Log::info('Categoria editada.', ['id' => $category->id]);

            // Operação concluída com sucesso
            DB::commit();

            // Redirecionar o usuário e envia a mensagem de sucesso
            return redirect()->route('category.show', ['category' => $request->category])->with('success', 'Categoria editada com sucesso!');

        } catch (Exception $e){

            // Criando log da operação
            Log::warning('Categoria não editada.', ['error' => $e->getMessage()]);

            // Operação não concluída
            DB::rollBack();

            // Redirecionar o usuário e envia a mensagem de erro
            return back()->withInput()->with('error', 'Categoria não editada!');
        
        
        }
    }



    // Método para apagar a categoria
    public function destroy(Category $category)
    {

        try {
            // Excluir o registro do banco de dados
            $category->delete(); 

            // Criando log da operação
            Log::info('Categoria excluída.', ['id' => $category->id, 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('category.index')->with('success', 'Categoria apagada com sucesso!');
        } catch (Exception $e) {
            
            // Criando log da operação
            Log::info('Categoria não apagada.', ['error' => $e->getMessage()]);
            
            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('category.index')->with('error', 'A categoria não foi excluída!');
        }
    }
}
