<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    public function rank(){
        
        $games = DB::table('games')
        ->join('game_categories', 'games.Id_GameCategories', '=', 'game_categories.id')
        ->select('games.*','game_categories.Nome_GameCategory')
        ->get();


        return view('public.rank', [
        'games' => $games,
    ]);
    }
}
