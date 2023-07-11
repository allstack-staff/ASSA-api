<?php

namespace App\Http\Resources\SquadUser;

use Illuminate\Http\Resources\Json\JsonResource;

class SquadUserResource extends JsonResource
{
    public static $wrap = null;

    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "squad_id" => $this->squad_id,
            "user_id" => $this->user_id,
            "role" => $this->role,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
