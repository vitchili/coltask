<?php

namespace App\Http\Controllers;

use App\Http\Requests\Screen\StoreScreenRequest;
use App\Http\Requests\Screen\UpdateScreenRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\ScreenResource;
use App\Models\Screen;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ScreenController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScreenRequest $request): JsonResponse
    {
        
        $data = $request->all();

        $screen = new Screen;
        $screen->fill($data);

        try{
            $screen->save();

            return response()->json(
                array_merge(['request_status' => 'Operação realizada com sucesso.'], $screen->toArray())
            , 201);    
        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao adicionar tela.', 
                'message' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): ScreenResource|JsonResponse
    {
        try{
            $screen = Screen::findOrFail($id);
            return new ScreenResource($screen);
        }
        catch(ModelNotFoundException $e){
            $ids = $e->getIds();

            return response()->json([
                'request_status' => 'Erro ao realizar operação',
                'message' => "Tela não encontrada. ID: " . implode(', ', $ids)
            ], 500);
        }
    }

    /**
     * Display all the resources.
     */
    public function showAll(): AnonymousResourceCollection
    {
        $screen = Screen::all();
        return ScreenResource::collection($screen);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScreenRequest $request, int $id): JsonResponse
    {
        $data = $request->all();

        try{
            $screen = Screen::findOrFail($id);
            $screen->fill($data);
            $screen->save();

            return response()->json(
                array_merge(['request_status' => 'Update realizado com sucesso.'], $screen->toArray())
            , 200);

        }
        catch(Exception $e){

            return response()->json([
                'request_status' => 'Erro ao editar tela.', 
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
            $screen = Screen::findOrFail($id);
            $screen->delete();

            return response()->json([
                'request_status' => 'Tela excluída com sucesso.'
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao excluir tela.', 
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
