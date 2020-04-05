<?php

namespace App\Http\Requests\MenuDia;

use App\Http\Requests\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class MenuDiaCreateRequest extends FormRequest
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
           
            'menu_dia' => 'required',
       
        ];
    }

    public function messages()
    {
        return [
            'menu_dia.required' => 'El :attribute es obligatorio',
        ];
    }

    public function attributes()
    {
        return [
            'menu_dia' => 'Menu del Dia',
        ];
    }

}
