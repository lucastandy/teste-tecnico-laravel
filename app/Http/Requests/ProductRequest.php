<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'description' => 'required',
            'purchase_price' => 'required|max:10',
            'sale_price' => 'required|max:10',
            'stock_quantity' => 'required|numeric',
            'category_id' => 'required',
        ];
    }

    public function messages(): array
    {

        return [
            'name.required' => 'Campo nome do produto é obrigatório!',
            'description.required' => 'Campo descrição do produto é obrigatório!',
            'purchase_price.required' => 'Campo valor de compra do produto é obrigatório!',
            'purchase_price.max' => 'O Valor de compra só pode ter no máximo 8 números!',
            'sale_price.required' => 'Campo valor de venda do produto é obrigatório!',
            'sale_price.max' => 'O Valor de venda só pode ter no máximo 8 números!',
            'stock_quantity.required' => 'Campo quantidade em estoque do produto é obrigatório!',
            'stock_quantity.numeric' => 'Campo quantidade em estoque do produto deve ser um número!',
            'category_id.required' => 'Campo categoria do produto é obrigatório!',
        ];
    }
}
