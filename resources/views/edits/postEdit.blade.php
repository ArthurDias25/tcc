@extends('layouts.app')

@section('content')

<br>
<br>

    <div class="card col-12" style="background-color: black;">
        <div class="card-body">
          <p class="card-title text-white">
            <div class="form-group text-white">
              <center><h5 class="text-success"><b>Postagem</b></h5></center>
            </div>
          </p>
  
          <form action="{{route('posts.update',$post->id)}}" method="POST" name="postagem">
            @csrf
            @method('PUT')
                <input type="hidden" name="Id_Usuario" value="{{Auth::user()->id}}">
                <div class="form-group text-white">
                    <label for="titulo"><b>Título:</b></label>
                    <input type="text" class="form-control" name="Titulo" value="{{$post->Titulo}}">
                </div>
                <div class="form-group text-white">
                    <label for="post"><b>Conteúdo:</b></label>
                    <textarea type="text-area" rows="5" class="form-control" name="Post">{{$post->Post}}</textarea>
                </div>
                  <div class="form-group text-white">
                    <label for="Id_Game">Jogo do Check In</label>
                      <select name="Id_Game" id="Id_Game">
                        <option value=""></option>
                        @if ($post->Id_Game)
                          <option selected value="{{$post->Id_Game}}">{{$post->games->Nome_Jogo}}</option>                            
                        @endif
                          @foreach ($games as $game)
                              <option value="{{$game->id}}">{{$game->Nome_Jogo}}</option>
                          @endforeach
                      </select>
                  </div>
                <div class="form-group direita mr-3">
                    <button type="submit" class="btn btn-success" style="width: 18ch;"><span class="fas fa-paper-plane"></span><b> Enviar</b></button>
                </div>
            </form>
          
        </div>
      </div>
    @endsection