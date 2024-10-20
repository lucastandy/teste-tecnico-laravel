<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|unique:categories',
        ];
    }

    public function messages(): array
    {

        return [
            'name.required' => 'Campo categoria do produto é obrigatório!',
            'name.unique' => 'Ja existe uma categoria com este nome!',
        ];
    }
}
