<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'name'        => $this->resource->name,
            'created_at'  => $this->resource->created_at,
            'updated_at'  => $this->resource->updated_at,
            'visibility'  => $this->resource->visibility,
        ];
    }
}