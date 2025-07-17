<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'nome' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'estoque' => 'required|integer|min:0',
            'estoque_total' => 'sometimes|integer|min:0',
        ];

        if ($this->has('variacoes')) {
            $rules['variacoes'] = 'array';
            $rules['variacoes.*.nome'] = 'required|string|max:255';
            $rules['variacoes.*.preco'] = 'nullable|numeric|min:0';
            $rules['variacoes.*.estoque'] = 'required|integer|min:0';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'min' => 'O campo :attribute deve ser no mínimo :min',
            'numeric' => 'O campo :attribute deve ser um número',
        ];
    }

    public function prepareForValidation()
    {
        
        if ($this->has('variacoes')) {
            $this->merge([
                'estoque_total' => array_sum(array_column($this->variacoes, 'estoque'))
            ]);            
        }else{
            $this->merge([
                'estoque_total' => $this->estoque
            ]);
        }
    }
}
