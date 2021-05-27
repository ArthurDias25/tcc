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
        ->withCount(['listings as avg_nota' => function($q){
            $q->select(DB::raw('coalesce(avg(Nota),0)'));
        }])
        ->orderByDesc('avg_nota')
        ->paginate(50);

        $positions = 1;

        $statuses = Status::orderBy('id')->get();

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
        $games = Game::with('categories','genres','developers','platforms','listings')
        ->where('Id_GameCategories','=',$id)
        ->withCount(['listings as avg_nota' => function($q){
            $q->select(DB::raw('coalesce(avg(Nota),0)'));
        }])
        ->orderByDesc('avg_nota')
        ->paginate(50);

      /*  $games = DB::table('games')
        ->with('categories','genres','developers','platforms','listings')
        ->orderByDesc('avg(listings.Nota')
        ->get();
*/

        $statuses = Status::orderBy('id')->get();
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
        $order = $request->order;
        $gen = $request->genero;
        $plat = $request->plat;

        $games = Listing::with('games','users','status')
        ->where('Id_Usuario','=',$id)
        ->where(function ($query) use($stat){
            if($stat){
                $query->where('Id_Status','=',$stat);
            }
        })
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

        $statuses = Status::orderBy('id')->get();

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
        if($request->filter == "Jogos"){
            return redirect()->route('games', [$request]);
        }

        if($request->filter == "Users"){
            return redirect()->route('users', [$request]);
        }        
    }

    public function games(Request $request){

        if($request->filter){
            $class = $request->filter;
        }else{
            $class = "Jogos";
        }
        $filters = $request->all();
        $pesquisa = $request->search;
        $genero = $request->genero;
        $plataforma = $request->plataforma;
        $desenvolvedora = $request->desenvolvedora;
        
        $games = Game::with('categories','genres','developers','platforms','listings')
        ->whereHas('genres', function($q) use($request){
            if($request->genero){
                $q->where('Id_Genero','=',$request->genero);
            }
        })
        ->whereHas('platforms', function($q) use($request){
            if($request->plataforma){
                $q->where('Id_Plataforma','=',$request->plataforma);
            }
        })
        ->whereHas('developers', function($q) use($request){
            if($request->desenvolvedora){
                $q->where('Id_Developer','=',$request->desenvolvedora);
            }
        })
        ->where(function ($query) use($request){
            if($request->search){
                $query->whereRaw('upper(Nome_Jogo) like (?)',["%".strtoupper($request->search)."%"]);
            }
        })
        ->paginate(30);

        $genres = Genre::all();
        $platforms = Platform::all();
        $developers = Developer::all();
        //$games = $this->repository->search($request->search);

        //dd($games);

        return view('public.explore',[
             'games' => $games,
             'pesquisa' => $pesquisa,
             'genero' => $genero,
             'plataforma' => $plataforma,
             'desenvolvedora' => $desenvolvedora,

             'genres' => $genres,
             'platforms' => $platforms,
             'developers' => $developers,

             'class' => $class,

             'filters' => $filters,
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
    
}
