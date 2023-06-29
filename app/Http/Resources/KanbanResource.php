<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KanbanResource extends JsonResource
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
            'user'        => [
                'id'            => $this->resource->user->id,
                'name'          => $this->resource->user->name,
            ],
            'sprint'      => [
                'id'            => $this->resource->sprint !== null ? $this->resource->sprint->id : null,
                'title'         => $this->resource->sprint !== null ? $this->resource->sprint->title : null,
                'description'   => $this->resource->sprint !== null ? $this->resource->sprint->description : null,
            ],
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
            
        ];
    }
}