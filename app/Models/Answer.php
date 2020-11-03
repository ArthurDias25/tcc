<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'Id_Comentario', 'Resposta', 'Id_Usuario'
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'Id_Usuario','id');
    }

    public function comentario()
    {
        return $this->belongsTo(Coment::class,'Id_Comentario','id');
    }
}
