<?php

namespace App\Http\Controllers;

use App\Http\Requests\Team\StoreTeamRequest;
use App\Http\Requests\Team\UpdateTeamRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\TeamResource;
use App\Models\Team;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TeamController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request): JsonResponse
    {
        
        $data = $request->all();

        $team = new Team;
        $team->fill($data);

        try{
            $team->save();

            return response()->json(
                array_merge(['request_status' => 'Operação realizada com sucesso.'], $team->toArray())
            , 201);    
        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao adicionar equipe.', 
                'message' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): TeamResource|JsonResponse
    {
        try{
            $team = Team::findOrFail($id);
            return new TeamResource($team);
        }
        catch(ModelNotFoundException $e){
            $ids = $e->getIds();

            return response()->json([
                'request_status' => 'Erro ao realizar operação',
                'message' => "Equpe não encontrada. ID: " . implode(', ', $ids)
            ], 500);
        }
    }

    /**
     * Display all the resources.
     */
    public function showAll(): AnonymousResourceCollection
    {
        $team = Team::all();
        return TeamResource::collection($team);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeamRequest $request, int $id): JsonResponse
    {
        $data = $request->all();

        try{
            $team = Team::findOrFail($id);
            $team->fill($data);
            $team->save();

            return response()->json(
                array_merge(['request_status' => 'Update realizado com sucesso.'], $team->toArray())
            , 200);

        }
        catch(Exception $e){

            return response()->json([
                'request_status' => 'Erro ao editar equipe.', 
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
            $team = Team::findOrFail($id);
            $team->delete();

            return response()->json([
                'request_status' => 'Equipe excluída com sucesso.'
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao excluir equipe.', 
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
