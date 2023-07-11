<?php

namespace App\Http\Requests\Sprint;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateSprintRequest extends FormRequest
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
                'title'        => ['nullable', 'string'],
                'description'  => ['nullable', 'string'],
                'dead_line'    => ['nullable', 'date', 'after:today'],
                'project_id'   => ['nullable', 'integer', Rule::exists('projects', 'id')],
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
                'title.string'        => 'O campo "Título" deve ser um texto.',
                'description.string'  => 'O campo "Descrição" deve ser um texto.',
                'dead_line.date'      => 'O campo "Prazo" deve ser uma data válida.',
                'dead_line.after'     => 'O campo "Prazo" deve ser posterior a data de hoje.',
                'project.integer'     => 'O campo "Projeto" deve ser um número inteiro.',
            ];
        }else{
            $response = ['invalid_json.required' => 'O json é inválido.'];
        }

        return $response;
    }

}
