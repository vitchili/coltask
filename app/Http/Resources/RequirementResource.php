<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RequirementResource extends JsonResource
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
            'id'                => $this->id,
            'task'        => [
                'id'            => $this->resource->task->id,
            ],
            'author'      => [
                'id'            => $this->resource->author->id,
                'name'          => $this->resource->author->name,
            ],
            'requirement_description'  => $this->requirement_description,
            'solution_flow'    => $this->solution_flow,
            'obs_development'  => $this->obs_development !== null ? $this->obs_development : null,
            'feedback_QA'      => $this->feedback_QA !== null ? $this->feedback_QA : null,
            'created_at'       => $this->created_at,
            'updated_at'       => $this->updated_at,
        ];
    }
}