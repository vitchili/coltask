<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request): JsonResponse
    {
        $data = $request->all();

        $comment = new Comment;
        $comment->fill($data);

        try{
            
            $comment->save();

            return response()->json(
                array_merge(['request_status' => 'Operação realizada com sucesso.'], $comment->toArray())
            , 201);
        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao adicionar comentário.', 
                'message' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): CommentResource|JsonResponse
    {
        try{
            $comment = Comment::findOrFail($id);
            return new CommentResource($comment);
        }
        catch(ModelNotFoundException $e){
            $ids = $e->getIds();
            return response()->json(
                array_merge([
                    'request_status' => 'Erro ao realizar operação',
                    'message' => "Comentário não encontrado. ID: " . implode(', ', $ids)
                ])
            , 500);
            
        }
    }

    /**
     * Display all the resources.
     */
    public function showAll(): AnonymousResourceCollection
    {
        $comment = Comment::all();
        return CommentResource::collection($comment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, int $id): JsonResponse
    {
        $data = $request->all();

        try{
            $comment = Comment::findOrFail($id);
            $comment->fill($data);
            $comment->save();

            return response()->json(
                array_merge(['request_status' => 'Update realizado com sucesso.'], $comment->toArray())
            , 200);

        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao editar comentário.', 
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
            $comment = Comment::findOrFail($id);
            $comment->delete();

            return response()->json([
                'request_status' => 'Comentário excluído com sucesso.'
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao excluir comentário.', 
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
