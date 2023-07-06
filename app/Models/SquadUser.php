<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SquadUser extends Model
{
    protected $fillable = ['squad_id', 'user_id', 'role'];
}
