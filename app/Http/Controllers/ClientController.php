<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ClientController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request): JsonResponse
    {
        
        $data = $request->all();

        $client = new Client;
        $client->fill($data);

        try{
            
            $client->save();

            return response()->json(
                array_merge(['request_status' => 'Operação realizada com sucesso.'], $client->toArray())
            , 201);

        }
        catch(Exception $e){
            return response()->json([
                    'request_status' => 'Erro ao adicionar cliente.', 
                    'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): ClientResource|JsonResponse
    {
        try{
            $client = Client::findOrFail($id);
            return new ClientResource($client);
        }
        catch(ModelNotFoundException $e){
            $ids = $e->getIds();
            return response()->json([
                'request_status' => 'Erro ao realizar operação',
                'message' => "Client não encontrado. ID: " . implode(', ', $ids)
            ], 500);
        }
    }

    /**
     * Display all the resources.
     */
    public function showAll(): AnonymousResourceCollection
    {
        $client = Client::all();
        return ClientResource::collection($client);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClientRequest $request, int $id): JsonResponse
    {
        $data = $request->all();

        try{
            $client = Client::findOrFail($id);
            $client->fill($data);
            $client->save();

            return response()->json(
                array_merge(['request_status' => 'Update realizado com sucesso.'], $client->toArray())
            , 200);

        }
        catch(Exception $e){
            return response()->json([
                    'request_status' => 'Erro ao editar cliente.', 
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
            $client = Client::findOrFail($id);
            $client->delete();

            return response()->json([
                'request_status' => 'Cliente excluído com sucesso.'
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao excluir cliente.', 
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
