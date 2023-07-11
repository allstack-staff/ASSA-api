<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SquadUser extends Model
{
    protected $fillable = ['squad_id', 'user_id', 'role'];

    public static function findBySquadAndUser(int $squad_id, int $user_id)
    {
        return self::where('squad_id', $squad_id)
            ->where('user_id', $user_id)
            ->first();
    }
}
