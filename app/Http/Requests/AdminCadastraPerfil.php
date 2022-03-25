<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\FullName;
use App\Rules\ValidateCpf;

class AdminCadastraPerfil extends FormRequest
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
            'nome' => ['required', new FullName],
            'email' => 'required|email',
            'cpf' => ['required',new ValidateCpf],
            'nascimento' => "required",
            'fone' => 'required|min:8',
            'nacionalidade' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Esse campo é obrigatório',
        ];
    }
    
}
