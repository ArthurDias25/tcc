<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [
        'Titulo', 'Post', 'Id_Game', 'Id_Usuario'
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'Id_Usuario','id');
    }

    public function postlikes(){
        return $this->hasMany(PostLike::class, 'Id_Postagem','id');
    }

    public function comentarios(){
        return $this->hasMany(Coment::class, 'Id_Postagem','id');
    }

    public function games(){
        return $this->belongsTo(Game::class,'Id_Game','id');
    }
}
