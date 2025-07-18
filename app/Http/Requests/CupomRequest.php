<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CupomRequest extends FormRequest
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
        $rules = [
            'nome' => 'required|string|max:255',
            'codigo_cupom' => 'required|string|max:255',
            'validade' => 'required|date|after:today',
            'valor_min' => 'required|numeric|min:0',
        ];

        return $rules;        
    }
}
