<?php

namespace App\Http\Resources\Demand;

use Illuminate\Http\Resources\Json\JsonResource;

class DemandResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "project_id" => $this->project_id,
            "name" => $this->name,
            "description" => $this->description,
            "priority" => $this->priority,
            "status" => $this->status,
            "deadline" => $this->deadline,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
