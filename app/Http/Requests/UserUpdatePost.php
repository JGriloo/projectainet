<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdatePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' =>         'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->id),
            ],
            'foto' => 'nullable|image|max:8192',   // Máximum size = 8Mb
            'bloqueado' => 'nullable|boolean',
            'tipo' => [
                'required',
                Rule::in(['A','F','C']),
            ],
            'password' => 'nullable|min:8',
        ];
    }
}
