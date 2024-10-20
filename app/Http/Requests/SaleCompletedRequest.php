<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleCompletedRequest extends FormRequest
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
            'applied_code' => 'nullable|string',
            'coupon_id_applied' => 'nullable|integer',
            'discount_value' => 'required|numeric',
        ];
    }

    // Mensagens
    public function messages(): array
    {
        return [
            'applied_code.string' => 'O campo "applied_code" deve ser uma string.',
            'coupon_id_applied.integer' => 'O campo "coupon_id_applied" deve ser um número inteiro.',
            'discount_value.numeric' => 'O campo "discount_value" deve ser um número.',
        ];
    }

}
