<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [
        'Titulo', 'Post', 'Id_Game', 'Id_Pagina'
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'Id_Pagina','id');
    }

    public function postlikes(){
        return $this->hasMany(PostLike::class, 'Id_Postagem','id');
    }
}
