<div class="card col-12" style="background-color: black;">
    <div class="card-body text-white">
      <div class="row">
          <div class="col-1">
              <img class="border" src="{{url ("storage/".auth()->user()->img_perfil)}}" style="height: 12ch; width: 12ch;">
          </div>
          <div class="col-11">
              <center>
                  <h5>Seja bem vindo ao Gaming Zone, <b class="text-success">{{Auth::user()->name}}</b>!</h5>
              </center>
              <center>
              <button type="button" class="btn btn-dark btn-lg" style="width: 15ch;" data-toggle="collapse" data-target="#demo"><span class="fa fa-newspaper-o"></span><b> Postagem</b></button>
              <button type="button" class="btn btn-dark btn-lg" style="width: 15ch;" data-toggle="collapse" data-target="#demo1"><span class="fa fa-archive"></span><b> Artigo</b></button>
              <button type="button" class="btn btn-dark btn-lg" style="width: 15ch;" data-toggle="collapse" data-target="#demo2"><span class="fa fa-file-text"></span><b> Check In</b></button>
              </center>
          </div>
      </div>
    </div>
  </div>
  <br>
  <div id="demo" class="collapse">
    <div class="card col-12" style="background-color: black;">
      <div class="card-body">
        <p class="card-title text-white">
          <div class="form-group text-white">
            <center><h5 class="text-success"><b>Postagem</b></h5></center>
          </div>
        </p>

        <form action="{{route('posts.store')}}" method="POST" name="postagem">
          @csrf
              <input type="hidden" name="Id_Usuario" value="{{Auth::user()->id}}">
              <div class="form-group text-white">
                  <label for="titulo"><b>Título:</b></label>
                  <input type="text" class="form-control" name="Titulo">
              </div>
              <div class="form-group text-white">
                  <label for="post"><b>Conteúdo:</b></label>
                  <textarea type="text-area" rows="5" class="form-control" name="Post"></textarea>
              </div>
              @if (isset($game_id))
                <div class="form-group text-white">
                  <label for="post"><b>Jogo do Check In:</b></label>               
                    {{$game->Nome_Jogo}}
                  <input type="hidden" name="Id_Game" value="{{$game_id}}">
                </div>                  
              @else
                <div class="form-group text-white">
                  <label for="Id_Game">Jogo do Check In</label>
                    <select name="Id_Game" id="Id_Game">
                      <option value=""></option>
                        @foreach ($games as $game)
                            <option value="{{$game->id}}">{{$game->Nome_Jogo}}</option>
                        @endforeach
                    </select>
                </div>
              @endif
              <div class="form-group direita mr-3">
                  <button type="submit" class="btn btn-success" style="width: 18ch;"><span class="fas fa-paper-plane"></span><b> Enviar</b></button>
              </div>
          </form>
        
      </div>
    </div>
  </div>      

  <div id="demo1" class="collapse">
    <div class="card" style="background-color: black;">
      <div class="card-body">
        <p class="card-title text-white">
          <div class="form-group text-white">
            <center><h5 class="text-success"><b>Artigo</b></h5></center>
            <label for="usr"><b>Título:</b></label>
            <input type="text" class="form-control" id="usr">
          </div>
        </p>
        <p class="card-text">
          <div class="form-group text-white">
            <label for="comment"><b>Conteúdo:</b></label>
            <textarea class="form-control" rows="2" id="comment" name="text"></textarea>
          </div>
        </p>
        <div class="form-group text-white">
          <label for="comment"><b>Links:</b></label>
          <textarea class="form-control" rows="1" id="comment" name="text"></textarea>
        </div>
        <div class="form-group">
          <input type="file" class="form-control-file border text-white" name="file">
        </div>
        <button type="button" class="btn btn-success" style="width: 18ch;"><span class="fas fa-paper-plane"></span><b> Enviar</b></button>
      </div>
    </div>
  </div>      

  <div id="demo2" class="collapse">
    <div class="card col-12" style="background-color: black;">
      <div class="card-body">
        <p class="card-title text-white">
          <div class="form-group text-white">
            <center><h5 class="text-success"><b>Check In</b></h5></center>
          </div>
        </p>

        <form action="{{route('posts.store')}}" method="POST" name="postagem">
          @csrf
              <input type="hidden" name="Id_Usuario" value="{{Auth::user()->id}}">
              @if (isset($game_id))
                <div class="form-group text-white">
                  <label for="post"><b>Jogo do Check In:</b></label>
                    {{$game->Nome_Jogo}}
                  <input type="hidden" name="Id_Game" value="{{$game_id}}">
                </div>                  
              @else
                <div class="form-group text-white">
                  <label for="Id_Game">Jogo do Check In</label>
                    <select name="Id_Game" id="Id_Game">
                      <option value=""></option>
                        @foreach ($games as $game)
                            <option value="{{$game->id}}">{{$game->Nome_Jogo}}</option>
                        @endforeach
                    </select>
                </div>
              @endif
              <div class="form-group text-white">
                  <label for="post"><b>Conteúdo:</b></label>
                  <textarea type="text-area" rows="5" class="form-control" name="Post"></textarea>
              </div>
              <div class="form-group direita mr-3">
                  <button type="submit" class="btn btn-success" style="width: 18ch;"><span class="fas fa-paper-plane"></span><b> Enviar</b></button>
              </div>
          </form>
        
      </div>
    </div>
  </div>      