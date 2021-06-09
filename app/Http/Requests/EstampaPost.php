<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EstampaPost extends FormRequest
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
            'nome' =>         'required',
            'descricao' =>       'required',
            'informacao_extra' =>       'nullable',
            'foto' => 'nullable|image|max:8192',   // Máximum size = 8Mb
        ];
    }
}