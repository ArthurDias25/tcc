<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'games';


    public function categories()
    {
        return $this->belongsTo(GameCategory::class,'Id_GameCategories','id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class,'game_genres','Id_Game','Id_Genero');
    }

    public function developers()
    {
        return $this->belongsToMany(Developer::class,'game_developers','Id_Game','Id_Developer');
    }

    public function platforms()
    {
        return $this->belongsToMany(Platform::class,'game_ports','Id_Game','Id_Plataforma');
    }

    public function listings()
    {
        return $this->hasMany(Listing::class,'Id_Game','id');
    }

    public function posts(){
        return $this->hasMany(Post::class,'Id_Game','id');
    }

    public function search($search = null){
        $results = $this->where(function ($query) use($search){
            if($search){
                $query->where('Nome_Jogo','like',"%{$search}%");
            }
        });

        return $results;

        //dd($results);

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
