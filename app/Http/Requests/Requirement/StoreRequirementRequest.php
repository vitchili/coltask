<?php

namespace App\Http\Requests\Requirement;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreRequirementRequest extends FormRequest
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
                'task_id'                  => ['required', 'integer', Rule::exists('tasks', 'id')],
                'author_id'                => ['required', 'integer', Rule::exists('users', 'id')],
                'requirement_description'  => ['required', 'string'],
                'solution_flow'            => ['required', 'string'],
                'obs_development'          => ['nullable', 'string'],
                'feedback_QA'              => ['nullable', 'string'],
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
                'task_id.required'      => 'O campo "Task Id" é obrigatório.',
                'task_id.integer'        => 'O campo "Task Id" deve ser um texto.',
                'author_id.required'  => 'O campo "Autor" deve ser um inteiro.',
                'author_id.integer'  => 'O campo "Autor" deve ser um inteiro.',
                'requirement_description.required'  => 'O campo "Requisito" deve ser um inteiro.',
                'requirement_description.string'  => 'O campo "Requisito" deve ser um inteiro.',
                'solution_flow.required'  => 'O campo "Fluxo de solução" deve ser um inteiro.',
                'solution_flow.string'  => 'O campo "Fluxo de soluçã" deve ser um inteiro.',
                'obs_development.string'  => 'O campo "Observação" deve ser um inteiro.',
                'feedback_QA.string'  => 'O campo "Feedback do QA" deve ser um inteiro.',
            ];
        }else{
            $response = ['invalid_json.required' => 'O json é inválido.'];
        }

        return $response;
    }
}
