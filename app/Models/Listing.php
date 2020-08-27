<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    public function status()
    {
        return $this->belongsTo(Status::class,'Id_Status','id');
    }
    public function games()
    {
        return $this->belongsTo(Game::class,'Id_Game','id');
    }
    public function users()
    {
        return $this->belongsTo(User::class,'Id_Usuario','id');
    }
}
