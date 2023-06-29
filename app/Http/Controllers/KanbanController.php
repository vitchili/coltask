<?php

namespace App\Http\Controllers;

use App\Http\Requests\Kanban\StoreKanbanRequest;
use App\Http\Requests\Kanban\UpdateKanbanRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\KanbanResource;
use App\Models\Kanban;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class KanbanController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKanbanRequest $request): JsonResponse
    {
        
        $data = $request->all();

        $kanban = new Kanban;
        $kanban->fill($data);

        try{
            $kanban->save();

            return response()->json(
                array_merge(['request_status' => 'Operação realizada com sucesso.'], $kanban->toArray())
            , 201);    
        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao adicionar kanban.', 
                'message' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): KanbanResource|JsonResponse
    {
        try{
            $kanban = Kanban::findOrFail($id);
            return new KanbanResource($kanban);
        }
        catch(ModelNotFoundException $e){
            $ids = $e->getIds();

            return response()->json([
                'request_status' => 'Erro ao realizar operação',
                'message' => "Kanban não encontrado. ID: " . implode(', ', $ids)
            ], 500);
        }
    }

    /**
     * Display all the resources.
     */
    public function showAll(): AnonymousResourceCollection
    {
        $kanban = Kanban::all();
        return KanbanResource::collection($kanban);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKanbanRequest $request, int $id): JsonResponse
    {
        $data = $request->all();

        try{
            $kanban = Kanban::findOrFail($id);
            $kanban->fill($data);
            $kanban->save();

            return response()->json(
                array_merge(['request_status' => 'Update realizado com sucesso.'], $kanban->toArray())
            , 200);

        }
        catch(Exception $e){

            return response()->json([
                'request_status' => 'Erro ao editar kanban.', 
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
            $kanban = Kanban::findOrFail($id);
            $kanban->delete();

            return response()->json([
                'request_status' => 'Kanban excluída com sucesso.'
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao excluir kanban.', 
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
