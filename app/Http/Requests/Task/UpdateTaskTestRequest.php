<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UpdateTaskTestRequest extends FormRequest
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
                'test_ocorrency'      => ['required', 'min:10', 'string'],
                'qa_id'               => ['required', 'integer'],
                'approved_or_failed'  => ['required', 'string', 'size:1', Rule::in(['A', 'F'])],
            ];
        }else{
            $response = ['test_ocorrency'    => ['required', 'string']];
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
                'test_ocorrency.required'       => 'O campo "teste" é obrigatório.',
                'test_ocorrency.string'         => 'O campo "teste" deve ser um texto.',
                'test_ocorrency.min'            => 'O campo "teste" precisa de no mínimo 10 caracteres.',
                'qa_id.required'                => 'O campo "QA" é obrigatório',
                'qa_id.integer'                 => 'O campo "QA" deve ser um número inteiro.',
                'approved_or_failed.required'   => 'O campo "Aprovação" é obrigatório.',
            ];
        }else{
            $response = ['test_ocorrency.string' => 'O json é inválido.'];
        }

        return $response;
    }
}
