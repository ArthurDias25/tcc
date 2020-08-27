<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public function users()
    {
        return $this->belongsTo(User::class,'Id_Users','id');
    }
    public function games()
    {
        return $this->belongsTo(Game::class,'Id_Jogo','id');
    }
}
