<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Coment;
use App\Models\Developer;
use App\Models\Follow;
use App\Models\Game;
use App\Models\GameCategory;
use App\Models\Genre;
use App\Models\Listing;
use App\Models\Platform;
use App\Models\Post;
use App\Models\Status;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class GameController extends Controller
{

    protected $request;
    private $repository;

    public function __construct(Request $request, Listing $game)
    {
        $this->request = $request;
        $this->repository = $game;
    }

    public function rank(Request $request)
    {
       // dd($request->all());
      // $listings = null;
        if(Auth::check()){
            $usu_id = Auth::user()->id;
            $listings = Listing::where('Id_Usuario','=',$usu_id)->get();
        }

        $games = Game::with('categories','genres','developers','platforms','listings')
        //->orderBy('Nome_Jogo')
        ->get();

        $positions = 1;

        $statuses = Status::all();

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
            'statuses' => $statuses,
            ]); 
        }else{
            return view('public.rank',[
                'games' => $games,
                'categories' => $categories,
                'positions' => $positions,
                'statuses' => $statuses,
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

      /*  $games = DB::table('games')
        ->with('categories','genres','developers','platforms','listings')
        ->orderByDesc('avg(listings.Nota')
        ->get();
*/

        $statuses = Status::all();

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
                'statuses' => $statuses,
            ]);       
        }else{
            return view('public.rank',[
                'games' => $games,
                'categories' => $categories,
                'category' => $category,
                'id' => $id,
                'positions' => $positions,
                'statuses' => $statuses,
            ]);       
        }
    }

    public function listing(Request $request, $id){

        $stat = $request->status;
        $gen = $request->genero;
        $plat = $request->plat;

        $games = Listing::with('games','users','status')
        ->where('Id_Usuario','=',$id)
        ->where(function ($query) use($stat){
            if($stat){
                $query->where('Id_Status','=',$stat);
            }
        })
        ->orderByDesc('Nota')
        ->get();

        

        $statuses = Status::with('listings')->orderBy('id')->get();

        $platforms = Platform::all();
        $genres = Genre::all();
        $categories = GameCategory::all();
        $developers = Developer::all();

        $user = User::where('id','=',$id)->first();

        $follow = null;
        if(Auth::user()){
            $follow = Follow::where('Follower','=',Auth::user()->id)
            ->where('Following','=',$id)
            ->first();
        }

        $url = "Lista";

        return view('public.lista',[
            'games' => $games,
            'statuses' => $statuses,
            'user' => $user,
            'platforms' => $platforms,
            'genres' => $genres,
            'categories' => $categories,
            'developers' => $developers,
            'id' => $id,
            'url' => $url,
            'stat' => $stat,
            'follow' => $follow,
        ]);
    }

    public function game($game_id){
        $game = Game::with('categories','genres','developers','platforms','listings')
        ->where('id','=',$game_id)
        ->first();

        $listings = null;
        
        if(Auth::check()){
            $listings = Listing::where('Id_Usuario','=',Auth::user()->id)->get();
        }

        $posts = Post::with('users','postlikes','comentarios','games')
        ->where('Id_Game','=',$game_id)
        ->orderByDesc('created_at')->get();
        
        $comentarios = Coment::with('users','post','comentlikes')->get();

        $respostas = Answer::with('users','comentario')->get();

        $statuses = Status::all();

        return view('public.game',[
            'game' => $game,
            'posts' => $posts,
            'comentarios' => $comentarios,
            'respostas' => $respostas,
            'game_id' => $game_id,
            'listings' => $listings,
            'statuses' => $statuses,
        ]);
    }

    public function search(Request $request){

        //dd($request->search);

        $pesquisa = $request->search;

        $games = Game::with('categories','genres','developers','platforms','listings')
        ->where(function ($query) use($request){
            if($request){
                $query->where('Nome_Jogo','like',"%{$request->search}%");
            }
        })
        ->get();
        //$games = $this->repository->search($request->search);

        //dd($games);

        return view('public.explore',[
             'games' => $games,
             'pesquisa' => $pesquisa,
         ]);
    }

    public function listStore(Request $request){
        $data = $request->all();
        Listing::create($data);
        return redirect()->back();
    }

    public function listEdit(Request $request, $id){
        if (!$listing = $this->repository->find($id)){
            return redirect()->back();
        }
        $listing->update($request->all());
        return redirect()->back();
    }
    
    public function dinamic(Request $request){

        $games = Game::where(function ($query) use($request){
            if($request){
                $query->where('Nome_Jogo','like',"%{$request->search}%");
            }
        })
        ->first();

        echo json_encode($games);
    }
}
