<?php

namespace Modules\Task\Resources;

use App\Resources\JsonResource;
use Modules\User\Resources\UserResource;

class TaskResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'agent_id' => $this->agent_id,
            'type' => $this->type,
            'name' => $this->name,
            'description' => $this->description,
            'execution_comment' => $this->execution_comment,
            'deadline' => $this->deadline->format('d.m.Y'),
            'agent_status' => $this->agent_status,
            'admin_status' => $this->admin_status,
            'created_at' => $this->created_at->format('d.m.Y H:i:s'),
            'updated_at' => $this->updated_at->format('d.m.Y H:i:s'),
            'is_deleted' => (bool)$this->deleted_at,

            'agent' => UserResource::make($this->whenLoaded('agent')),
            'reports' => TaskReportResource::collection($this->whenLoaded('reports')),
        ];
    }
}
