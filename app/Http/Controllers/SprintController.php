<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sprint\StoreSprintRequest;
use App\Http\Requests\Sprint\UpdateSprintRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\SprintResource;
use App\Models\Sprint;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SprintController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSprintRequest $request): JsonResponse
    {
        
        $data = $request->all();

        $sprint = new Sprint;
        $sprint->fill($data);

        try{
            $sprint->save();

            return response()->json(
                array_merge(['request_status' => 'Operação realizada com sucesso.'], $sprint->toArray())
            , 201);    
        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao adicionar sprint.', 
                'message' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): SprintResource|JsonResponse
    {
        try{
            $sprint = Sprint::findOrFail($id);
            return new SprintResource($sprint);
        }
        catch(ModelNotFoundException $e){
            $ids = $e->getIds();

            return response()->json([
                'request_status' => 'Erro ao realizar operação',
                'message' => "Sprint não encontrada. ID: " . implode(', ', $ids)
            ], 500);
        }
    }

    /**
     * Display all the resources.
     */
    public function showAll(): AnonymousResourceCollection
    {
        $sprint = Sprint::all();
        return SprintResource::collection($sprint);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSprintRequest $request, int $id): JsonResponse
    {
        $data = $request->all();

        try{
            $sprint = Sprint::findOrFail($id);
            $sprint->fill($data);
            $sprint->save();

            return response()->json(
                array_merge(['request_status' => 'Update realizado com sucesso.'], $sprint->toArray())
            , 200);

        }
        catch(Exception $e){

            return response()->json([
                'request_status' => 'Erro ao editar sprint.', 
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
            $sprint = Sprint::findOrFail($id);
            $sprint->delete();

            return response()->json([
                'request_status' => 'Sprint excluída com sucesso.'
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao excluir sprint.', 
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
