<?php

namespace Alixame\Opportunities\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOpportunityRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'email' => 'required|email|min:3',
            'telephone' => 'required|numeric',
            'message' => 'required|min:3|max:500',
            'status' => 'numeric',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatorio',
            'name.min' => 'O campo nome teve ter do minimo 3 caracter',
            'email.required' => 'O campo nome é obrigatorio',
            'email.email' => 'O campo email deve ser valido',
            'telephone.required' => 'O campo telefone é obrigatorio',
            'telephone.numeric' => 'O campo telefone deve conter apenas numeros',
            'message.required' => 'O campo mensagem é obrigatorio',
            'message.min' => 'O campo mensagem teve ter do minimo 3 caracter',
            'message.max' => 'O campo mensagem teve ter do maximo 500 caracter',
            'status.numeric' => 'O campo status deve conter apenas numeros'
        ];
    }
}