<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponsRequest extends FormRequest
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
            'code' => 'required',
            'discount' => 'required|numeric|between:0,100',
            'expires_at' => 'required',
        ];
    }

    public function messages(): array
    {

        return [
            'code.required' => 'Campo código de desconto é obrigatório!',
            'discount.required' => 'Campo percentual do desconto é obrigatório!',
            'expires_at.required' => 'Campo data de expiração é obrigatório!',
        ];
    }
}
