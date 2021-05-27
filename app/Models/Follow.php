<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = [
        'Follower', 'Following'
    ];

    // Usuario que esta seguindo (Usado para Pagina de Seguidores)
    public function follower(){
        return $this->belongsTo(User::class,'Follower','id');
    }
    // Usuario que esta sendo seguido (Usado para Pagina de Seguindo)
    public function following()
    {
        return $this->belongsTo(User::class,'Following','id');
    }
}
