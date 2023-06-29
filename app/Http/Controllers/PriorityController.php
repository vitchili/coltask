<?php

namespace App\Http\Controllers;

use App\Http\Requests\Priority\StorePriorityRequest;
use App\Http\Requests\Priority\UpdatePriorityRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\PriorityResource;
use App\Models\Priority;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PriorityController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePriorityRequest $request): JsonResponse
    {
        
        $data = $request->all();

        $priority = new Priority;
        $priority->fill($data);

        try{
            $priority->save();

            return response()->json(
                array_merge(['request_status' => 'Operação realizada com sucesso.'], $priority->toArray())
            , 201);    
        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao adicionar prioridade.', 
                'message' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): PriorityResource|JsonResponse
    {
        try{
            $priority = Priority::findOrFail($id);
            return new PriorityResource($priority);
        }
        catch(ModelNotFoundException $e){
            $ids = $e->getIds();

            return response()->json([
                'request_status' => 'Erro ao realizar operação',
                'message' => "Prioridade não encontrada. ID: " . implode(', ', $ids)
            ], 500);
        }
    }

    /**
     * Display all the resources.
     */
    public function showAll(): AnonymousResourceCollection
    {
        $priority = Priority::all();
        return PriorityResource::collection($priority);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePriorityRequest $request, int $id): JsonResponse
    {
        $data = $request->all();

        try{
            $priority = Priority::findOrFail($id);
            $priority->fill($data);
            $priority->save();

            return response()->json(
                array_merge(['request_status' => 'Update realizado com sucesso.'], $priority->toArray())
            , 200);

        }
        catch(Exception $e){

            return response()->json([
                'request_status' => 'Erro ao editar prioridade.', 
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        
        try{
            $priority = Priority::findOrFail($id);
            $priority->delete();

            return response()->json([
                'request_status' => 'Prioridade excluída com sucesso.'
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao excluir prioridade.', 
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
