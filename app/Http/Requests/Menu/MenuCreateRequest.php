<?php

namespace App\Http\Requests\Menu;

use App\Http\Requests\FailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class MenuCreateRequest extends FormRequest
{
    use FailedValidation;
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
            'id_restaurante' => 'required|integer',
            'menu' => 'required|json'
        ];
    }

}
