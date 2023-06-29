<?php

namespace App\Http\Requests\Priority;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StorePriorityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //fazer validacoes das permissoes do spaten aqui. quem pode abrir etc.
        // throw new \Illuminate\Auth\Access\AuthorizationException('Mensagem personalizada de autorização falhou.');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $response = '';

        if(Str::isJson($this->content)){
            $response = [
                'name'        => ['required', 'string'],
                'hex_color'   => ['required', 'string'],
                'is_a_bug'    => ['required', 'boolean'],
            ];
        }else{
            $response = ['invalid_json' => ['required']];
        }

        return $response;
    }

    /**
     * Translated and specific error messages
     */
    public function messages()
    {
        $response = '';

        if(Str::isJson($this->content)){
            $response = [
                'name.required'      => 'O campo "Nome" é obrigatório.',
                'name.string'        => 'O campo "Nome" deve ser um texto.',
                'hex_color.required' => 'O campo "Cor" é obrigatório.',
                'hex_color.string'   => 'O campo "Cor" deve ser uma hex (ex: #f4f4f4).',
                'is_a_bug.required'  => 'O campo "Contabiliza como bug" é obrigatório.',
                'is_a_bug.boolean'   => 'O campo "Contabiliza como bug" deve ser booleano.',
            ];
        }else{
            $response = ['invalid_json.required' => 'O json é inválido.'];
        }

        return $response;
    }
}
