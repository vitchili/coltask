<?php

namespace App\Http\Controllers;

use App\Http\Requests\Fase\StoreFaseRequest;
use App\Http\Requests\Fase\UpdateFaseRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\FaseResource;
use App\Models\Fase;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FaseController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFaseRequest $request): JsonResponse
    {
        
        $data = $request->all();

        $fase = new Fase;
        $fase->fill($data);

        try{
            $fase->save();

            return response()->json(
                array_merge(['request_status' => 'Operação realizada com sucesso.'], $fase->toArray())
            , 201);    
        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao adicionar fase.', 
                'message' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): FaseResource|JsonResponse
    {
        try{
            $fase = Fase::findOrFail($id);
            return new FaseResource($fase);
        }
        catch(ModelNotFoundException $e){
            $ids = $e->getIds();

            return response()->json([
                'request_status' => 'Erro ao realizar operação',
                'message' => "Fase não encontrado. ID: " . implode(', ', $ids)
            ], 500);
        }
    }

    /**
     * Display all the resources.
     */
    public function showAll(): AnonymousResourceCollection
    {
        $fase = Fase::all();
        return FaseResource::collection($fase);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFaseRequest $request, int $id): JsonResponse
    {
        $data = $request->all();

        try{
            $fase = Fase::findOrFail($id);
            $fase->fill($data);
            $fase->save();

            return response()->json(
                array_merge(['request_status' => 'Update realizado com sucesso.'], $fase->toArray())
            , 200);

        }
        catch(Exception $e){

            return response()->json([
                'request_status' => 'Erro ao editar fase.', 
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
            $fase = Fase::findOrFail($id);
            $fase->delete();

            return response()->json([
                'request_status' => 'Fase excluída com sucesso.'
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao excluir fase.', 
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
