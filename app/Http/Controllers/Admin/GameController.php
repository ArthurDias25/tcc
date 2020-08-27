<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use App\Models\Game;
use App\Models\GameCategory;
use App\Models\Genre;
use App\Models\Listing;
use App\Models\Platform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function rank(Request $request)
    {
       // dd($request->all());
      // $listings = null;
        if(Auth::check()){
            $usu_id = Auth::user()->id;
            $listings = Listing::where('Id_Usuario','=',$usu_id)->get();
        }
        $games = Game::with('categories','genres','developers','platforms','listings')->get();
        $positions = 1;

   //     foreach ($games as $game){
   //         $avgs = Listing::with('games')->where('Id_Game','=',$game->id)->avg('Nota');
   //         echo "<p>$avgs</p>";
   //     }

        $categories = GameCategory::all();


    if (isset($listings)){
        return view('public.rank',[
            'games' => $games,
            'categories' => $categories,
            'positions' => $positions,
            'listings' => $listings,
            ]); 
        }else{
            return view('public.rank',[
                'games' => $games,
                'categories' => $categories,
                'positions' => $positions,
                ]); 
        }
             
    }

    public function rankFilter($id)
    {

    //    $listings = null;
        if(Auth::check()){
            $usu_id = Auth::user()->id;
            $listings = Listing::where('Id_Usuario','=',$usu_id)->get();
        }
        $games = Game::with('categories','genres','developers','platforms','listings')->where('Id_GameCategories','=',$id)->get();
        $categories = GameCategory::all();
        $category = GameCategory::find($id);
        $positions = 1;
        if (isset($listings)){
            return view('public.rank',[
                'games' => $games,
                'categories' => $categories,
                'category' => $category,
                'id' => $id,
                'listings' => $listings,
                'positions' => $positions,
            ]);       
        }
        else{
            return view('public.rank',[
                'games' => $games,
                'categories' => $categories,
                'category' => $category,
                'id' => $id,
                'positions' => $positions,
            ]);       
        }
        
        
    }
}
