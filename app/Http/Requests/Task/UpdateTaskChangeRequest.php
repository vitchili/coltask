<?php

namespace App\Http\Requests\Task;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateTaskChangeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // $user = auth()->user();
        // $taskId = $this->get('id');
        // $task = Task::find($taskId);

        // return $user->id === $task->sponsor_id; 
        return true;
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
                'faseId' => ['required', 'integer', Rule::exists('fases', 'id')],
            ];
        }else{
            $response = ['faseId'  => ['required', 'integer']];
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
                'faseId.required' => 'O campo "fase" é obrigatório.',
                'faseId.integer'  => 'O campo "fase" deve ser um número inteiro.',
            ];
        }else{
            $response = ['faseId.integer' => 'O json é inválido.'];
        }

        return $response;
    }
}
