<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\StoreProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request): JsonResponse
    {
        
        $data = $request->all();

        $project = new Project;
        $project->fill($data);

        try{
            $project->save();

            return response()->json(
                array_merge(['request_status' => 'Operação realizada com sucesso.'], $project->toArray())
            , 201);    
        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao adicionar projeto.', 
                'message' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): ProjectResource|JsonResponse
    {
        try{
            $project = Project::findOrFail($id);
            return new ProjectResource($project);
        }
        catch(ModelNotFoundException $e){
            $ids = $e->getIds();

            return response()->json([
                'request_status' => 'Erro ao realizar operação',
                'message' => "Projeto não encontrado. ID: " . implode(', ', $ids)
            ], 500);
        }
    }

    /**
     * Display all the resources.
     */
    public function showAll(): AnonymousResourceCollection
    {
        $project = Project::all();
        return ProjectResource::collection($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, int $id): JsonResponse
    {
        $data = $request->all();

        try{
            $project = Project::findOrFail($id);
            $project->fill($data);
            $project->save();

            return response()->json(
                array_merge(['request_status' => 'Update realizado com sucesso.'], $project->toArray())
            , 200);

        }
        catch(Exception $e){

            return response()->json([
                'request_status' => 'Erro ao editar projeto.', 
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
            $project = Project::findOrFail($id);
            $project->delete();

            return response()->json([
                'request_status' => 'Projeto excluído com sucesso.'
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao excluir projeto.', 
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
