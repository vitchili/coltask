<?php

namespace App\Http\Requests\Kanban;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreKanbanRequest extends FormRequest
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
                'user_id'    => ['required', 'integer', Rule::exists('clients', 'id')],
                'sprint_id'  => ['required', 'integer', Rule::exists('sprints', 'id')],
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
                'user_id.required'      => 'O campo "Usuário" é obrigatório.',
                'user_id.integer'       => 'O campo "Usuário" deve ser um inteiro.',
                'sprint_id.integer'     => 'O campo "Sprint" deve ser um inteiro.',
                'sprint_id.required'    => 'O campo "Sprint" é obrigatório.',

            ];
        }else{
            $response = ['invalid_json.required' => 'O json é inválido.'];
        }

        return $response;
    }
}
