@extends('layouts.app')

@section('content')

<br>
<br>

<div class="card col-12" style="background-color: black;">
    <div class="card-body">
      <p class="card-title text-white">
        <div class="form-group text-white">
          <center><h5 class="text-success"><b>Check In</b></h5></center>
        </div>
      </p>

      <form action="{{route('posts.update',$post->id)}}" method="POST" name="postagem">
        @csrf
        @method('PUT')
            <input type="hidden" name="Id_Usuario" value="{{Auth::user()->id}}">
            <input type="hidden" name="Id_CategoriaPost" value="3">
              <div class="form-group text-white">
                <label for="Id_Game">Jogo do Check In</label>
                  <select name="Id_Game" id="Id_Game">
                    <option value=""></option>
                      @foreach ($games as $game)
                        @if ($post->Id_Game == $game->id)
                            <option selected value="{{$game->id}}">{{$game->Nome_Jogo}}</option>                        
                        @else
                            <option value="{{$game->id}}">{{$game->Nome_Jogo}}</option>
                        @endif
                      @endforeach
                  </select>
              </div>
            <div class="form-group text-white">
                <label for="post"><b>Conteúdo:</b></label>
                <textarea type="text-area" rows="5" class="form-control" name="Post">{{$post->Post}}</textarea>
            </div>
            <div class="form-group direita mr-3">
                <button type="submit" class="btn btn-success" style="width: 18ch;"><span class="fas fa-paper-plane"></span><b> Enviar</b></button>
            </div>
        </form>
      
    </div>
  </div>
    
@endsection