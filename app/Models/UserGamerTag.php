<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserGamerTag extends Model
{
    public function gamertag()
    {
        return $this->belongsTo(GamerTag::class,'Id_GamerTag','id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'Id_Users','id');
    }
}
