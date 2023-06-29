<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ModuleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id'          => $this->resource->id,
            'name'          => $this->name,
            'product'        => [
                'id'            => $this->resource->product->id,
                'name'          => $this->resource->product->name,
                'visibility'    => $this->resource->product->visibility,
            ],
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];
    }
}