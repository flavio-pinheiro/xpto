<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastraBolsa extends FormRequest
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
            'curso' => 'required|min:2',
            'vagas' => 'required|integer',
            'fim'   => "required",
            'horaFim' => "required",
            'sorteio'   => "required",
            'horaSorteio'   => "required",
        ];



    }

    public function messages()
    {
        return [
            'required' => 'Esse campo é obrigatório',
        ];
    }

}
