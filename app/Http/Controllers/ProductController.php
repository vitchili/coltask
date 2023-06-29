<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        
        $data = $request->all();

        $product = new Product;
        $product->fill($data);

        try{
            $product->save();

            return response()->json(
                array_merge(['request_status' => 'Operação realizada com sucesso.'], $product->toArray())
            , 201);    
        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao adicionar produto.', 
                'message' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): ProductResource|JsonResponse
    {
        try{
            $product = Product::findOrFail($id);
            return new ProductResource($product);
        }
        catch(ModelNotFoundException $e){
            $ids = $e->getIds();

            return response()->json([
                'request_status' => 'Erro ao realizar operação',
                'message' => "Produto não encontrado. ID: " . implode(', ', $ids)
            ], 500);
        }
    }

    /**
     * Display all the resources.
     */
    public function showAll(): AnonymousResourceCollection
    {
        $product = Product::all();
        return ProductResource::collection($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, int $id): JsonResponse
    {
        $data = $request->all();

        try{
            $product = Product::findOrFail($id);
            $product->fill($data);
            $product->save();

            return response()->json(
                array_merge(['request_status' => 'Update realizado com sucesso.'], $product->toArray())
            , 200);

        }
        catch(Exception $e){

            return response()->json([
                'request_status' => 'Erro ao editar produto.', 
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
            $product = Product::findOrFail($id);
            $product->delete();

            return response()->json([
                'request_status' => 'Produto excluído com sucesso.'
            ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'request_status' => 'Erro ao excluir produto.', 
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
