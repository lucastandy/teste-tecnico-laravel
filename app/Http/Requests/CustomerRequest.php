<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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


        return [
            'name' => 'required',
            'email' => 'required',
            'cpf' => 'required',
            'phone' => 'required',
        ];
    }

    public function messages(): array
    {

        return [
            'name.required' => 'Campo nome do cliente é obrigatório!',
            'email.required' => 'Campo e-mail do cliente é obrigatório!',
            'cpf.required' => 'Campo CPF do cliente é obrigatório!',
            'phone.required' => 'Campo telefone do cliente é obrigatório!',
        ];
    }
}
