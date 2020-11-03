<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Coment extends Model
{

    protected $fillable = [
        'Id_Postagem', 'Comentario', 'Id_Usuario'
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'Id_Usuario','id');
    }
    
    public function post()
    {
        return $this->belongsTo(Post::class,'Id_Postagem','id');
    }

    public function comentlikes(){
        return $this->hasMany(ComentLike::class, 'Id_Comentario','id');
    }
}
