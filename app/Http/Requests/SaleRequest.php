<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
            'customer_id' => 'required',
            'produto_id' => 'required',
            'sale_price' => 'required',
            'qtd_desejada' => 'required',
            'total' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'customer_id.required' => 'O campo cliente é obrigatório!',
            'product_id.required' => 'O campo do produto é obrigatório!',
            'sale_price.required' => 'O campo valor de venda é obrigatório!',
            'qtd_desejada.required' => 'O campo quantidade desejada é obrigatório!',
            'total.required' => 'O campo total é obrigatório!',
        ];
    }
}
