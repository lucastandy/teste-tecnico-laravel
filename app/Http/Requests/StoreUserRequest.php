<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user');

        // Testando se a varíavel '$userId' está vazia ou não. Se estiver vazia, será aplicado uma regra, caso contrário, será aplicada outra regra.
        $regra_email = $userId ? 'required|email|unique:users,email,' .($userId ? $userId->id : null) : 'required|email|unique:users,email';
    

        return [
            'name' => 'required',
            'email' => $regra_email,
            'password' => 'required_if:password,!=,null|min:6',
        ];
    }

    public function messages(): array
    {
        return[
            'name.required' => 'Campo nome do usuário é obrigatório!',
            'email.required' => 'Campo e-mail é obrigatório!',
            'email.email' => 'Necessário enviar um e-mail válido!',
            'email.unique' => 'O e-mail já está cdastrado!',
            'password.required_if' => 'Campo senha é obrigatório',
            'password.min' => 'A senha deve ter no mínimo :min caracteres',
            'password.max' => 'Senha com no máximo :max caracteres!',
        ];
    }
}
