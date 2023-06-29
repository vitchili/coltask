<?php

namespace App\Http\Controllers;

use App\Http\Requests\Direction\StoreDirectionRequest;
use App\Http\Requests\Direction\UpdateDirectionRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\DirectionResource;
use App\Models\Direction;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DirectionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDirectionRequest $request): JsonResponse
    {
        
        $data = $request->all();

        $direction = new Direction;
        $direction->fill($data);

        try{
            $direction->save();

            return response()->json(
                array_merge(['request_status' => 'Operação realizada com sucesso.'], $direction->toArray())
            , 201);
        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao adicionar direcionamento.', 
                'message' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): DirectionResource|JsonResponse
    {
        try{
            $direction = Direction::findOrFail($id);
            return new DirectionResource($direction);
        }
        catch(ModelNotFoundException $e){
            $ids = $e->getIds();
            return response()->json([
                'request_status' => 'Erro ao realizar operação',
                'message' => "Direcionamento não encontrado. ID: " . implode(', ', $ids)
            ], 500);
        }
    }

    /**
     * Display all the resources.
     */
    public function showAll(): AnonymousResourceCollection
    {
        $direction = Direction::all();
        return DirectionResource::collection($direction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDirectionRequest $request, int $id): JsonResponse
    {
        $data = $request->all();

        try{
            $direction = Direction::findOrFail($id);
            $direction->fill($data);
            $direction->save();

            return response()->json(
                array_merge(['request_status' => 'Update realizado com sucesso.'], $direction->toArray())
            , 200);

        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao editar direcionamento.', 
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
            $direction = Direction::findOrFail($id);
            $direction->delete();

            return response()->json(
                ['request_status' => 'Direcionamento excluído com sucesso.']
            , 200);
        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao excluir direcionamento.', 
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
