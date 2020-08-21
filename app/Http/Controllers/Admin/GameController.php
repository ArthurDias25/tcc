<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function rank()
    {
        $games = Game::with('categories','genres','developers','platforms','listings')->get();

      
        return view('public.rank',[
            'games' => $games,
        ]);       
    }
}
