<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponsRequest;
use App\Models\Coupons;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CouponsController extends Controller
{
    public function index()
    {
        // $users = User::all();
        $coupons = Coupons::paginate(20);
        return view('admin.coupons.index', ['menu' => 'coupons', 'coupons' => $coupons]);
    }

    // Detalhes do cupom
    public function show (Coupons $coupon){
        
        // Carrega a view
        return view('admin.coupons.show', ['menu' => 'coupon', 'coupon' => $coupon]);
    }

    public function create()
    {
        return view('admin.coupons.create', ['menu' => 'coupons']);
    }

    public function store(CouponsRequest $request)
    {
         // O trecho de linha abaixo faz a validação dos campos
         $request->validated();

        //  dd($request);
 
         // Marcando o ponto inicial de uma transação
         DB::beginTransaction();
 
         try {
             // Cadastrando no banco de dados na tabela coupons os valores dos campos
             $coupon = Coupons::create(['code' => $request->code, 'discount' => number_format($request->discount / 100, 2), 'expires_at' => $request->expires_at, 'cadastrado_por' => Auth::id()]); // Pegando o id do novo registro cadastrado 
 
             // Criando log da operação
             Log::info('Cupom cadastrado.', ['id' => $coupon->id, $coupon]);
 
             // Operação concluída com sucesso
             DB::commit();
 
             // Redirecionar o usuário e envia a mensagem de sucesso
             return redirect()->route('coupon.index')->with('success', 'Cupom cadastrado com sucesso');
         } catch (Exception $e) {
 
             // Criando log da operação
             Log::warning('Cupom não cadastrado.', ['error' => $e->getMessage()]);
 
             // Operação não concluída
             DB::rollBack();
 
             // Redirecionar o usuário e envia a mensagem de erro
             return back()->withInput()->with('error', 'Cupom não cadastrado!');
         }
    }

    // Método para carregar o formulário editar cupom
    public function edit(Coupons $coupon)
    {
        // Convertento valor percentual para inteiro
        $coupon->discount = $coupon->discount * 100;

        // Criando log da operação
        Log::info('Editar cupom.', ['id' => $coupon->id]);

        return view('admin.coupons.edit', ['menu' => 'coupons','coupon' => $coupon]);
    }

    // Método para registrar a alteração do cupom
    public function update(CouponsRequest $request, Coupons $coupon)
    {

        // O trecho de linha abaixo faz a validação dos campos
        $request->validated();

        // Marcando o ponto inicial de uma transação
        DB::beginTransaction();

        try{
            // Editando as informações do registro no banco de dados
            $coupon->update(['code' => $request->code, 'discount' => number_format($request->discount / 100, 2), 'expires_at' => $request->expires_at]);

            // Criando log da operação
            Log::info('Cupom editado.', ['id' => $coupon->id]);

            // Operação concluída com sucesso
            DB::commit();

            // Redirecionar o usuário e envia a mensagem de sucesso
            return redirect()->route('coupon.show', ['coupon' => $request->coupon])->with('success', 'Cupom editado com sucesso!');

        } catch (Exception $e){

            // Criando log da operação
            Log::warning('Cupom não editado.', ['error' => $e->getMessage()]);

            // Operação não concluída
            DB::rollBack();

            // Redirecionar o usuário e envia a mensagem de erro
            return back()->withInput()->with('error', 'Cupom não editado!');
        
        
        }
    }



    // Método para apagar o cupom
    public function destroy(Coupons $coupon)
    {

        try {
            // Excluir o registro do banco de dados
            $coupon->delete(); 

            // Criando log da operação
            Log::info('Cupom excluído.', ['id' => $coupon->id, 'action_user_id' => Auth::id()]);

            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('coupon.index')->with('success', 'Cupom apagado com sucesso!');
        } catch (Exception $e) {
            
            // Criando log da operação
            Log::info('Cupom não apagado.', ['error' => $e->getMessage()]);
            
            // Redirecionar o usuário, enviar a mensagem de sucesso
            return redirect()->route('coupon.index')->with('error', 'O cupom não foi excluído!');
        }
    }
}
