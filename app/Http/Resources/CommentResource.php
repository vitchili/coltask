<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'task'        => [
                'id'            => $this->resource->task->id,
            ],
            'author'      => [
                'id'            => $this->resource->author->id,
                'name'          => $this->resource->author->name,
            ],
            'destinatary' => [
                'id'            => $this->resource->destinatary->id,
                'name'          => $this->resource->destinatary->name,
            ],
            'comment'     => $this->comment,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
            'visibility'  => $this->visibility,
        ];
    }
}