<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Game;
use App\Models\Listing;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\UserGamerTag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function perfil($id){

        $user = User::where('id','=',$id)->first();

        $posts = Post::with('users','postlikes')->where('Id_Pagina','=',$user->id)->orderByDesc('created_at')->get();

        $listings = Listing::with('users','games')->where('Id_Usuario','=',$user->id)->where('Id_Status','=',1)->get();

        $favorites = Favorite::with('users','games')->where('Id_User','=',$user->id)->get();

        $gamertags = UserGamerTag::with('users','gamertag')->where('Id_User','=',$user->id)->get();

        $games = Game::all();

        if(Auth::check()){
            $usu_id = Auth::user()->id;
            $likes = PostLike::where('Id_Usuario','=',$usu_id);
        }



        if(isset($usu_id)){
            return view('public.perfil',[
                'user' => $user,
                'posts' => $posts,
                'listings' => $listings,
                'favorites' => $favorites,
                'gamertags' => $gamertags,
                'games' => $games,
                'usu_id' => $usu_id,
                'likes' => $likes,
            ]);
        }else{
            return view('public.perfil',[
                'user' => $user,
                'posts' => $posts,
                'listings' => $listings,
                'favorites' => $favorites,
                'gamertags' => $gamertags,
                'games' => $games,
            ]);
        }


    }
}
