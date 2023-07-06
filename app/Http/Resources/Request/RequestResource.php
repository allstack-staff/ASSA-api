<?php

namespace App\Http\Resources\Request;

use Illuminate\Http\Resources\Json\JsonResource;

class RequestResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "project_id" => $this->project_id,
            "squad_origin_id" => $this->squad_origin_id,
            "squad_origin_user_id" => $this->squad_origin_user_id,
            "demand_id" => $this->demand_id,
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
