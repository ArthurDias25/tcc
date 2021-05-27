<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $request;
    private $repository;

    public function __construct(Request $request, Post $post)
    {
        $this->request = $request;
        $this->repository = $post;
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if($request->hasFile('Img_Artigo')){
            if($request->Img_Artigo->isValid()){
                $path = "artigo";
                $file = $request->Img_Artigo;
                $extension = $file->getClientOriginalExtension();
                $filename = time() .".". $extension;
                $file->storeAs('artigo',$filename);
                $Img_Artigo = $path ."/". $filename;
                //dd($Img_Artigo);
                $request->Img_Artigo = $Img_Artigo;
                //dd($request->Img_Artigo);
            }
        };

        $data = $request->all();

        //dd($data);

        Post::create($data);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::with('games')->where('id','=',$id)->first();

        $games = Game::with('categories','genres','developers','platforms','listings')
        ->get();

        if($post->Id_CategoriaPost == 1){
            return view('edits.postEdit',[
                'post' => $post,
                'games' => $games,
            ]);
        }
        if($post->Id_CategoriaPost == 3){
            return view('edits.checkinEdit',[
                'post' => $post,
                'games' => $games,
            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$post = $this->repository->find($id)){
            return redirect()->back();
        }

        $post->Titulo = $request->Titulo;

        $post->Post = $request->Post;

        $post->Id_Game = $request->Id_Game;

        $post->save();

        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = $this->repository->where('id', $id)->first();

        if(!$post){
            return redirect()->back();
        }
        $post->Deleted = 1;
        $post->Info = "Deletado pelo Usuario";
        $post->save();
        return redirect()->back();
    }
}
