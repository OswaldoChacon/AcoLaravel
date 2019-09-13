<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSeminarioRequest extends FormRequest
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
            'titulo' => 'required',
            'numeroSeminario' => 'required|unique:seminarios,numeroSeminario',
            'periodo' => 'required',
            'anio' => 'required',
            'foro_id' => 'required|unique:seminarios,foro_id',
        ];
    }

    public function attributes()
    {
        return [
            'anio' => 'año',
            'foro_id' => 'foro',
        ];
    }
}
