<?php

namespace App\Http\Controllers;

use App\Http\Requests\Module\StoreModuleRequest;
use App\Http\Requests\Module\UpdateModuleRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\ModuleResource;
use App\Models\Module;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ModuleController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreModuleRequest $request): JsonResponse
    {
        
        $data = $request->all();

        $module = new Module;
        $module->fill($data);

        try{
            $module->save();

            return response()->json(
                array_merge(['request_status' => 'Operação realizada com sucesso.'], $module->toArray())
            , 201);    
        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao adicionar módulo.', 
                'message' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): ModuleResource|JsonResponse
    {
        try{
            $module = Module::findOrFail($id);
            return new ModuleResource($module);
        }
        catch(ModelNotFoundException $e){
            $ids = $e->getIds();

            return response()->json([
                'request_status' => 'Erro ao realizar operação',
                'message' => "Módulo não encontrado. ID: " . implode(', ', $ids)
            ], 500);
        }
    }

    /**
     * Display all the resources.
     */
    public function showAll(): AnonymousResourceCollection
    {
        $module = Module::all();
        return ModuleResource::collection($module);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateModuleRequest $request, int $id): JsonResponse
    {
        $data = $request->all();

        try{
            $module = Module::findOrFail($id);
            $module->fill($data);
            $module->save();

            return response()->json(
                array_merge(['request_status' => 'Update realizado com sucesso.'], $module->toArray())
            , 200);

        }
        catch(Exception $e){

            return response()->json([
                'request_status' => 'Erro ao editar módulo.', 
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
            $module = Module::findOrFail($id);
            $module->delete();

            return response()->json([
                'request_status' => 'Módulo excluída com sucesso.'
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao excluir módulo.', 
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
