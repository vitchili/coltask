<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'id'     => $this->resource->id,
            'client' => [
                'client_id'     => $this->client_id,
                'client_name'   => $this->resource->client->name,
                'created_at'    => $this->resource->client->created_at,
                'updated_at'    => $this->resource->client->updated_at,
                'visibility'    => $this->resource->client->visibility,
            ],
            'email_copy'        => $this->email_copy,
            'outside_requester' => $this->outside_requester,
            'type' => [
                'type_id'       => $this->type,
                'type_name'     => $this->resource->getTypeName(),
            ],
            'title'             => $this->title,
            'description'       => $this->description,
            'direction' => [
                'id'            => $this->resource->direction->id,
                'name'          => $this->resource->direction->name,
                'slang'         => $this->resource->direction->slang,
                'created_at'    => $this->resource->direction->created_at,
                'updated_at'    => $this->resource->direction->updated_at,
            ],
            'product' => [
                'id'            => $this->resource->screen->module->product->id,
                'name'          => $this->resource->screen->module->product->name,
                'created_at'    => $this->resource->screen->module->product->created_at,
                'updated_at'    => $this->resource->screen->module->product->updated_at,
                'visibility'    => $this->resource->screen->module->product->visibility,
            ],
            'module' => [
                'id'            => $this->resource->screen->module->id,
                'name'          => $this->resource->screen->module->name,
                'created_at'    => $this->resource->screen->module->created_at,
                'updated_at'    => $this->resource->screen->module->updated_at,
                'visibility'    => $this->resource->screen->module->visibility,
            ],
            'screen' => [
                'id'            => $this->screen_id,
                'name'          => $this->resource->screen->name,
                'created_at'    => $this->resource->screen->created_at,
                'updated_at'    => $this->resource->screen->updated_at,
                'visibility'    => $this->resource->screen->visibility,
            ],
            'priority' => [
                'id'            => $this->resource->priority->id,
                'name'          => $this->resource->priority->name,
                'hex_color'     => $this->resource->priority->hex_color,
                'is_a_bug'      => $this->resource->priority->is_a_bug,
                'created_at'    => $this->resource->priority->created_at,
                'updated_at'    => $this->resource->priority->updated_at,
                'visibility'    => $this->resource->priority->visibility,
            ],
            'dead_line'         => $this->dead_line,
            'attachment_json'   => $this->attachment_json,
            'sponsor' => [
                'id'            => $this->resource->sponsor !== null ? $this->resource->sponsor->id : null,
                'name'          => $this->resource->sponsor !== null ? $this->resource->sponsor->name : null,
            ],
            'started_at'        => $this->started_at,
            'modification'      => $this->modification,
            'modification_finished_at' => $this->modification_finished_at,
            'branch'            => $this->branch,
            'approved_or_failed'=> $this->approved_or_failed,
            'approved_or_failed_by' => $this->approved_or_failed_by,
            'last_approval'     => $this->last_approval,
            'last_failed'       => $this->last_failed,
            'deployed'          => $this->deployed,
            'deployed_at'       => $this->deployed_at,
            'canceled'          => $this->canceled,
            'created_by'        => $this->created_by,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
            'fase' => [
                'id'            => $this->resource->fase->id,
                'name'          => $this->resource->fase->name,
            ],
            'sprint' => [
                'id'            => $this->resource->sprint !== null ? $this->resource->sprint->id : null,
                'title'         => $this->resource->sprint !== null ? $this->resource->sprint->title : null,
                'description'   => $this->resource->sprint !== null ? $this->resource->sprint->description : null,
                'dead_line'     =>  $this->resource->sprint !== null ? $this->resource->sprint->dead_line : null,
                'created_by'    => $this->resource->sprint !== null ? $this->resource->sprint->created_by : null,
                'created_at'    => $this->resource->sprint !== null ? $this->resource->sprint->created_at : null,
                'updated_at'    => $this->resource->sprint !== null ? $this->resource->sprint->updated_at : null,
            ],
            'visibility'        => $this->visibility,
        ];
    }
}