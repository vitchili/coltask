<?php

namespace App\Http\Requests\Sprint;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreSprintRequest extends FormRequest
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
                'title'        => ['required', 'string'],
                'description'  => ['required', 'string'],
                'dead_line'    => ['required', 'date', 'after:today'],
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
                'title.required'      => 'O campo "Título" é obrigatório.',
                'title.string'        => 'O campo "Título" deve ser um texto.',
                'description.required'=> 'O campo "Descrição" é obrigatório.',
                'description.string'  => 'O campo "Descrição" deve ser um texto.',
                'dead_line.required'  => 'O campo "Prazo" é obrigatório.',
                'dead_line.date'      => 'O campo "Prazo" deve ser uma data.',
                'dead_line.after'     => 'O campo "Prazo" deve ser posterior a data de hoje.',
            ];
        }else{
            $response = ['invalid_json.required' => 'O json é inválido.'];
        }

        return $response;
    }
    
}
