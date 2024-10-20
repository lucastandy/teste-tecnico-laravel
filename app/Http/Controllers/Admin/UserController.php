<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        // $users = User::all();
        $users = User::paginate(20);
        return view('admin.users.index', ['menu' => 'users', 'users' => $users]);
    }

    // Detalhes do usuário
    public function show (User $user){
        
        // Carrega a view
        return view('admin.users.show', ['menu' => 'users', 'user' => $user]);
    }

    public function create()
    {
        return view('admin.users.create', ['menu' => 'users']);
    }

    public function store(StoreUserRequest $request)
    {
        User::create($request->all());

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso');
    }

    // Método para carregar o formulário editar usuário
    public function edit(User $user)
    {

        // Criando log da operação
        Log::info('Editar usuário.', ['id' => $user->id]);

        // Carregar a view
        return view('admin.users.edit', ['menu' => 'users','user' => $user]);
    }

     // Método para registrar a alteração do usuário
     public function update(StoreUserRequest $request, User $user)
     {
 
         // O trecho de linha abaixo faz a validação dos campos
         $request->validated();
 
         // Marcando o ponto inicial de uma transação
         DB::beginTransaction();
 
         try{
             // Editando as informações do registro no banco de dados
             $user->update(['name' => $request->name,
             'email' => $request->email,
             ]);
 
 
             // Criando log da operação
             Log::info('Usuário editado.', ['id' => $user->id]);
 
             // Operação concluída com sucesso
             DB::commit();
 
             // Redirecionar o usuário e envia a mensagem de sucesso
             return redirect()->route('user.show', ['user' => $request->user])->with('success', 'Usuário editado com sucesso!');
 
         } catch (Exception $e){
 
             // Criando log da operação
             Log::warning('Usuário não editado.', ['error' => $e->getMessage()]);
 
             // Operação não concluída
             DB::rollBack();
 
             // Redirecionar o usuário e envia a mensagem de erro
             return back()->withInput()->with('error', 'Usuário não editado!');
     
         }
     }


     // Método para apagar um usuário
     public function destroy(User $user)
     {
         try {
             // Excluir o registro do banco de dados
             $user->delete(); 
 
             // Criando log da operação
             Log::info('Usuário excluído.', ['id' => $user->id, 'action_user_id' => Auth::id()]);
 
             // Redirecionar o usuário, enviar a mensagem de sucesso
             return redirect()->route('user.index')->with('success', 'Usuário apagado com sucesso!');
         } catch (Exception $e) {
             
             // Criando log da operação
             Log::info('Usuário não apagado.', ['error' => $e->getMessage()]);
             
             // Redirecionar o usuário, enviar a mensagem de sucesso
             return redirect()->route('user.index')->with('error', 'O usuário não foi excluído!');
         }
     }


}
