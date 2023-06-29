<?php

namespace App\Http\Controllers;

use App\Http\Requests\Requirement\StoreRequirementRequest;
use App\Http\Requests\Requirement\UpdateRequirementRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\RequirementResource;
use App\Models\Requirement;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class RequirementController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequirementRequest $request): JsonResponse
    {
        
        $data = $request->all();

        $requirement = new Requirement;
        $requirement->fill($data);

        try{
            $requirement->save();

            return response()->json(
                array_merge(['request_status' => 'Operação realizada com sucesso.'], $requirement->toArray())
            , 201);    
        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao adicionar requisito.', 
                'message' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): RequirementResource|JsonResponse
    {
        try{
            $requirement = Requirement::findOrFail($id);
            return new RequirementResource($requirement);
        }
        catch(ModelNotFoundException $e){
            $ids = $e->getIds();

            return response()->json([
                'request_status' => 'Erro ao realizar operação',
                'message' => "Requisito não encontrado. ID: " . implode(', ', $ids)
            ], 500);
        }
    }

    /**
     * Display all the resources.
     */
    public function showAll(): AnonymousResourceCollection
    {
        $requirement = Requirement::all();
        return RequirementResource::collection($requirement);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequirementRequest $request, int $id): JsonResponse
    {
        $data = $request->all();

        try{
            $requirement = Requirement::findOrFail($id);
            $requirement->fill($data);
            $requirement->save();

            return response()->json(
                array_merge(['request_status' => 'Update realizado com sucesso.'], $requirement->toArray())
            , 200);

        }
        catch(Exception $e){

            return response()->json([
                'request_status' => 'Erro ao editar requisito.', 
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
            $requirement = Requirement::findOrFail($id);
            $requirement->delete();

            return response()->json([
                'request_status' => 'Requisito excluído com sucesso.'
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao excluir requisito.', 
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
