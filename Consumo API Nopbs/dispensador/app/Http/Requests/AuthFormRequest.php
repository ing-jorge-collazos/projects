<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthFormRequest extends FormRequest
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
    public function rules()
    {
        return [
            'nit'=>'required',
            'token'=>'required'
        ];
    }

    /**
     * mensajes personalizados
     */
    public function messages()
    {
        return [
            'nit.required'=>'El nit de la empresa es obligatorio',
            'token.required'=>'El token de autorización es obligatorio'

        ];
    }
}
