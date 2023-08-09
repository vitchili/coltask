<?php

namespace App\Http\Requests\Task;

use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateTaskTestRequest extends FormRequest
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
                'test_ocorrency'     => ['required', 'string'],
                'approved_or_failed' => ['required', 'string', 'max:1', 'in:A,F'],
            ];
        }else{
            $response = ['test_ocorrency'  => ['required', 'string']];
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
                'test_ocorrency.required'   => 'O campo "Teste" é obrigatório.',
                'test_ocorrency.string'     => 'O campo "fase" deve ser um número inteiro.',
                'approved_or_failed.string' => 'O campo "aprovação" deve ser A ou F.',
                'approved_or_failed.in'     => 'O campo "aprovação" deve ser A ou F.',
            ];
        }else{
            $response = ['test_ocorrency.required' => 'O json é inválido.'];
        }

        return $response;
    }
    
}
