<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genres';

    public function games()
    {
        return $this->belongsToMany('App\Models\Game','game_genres','Id_Genero','Id_Game');
    }
}
