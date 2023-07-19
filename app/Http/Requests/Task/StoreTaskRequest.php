<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class StoreTaskRequest extends FormRequest
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
                'client_id' => ['required', 'integer', Rule::exists('clients', 'id')],
                'email_copy' => ['nullable', 'string'],
                'outside_requester' => ['nullable', 'string'],
                'type' => ['required', 'in:E,F,P'],
                'title' => ['required', 'min:10', 'string'],
                'description' => ['required', 'string'],
                'direction_id' => ['required', 'integer', Rule::exists('directions', 'id')],
                'screen_id' => ['nullable', 'integer', Rule::exists('screens', 'id')],
                'priority_id' => ['nullable', 'integer', Rule::exists('priorities', 'id')],
                'dead_line' => ['nullable','date'],
                'attachment_json' => ['nullable', 'string'],
                'sprint_id' => ['nullable', 'integer', Rule::exists('sprints', 'id')],
            ];
        }else{
            $response = ['client_id' => ['required', 'integer']];
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
                'client_id.required'   => 'O campo "cliente" é obrigatório.',
                'client_id.integer'    => 'O campo "cliente" deve ser um número inteiro.',
                'type.required'        => 'O campo "tipo de tarefa" é obrigatório.',
                'type.in'              => 'O campo "tipo" está inválido.',
                'direction_id.required'=> 'O campo "setor" é obrigatório.',
                'title.required'       => 'O campo "título" é obrigatório.',
                'title.min'            => 'O campo "título" precisa de no mínimo 10 caracteres.',
                'title.string'         => 'O campo "título" deve ser um texto.',
                'description'          => 'O campo "descrição" é obrigatório.',        
                'description.min'      => 'O campo "descrição" precisa de no mínimo 10 caracteres.',
                'description.string'   => 'O campo "descrição" deve ser um texto.',
                'screen_id.integer'    => 'O campo "tela" deve ser um número inteiro',    
                'priority_id.integer'  => 'O campo "prioridade deve ser um número inteiro.',        
                'sprint_id.integer'    => 'O campo "sprint deve ser um número inteiro.',
            ];
        }else{
            $response = ['client_id.required' => 'O json é inválido.'];
        }

        return $response;
    }
}
