<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Coment;
use App\Models\Favorite;
use App\Models\Follow;
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
    protected $request;
    private $repository;

    public function __construct(Request $request, User $user)
    {
        $this->request = $request;
        $this->repository = $user;
    }


    public function perfil($id){

        $user = User::where('id','=',$id)->first();

        if($user == null)
        {
            echo ('Usuario Inexistente');
        }else{

        $posts = Post::with('users','postlikes','comentarios','games')
        ->where('Id_Usuario','=',$user->id)
        ->where('Deleted','!=',1)
        ->orderByDesc('created_at')->get();

        $comentarios = Coment::with('users','post','comentlikes')->get();

        $respostas = Answer::with('users','comentario')->get();

        $listings = Listing::with('users','games')->where('Id_Usuario','=',$user->id)->where('Id_Status','=',1)->get();

        $favorites = Listing::with('users','games')->where('Id_Usuario','=',$user->id)->where('Favorite','=',1)->get();

        $gamertags = UserGamerTag::with('users','gamertag')->where('Id_User','=',$user->id)->get();

        $games = Game::with('categories','genres','developers','platforms','listings')
        ->get();

        $follow = null;
        if(Auth::user()){
            $follow = Follow::where('Follower','=',Auth::user()->id)
            ->where('Following','=',$id)
            ->first();
        }

        $url = "Perfil";

        return view('public.perfil',[
            'user' => $user,
            'posts' => $posts,
            'listings' => $listings,
            'favorites' => $favorites,
            'gamertags' => $gamertags,
            'games' => $games,
            'comentarios' => $comentarios,
            'respostas' => $respostas,
            'id' => $id,
            'follow' => $follow,
            'url' => $url,
        ]);

        }
        }


    public function index(){

        $listings = Listing::where('Id_Usuario','=',Auth::user()->id)->get();

        $seguindo = Follow::where('Follower','=',Auth::user()->id)->get();
        $seguidores = Follow::where('Following','=',Auth::user()->id)->get();

        $s[] = Auth::user()->id;

        foreach ($seguindo as $seg){
            $s[] += $seg->Following;
        }
        //$s += Auth::user()->id;

        //dd($s);

        $posts = Post::with('users','postlikes','comentarios','games')
        ->whereIn('Id_Usuario', $s)
        ->where('Deleted','!=',1)
        ->orderByDesc('created_at')->get();

        $comentarios = Coment::with('users','post','comentlikes')->get();

        $respostas = Answer::with('users','comentario')->get();

        $games = Game::with('categories','genres','developers','platforms','listings')
        ->get();

        $users = User::whereNotIn('id',$s)
        ->inRandomOrder()
        ->paginate(3);

        return view('public.index',[
            'posts' => $posts,
            'comentarios' => $comentarios,
            'respostas' => $respostas,
            'listings' => $listings,
            'seguindo' => $seguindo,
            'seguidores' => $seguidores,
            'games' => $games,
            'users' => $users,
        ]);

    }

    public function editPerfil(Request $request, $id){
        
        if (!$user = $this->repository->find($id)){
            return redirect()->back();
        }

        $name = ($request->name);

        $user->name = str_replace(' ','', $name);

        $user->descricao = $request->descricao;

        if($request->hasFile('img_perfil')){
            if($request->img_perfil->isValid()){
                $path = "perfil";
                $file = $request->img_perfil;
                $extension = $file->getClientOriginalExtension();
                $filename = $user->id .".". $extension;
                $file->storeAs('perfil',$filename);
                $user->img_perfil = $path ."/". $filename;
            }
        }
        if($request->hasFile('img_capa')){
            if($request->img_capa->isValid()){
                $path = "capa";
                $file = $request->img_capa;
                $extension = $file->getClientOriginalExtension();
                $filename = $user->id .".". $extension;
                $file->storeAs('capa',$filename);
                $user->img_capa = $path ."/". $filename;
            }
        }
        
        $user->save();

        return redirect()->route('perfil',$id);
    }

    public function follow(Request $request){
        $data = $request->all();
        Follow::create($data);
        return redirect()->back();
    }

    public function unfollow($id){
        $follow = Follow::where('id','=',$id)->first();;
        if(!$follow)
            return redirect()->back();

        $follow->delete();
        return redirect()->back();
    }

}
