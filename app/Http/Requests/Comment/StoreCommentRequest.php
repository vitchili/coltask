<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class StoreCommentRequest extends FormRequest
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
                'task_id'         => ['required', 'integer', Rule::exists('tasks', 'id')],
                'destinatary_id'  => ['required', 'integer', Rule::exists('users', 'id')],
                'comment'         => ['required', 'string', 'min:3'],
                'visibility'      => ['nullable', 'boolean'],
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
                'task_id.required'       => 'O campo "task" é obrigatório.',
                'destinatary_id.required'=> 'O campo "destinatário" é obrigatório.',
                'comment.required'       => 'O campo "comentário" é obrigatório.',
                'comment.min'            => 'O campo "comentário" precisa de no mínimo 3 caracteres.',
            ];
        }else{
            $response = ['invalid_json.required' => 'O json é inválido.'];
        }

        return $response;
    }
}
