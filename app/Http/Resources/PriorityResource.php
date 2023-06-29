<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PriorityResource extends JsonResource
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
            'id'          => $this->id,
            'name'        => $this->name,
            'hex_color'   => $this->hex_color,
            'is_a_bug'    => $this->is_a_bug,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
            'visibility'  => $this->visibility,
        ];
    }
}