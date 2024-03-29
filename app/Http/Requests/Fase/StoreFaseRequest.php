<?php

namespace App\Http\Requests\Fase;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreFaseRequest extends FormRequest
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
                'description' => ['required', 'string'],
                'hex_color'   => ['nullable', 'string'],
                'visibility'  => ['nullable', 'boolean'],
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
                'name.required'        => 'O campo "Nome" é obrigatório.',
                'name.string'          => 'O campo "Nome" deve ser um texto.',
                'description.required' => 'O campo "Descrição" é obrigatório.',
                'description.string'   => 'O campo "Descrição" deve ser um texto.',
                'hex_color.string'     => 'O campo "Cor" deve ser um hexadecimal #xxxxxx.',
                'visibility.boolean'   => 'O campo "Visibilidade" deve ser booleano.',
            ];
        }else{
            $response = ['invalid_json.required' => 'O json é inválido.'];
        }

        return $response;
    }
}
