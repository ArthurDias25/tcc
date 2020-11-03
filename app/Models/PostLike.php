<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{

    protected $fillable = [
        'Id_Postagem', 'Id_Usuario'
    ];

    public function post(){
        return $this->belongsTo(Post::class, 'Id_Postagem','id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'Id_Usuario','id');
    }
}
