<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = [
        'project_id',
        'squad_origin_id',
        'squad_origin_user_id',
        'demand_id',
        'name',
        'description',
        'priority',
        'status',
        'deadline'
    ];
}
