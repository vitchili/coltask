<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScreenResource extends JsonResource
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
            'module'        => [
                'id'            => $this->resource->module->id,
                'name'          => $this->resource->module->name,
                'product_id'    => $this->resource->module->product_id,
                'visibility'    => $this->resource->module->visibility,
            ],
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
            'visibility'  => $this->visibility,
        ];
    }
}