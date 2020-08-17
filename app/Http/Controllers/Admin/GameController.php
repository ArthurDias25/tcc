<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    public function rank(){
        
        $orders = DB::table('listings')
        ->join('games','games.id','=','listings.Id_Game')
        ->select('listings.Nota','listings.Id_Game','games.id')
        ->get();


        $games = DB::table('games')
        ->join('game_categories', 'games.Id_GameCategories', '=', 'game_categories.id')
        ->select('games.*','game_categories.Nome_GameCategory')
        ->get();


        $genres = DB::table('game_genres')
        ->join('games','game_genres.Id_Game','=','games.id')
        ->join('genres','genres.id','=','game_genres.Id_Genero')
        ->select('game_genres.*','games.id','genres.genero')
        ->get();
        
        $developers = DB::table('game_developers')
        ->join('games','games.id','=','game_developers.Id_Game')
        ->join('developers','developers.id','=','game_developers.Id_Developer')
        ->select('game_developers.*','developers.Desenvolvedora','games.id')
        ->get();

        $platforms = DB::table('game_ports')
        ->join('games','games.id','=','game_ports.Id_Game')
        ->join('platforms','platforms.id','=','game_ports.Id_Plataforma')
        ->select('game_ports.*','games.id','platforms.Plataforma')
        ->get();
        
        return view('public.rank', [
        'games' => $games,
        'developers' => $developers,
        'genres' => $genres,
        'platforms' => $platforms,
        'orders' => $orders
    ]);
    }
}
