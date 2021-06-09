<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EncomendaPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function     rules()
    {
        return [
            'estado' =>         'required',
            'cliente_id' => 'required',
            'data' =>       'required',
            'notas' =>       'nullable',
            'preco_total' => 'required',
            'nif' => 'nullable|digits:9',
            'endereco' => 'nullable',
            'tipo_pagamento' => 'nullable',
            'ref_pagamento' => 'nullable',
        ];
    }
}
