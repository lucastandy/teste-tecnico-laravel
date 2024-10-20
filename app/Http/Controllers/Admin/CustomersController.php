<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Customers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomersController extends Controller
{
    public function index()
    {
        // $users = User::all();
        $customers = Customers::paginate(20);
        return view('admin.customers.index', ['menu' => 'customers', 'customers' => $customers]);
    }

    // Detalhes do cliente
    public function show (Customers $customer){
        
        // Carrega a view
        return view('admin.customers.show', ['menu' => 'customers', 'customer' => $customer]);
    }

    public function create()
    {
        return view('admin.customers.create', ['menu' => 'customers']);
    }

    public function store(CustomerRequest $request)
    {
         // O trecho de linha abaixo faz a validação dos campos
         $request->validated();

        //  dd($request);
 
         // Marcando o ponto inicial de uma transação
         DB::beginTransaction();
 
         try {
             // Cadastrando no banco de dados na tabela customers os valores dos campos
             $customer = Customers::create(['name' => $request->name, 'cpf' => $request->cpf, 'email' => $request->email,'phone' => $request->phone, 'cadastrado_por' => Auth::id()]); // Pegando o id do novo registro cadastrado 
 
             // Criando log da operação
             Log::info('Cliente cadastrado.', ['id' => $customer->id, $customer]);
 
             // Operação concluída com sucesso
             DB::commit();
 
             // Redirecionar o usuário e envia a mensagem de sucesso
             return redirect()->route('customer.index')->with('success', 'Cliente cadastrado com sucesso');
         } catch (Exception $e) {
 
             // Criando log da operação
             Log::warning('Cliente não cadastrado.', ['error' => $e->getMessage()]);
 
             // Operação não concluída
             DB::rollBack();
 
             // Redirecionar o usuário e envia a mensagem de erro
             return back()->withInput()->with('error', 'Cliente não cadastrado!');
         }

        
    }

    // Método para carregar o formulário editar o cliente
    public function edit(Customers $customer)
    {

        // Criando log da operação
        Log::info('Editar cliente.', ['id' => $customer->id]);

        // Carregar a view
        return view('admin.customers.edit', ['menu' => 'customers', 'customer' => $customer]);
    }

     // Método para registrar a alteração do cliente
     public function update(CustomerRequest $request, Customers $customer)
     {
 
         // O trecho de linha abaixo faz a validação dos campos
         $request->validated();
 
         // Marcando o ponto inicial de uma transação
         DB::beginTransaction();
 
         try{
             // Editando as informações do registro no banco de dados
             $customer->update(['name' => $request->name, 'cpf' => $request->cpf, 'email' => $request->email,'phone' => $request->phone]);
 
             // Criando log da operação
             Log::info('Cliente editado.', ['id' => $customer->id]);
 
             // Operação concluída com sucesso
             DB::commit();
 
             // Redirecionar o usuário e envia a mensagem de sucesso
             return redirect()->route('customer.show', ['customer' => $request->customer])->with('success', 'Cliente editado com sucesso!');
 
         } catch (Exception $e){
 
             // Criando log da operação
             Log::warning('Cliente não editado.', ['error' => $e->getMessage()]);
 
             // Operação não concluída
             DB::rollBack();
 
             // Redirecionar o usuário e envia a mensagem de erro
             return back()->withInput()->with('error', 'Cliente não editado!');
         
         
         }
     }





     // Método para apagar o cliente
     public function destroy(Customers $customer)
     {
 
         try {
             // Excluir o registro do banco de dados
             $customer->delete(); 
 
             // Criando log da operação
             Log::info('Cliente excluído.', ['id' => $customer->id, 'action_user_id' => Auth::id()]);
 
             // Redirecionar o usuário, enviar a mensagem de sucesso
             return redirect()->route('customer.index')->with('success', 'Cliente apagado com sucesso!');
         } catch (Exception $e) {
             
             // Criando log da operação
             Log::info('Cliente não apagado.', ['error' => $e->getMessage()]);
             
             // Redirecionar o usuário, enviar a mensagem de sucesso
             return redirect()->route('customer.index')->with('error', 'O cliente não foi excluído!');
         }
     }
}
