<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    protected $fillable = ['project_id', 'name', 'description', 'priority', 'status', 'deadline'];
}
