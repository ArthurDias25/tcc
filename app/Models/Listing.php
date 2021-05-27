<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $fillable = [
        'Id_Game', 'Id_Usuario','Id_Status','Comentarios', 'Nota' , 'Favorite', 'Inicio', 'Finalização'
    ];

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

    public function listStatusFilter($status = null){
        $results = $this->where(function ($query) use($status){
            if($status){
                $query->where('Id_Status','=',$status);
            }
        });

        return $results;

        //dd($results);

    }

}
