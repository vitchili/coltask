<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UpdateTaskChangeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //fazer validacoes das permissoes do spaten aqui. quem pode alterar etc.
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
                'modification'             => ['required', 'min:10', 'string'],
                'branch'                   => ['required', 'string'],
                'link_merge_request'       => ['required', 'string'],
            ];
        }else{
            $response = ['modification'    => ['required', 'string']];
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
                'modification.required'       => 'O campo "modificação" é obrigatório.',
                'modification.string'         => 'O campo "modificação" deve ser um texto.',
                'modification.min'            => 'O campo "modificação" precisa de no mínimo 10 caracteres.',
                'branch.required'             => 'O campo "branch" é obrigatório',
                'branch.string'               => 'O campo "branch" deve ser um texto.',
                'link_merge_request.required' => 'O campo "link do merge request" é obrigatório.',
                'link_merge_request.string'   => 'O campo "link do merge request" deve ser um texto.',
            ];
        }else{
            $response = ['modification.string' => 'O json é inválido.'];
        }

        return $response;
    }
}
