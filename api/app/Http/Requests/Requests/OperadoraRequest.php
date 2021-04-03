<?php

namespace App\Http\Requests\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OperadoraRequest extends FormRequest
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
        if (request()->method() == 'PUT') {
            $values = explode('/', request()->url());
            $id = intval(end($values));
            return ['no_operadora' => 'required|max:256|unique:operadoras,no_operadora,'. $id];
        } else {
            return ['no_operadora' => 'required|max:256|unique:operadoras,no_operadora'];
    }
    }

    public function messages()
    {
        $messages = [
            'no_operadora.required' => 'Nome da operadora é obrigatório.',
            'no_operadora.max' => 'Número de caracteres não permitido.',
            'no_operadora.unique' => 'Nome de operadora já cadastrado.',
        ];

        return $messages;
    }
}
