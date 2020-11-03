<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComentLike extends Model
{
    protected $fillable = [
        'Id_Comentario', 'Id_Usuario'
    ];
}
