<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSeminarioRequest extends FormRequest
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
            // 'numeroSeminario' => 'required|unique:seminarios,numeroSeminario',
            'titulo' => 'required',
            'numeroSeminario' => [
                                    'required',
                                    Rule::unique('seminarios')->ignore($this->route('seminario')),
                                 ],
            'periodo' => 'required',
            'anio' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'anio' => 'año',
        ];
    }
}
