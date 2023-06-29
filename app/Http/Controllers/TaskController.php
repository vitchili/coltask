<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request): array|string
    {
        
        $data = $request->all();

        $task = new Task;
        $task->fill($data);

        try{
            
            $task->save();

            return array_merge(['request_status' => 'Operação realizada com sucesso.'], $task->toArray());
        }
        catch(Exception $e){
            return [
                'request_status' => 'Erro ao adicionar tarefa.', 
                'message' => $e->getMessage()
            ];
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): TaskResource|array
    {
        try{
            $task = Task::findOrFail($id);
            return new TaskResource($task);
        }
        catch(ModelNotFoundException $e){
            $ids = $e->getIds();
            return array_merge([
                'request_status' => 'Erro ao realizar operação',
                'message' => "Task não encontrada. ID: " . implode(', ', $ids)
            ], );
        }
    }

    /**
     * Display all the resources.
     */
    public function showAll(): AnonymousResourceCollection
    {
        $tasks = Task::all();
        return TaskResource::collection($tasks);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, int $id): array
    {
        $data = $request->all();

        try{
            $task = Task::findOrFail($id);
            $task->fill($data);
            $task->save();

            return array_merge(['request_status' => 'Update realizado com sucesso.'], $task->toArray());

        }
        catch(Exception $e){
            return [
                'request_status' => 'Erro ao editar tarefa.', 
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): array
    {
        
        try{
            $task = Task::findOrFail($id);
            $task->delete();

            return ['request_status' => 'Tarefa excluída com sucesso.'];
        }
        catch(Exception $e){
            return [
                'request_status' => 'Erro ao excluir tarefa.', 
                'message' => $e->getMessage()
            ];
        }
    }
}
