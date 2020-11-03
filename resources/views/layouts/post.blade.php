    <!-- Posts -->

    @foreach ($posts as $post)
        <div class="row">
            <div class="card-group col-12 mt-4">
                <div class="card col-sm-3" style="background-color: black;">
                  <div class="card-body text-center">
                    <a href="{{Route('perfil',$post->users->id)}}">
                        <img  class="border" src="{{ url("storage/{$post->users->img_perfil}") }}" style="height: 15ch; width: 15ch;">
                    </a>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body ">
                    <a href="{{Route('perfil',$post->users->id)}}">
                        <b class="text-success"><h6> {{$post->users->name}} </b>
                    </a>
                     <!-- <small><i>Postado em 01 de Outubro, 2020</i></small> --> </h6>
                    <h4><p class="card-text text-left"><b>{{$post->Titulo}}</b></p></h4>
                    <p class="card-text text-justify">
                      <pre style="font-family: 'Arial'; font-size: 15px" >{{$post->Post}}</pre>  
                    </p>
                  </div>

                  <!-- Game Info -->
                  
                  @if (!isset($game_id))
                      
                    @foreach ($games as $game)
                        @if ($game->id == $post->Id_Game)
                        <div style="background-color: black; width: 100%; min-height: 220px;">
                            <div class="media border p-3">
                            <a href="{{route('game',$game->id)}}">
                                <img src="{{url("storage/{$game->Imagem_Jogo}")}}" class="mr-3" style="height: 20ch;">
                            </a>
                            <div class="media-body">
                                <a href="{{route('game',$game->id)}}">
                                    <h4 class="text-success">{{$game->Nome_Jogo}}</h4>
                                </a>
                                <p class="text-white">Plataforma: 
                                    @foreach ($game->platforms as $platform)
                                        {{$platform->Plataforma}},
                                    @endforeach
                                </p>
                                <p class="text-white"> Gênero:
                                    @foreach ($game->genres as $genre)
                                        {{$genre->genero}},
                                    @endforeach
                                </p>
                                <p class="text-white"> Desenvolvedora:
                                    @foreach ($game->developers as $developer)
                                        {{$developer->Desenvolvedora}},
                                    @endforeach
                                </p>
                                <p class="text-white"> {{count($game->listings)}} Jogadores</p>      
                            </div>
                            </div>
                        </div>
                        @endif
                    @endforeach  
                
                  @endif
                 
                  <!-- Likes -->

                  <div class="container" style="height: 40px">
                  @php
                    $count = 0;
                  @endphp
                  @if (Auth::user())
                  <div class="row direita">
                    <div class="col-10 mr-3">
                        @if (Auth::user()->id == $post->Id_Usuario) 
                            <button class="btn" data-toggle="modal" data-target="#delete">
                                <span class="fas fa-trash-alt" style="font-size: 20px; color: gray;"></span>                                    
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-body">
                                    <center>
                                        <p>Deseja deletar essa postagem?</p>
                                        <form action="{{route('posts.destroy',$post->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                            <button type="submit" class="btn btn-danger">Deletar</button>
                                        </form>
                                    </center>
                                </div>
                                </div>
                            </div>
                            </div>
                            


                            <a href="{{route('posts.edit',$post->id)}}" class="btn">                          
                                <span class="fas fa-edit" style="font-size: 20px; color: gray;"></span>                                    
                            </a>
                        @endif
                    </div>
                    @foreach ($post->postlikes as $like)
                        @if ($like->Id_Usuario == Auth::user()->id)
                            <form action="{{route ('likePost.destroy', $like->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="form-group direita mr-3">
                                    {{count($post->postlikes)}}
                                    <button class="btn"><span class="fa fa-heart" style="font-size: 20px; color: red;"></span></button>
                                </div>
                            </form>
                            @php
                                $count = 1
                            @endphp
                        @endif                        
                    @endforeach
                    @if ($count != 1)
                    <form action="{{route ('likePost.store')}}" method="POST" name="like">
                        @csrf
                        <input type="hidden" name="Id_Usuario" value="{{Auth::user()->id}}">
                        <input type="hidden" name="Id_Postagem" value="{{$post->id}}">
                        <div class="form-group direita mr-3">
                            {{count($post->postlikes)}}
                            <button class="btn"><span class="far fa-heart" style="font-size: 20px; color: gray;"></span></button>
                        </div>
                    </form>
                    @endif
                  </div>
                  @endif
                    <!-- 11 <span class="fa fa-thumbs-o-down" style="font-size: 20px; color: red;"></span> -->
                  </div>


                  <!-- Comentarios -->

                  @foreach ($comentarios as $comentario)
                      @if ($comentario->Id_Postagem == $post->id)
                      
                        <div class="media border p-3" style="background-color: black;">
                            <a href="{{Route('perfil',$comentario->users->id)}}">
                                <img src="{{ url("storage/{$comentario->users->img_perfil}") }}" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
                            </a>
                            <div class="media-body">
                                {{-- <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @if (Auth::user()->id == $comentario->users->id)
                                        <a class="dropdown-item" href="#">Editar</a>
                                        <a class="dropdown-item" href="">Deletar</a>
                                    @endif
                                    <a class="dropdown-item" href="#">Reportar</a>
                                </div> --}}
                                <a href="{{Route('perfil',$comentario->users->id)}}">
                                    <h5 class="text-white" style="text-align: left;"><b class="text-success">{{$comentario->users->name}}</b>
                                </a>
                            <!-- <small><i>Posted on February 19, 2016</i></small> --></h5>
                            <p class="text-white" style="text-align: left;">
                              {{$comentario->Comentario}}
                            </p>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="collapse" data-target="#resp{{$comentario->id}}"><b>Responder</b></button>
                            
                            <!--Campo de Resposta-->
                            <div id="resp{{$comentario->id}}" class="collapse">
                                <br>
                                @foreach ($respostas as $resposta)                                    
                                    @if ($resposta->Id_Comentario == $comentario->id)
                                            <div class="media border p-3" style="background-color: black;">
                                            <a href="{{Route('perfil',$resposta->users->id)}}">
                                                <img src="{{ url("storage/{$resposta->users->img_perfil}") }}" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
                                            </a>
                                            <div class="media-body">
                                                <a href="{{Route('perfil',$resposta->users->id)}}">
                                                    <h5 class="text-white" style="text-align: left;"><b class="text-success">{{$resposta->users->name}}</b> <!-- <small><i>Posted on February 19, 2016</i></small> --></h5>
                                                </a>
                                                <p class="text-white" style="text-align: left;">{{$resposta->Resposta}}</p>
                                            </div>
                                            </div>
                                    @endif
                                @endforeach


                                <!-- Form Respostas -->
                                @if (Auth::user())
                                <div class="media border p-3" style="background-color: black;">
                                    <img src="{{url ("storage/".auth()->user()->img_perfil)}}" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
                                <div class="media-body">
                                    <!--<form action="#" name="comentario" method="POST" name="postagem"> -->
                                    <form action="{{route('response.store')}}" method="POST" name="resposta"> 
                                        @csrf
                                        <input type="hidden" name="Id_Usuario" value="{{Auth::user()->id}}">
                                        <input type="hidden" name="Id_Comentario" value="{{$comentario->id}}">
                                        <div class="form-group">
                                            <textarea type="text-area" rows="1" class="form-control" name="Resposta" placeholder="Resposta"></textarea>
                                        </div>
                                        <div class="form-group direita mr-3">
                                            <button type="submit" class="btn btn-success btn-sm"><span class="fas fa-paper-plane"></span><b> Enviar</b></button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                                @endif
                            </div>
                          </div>
                        </div>
                      @endif
                  @endforeach

                  <div class="comentarios" comentario="{{$post->id}}"></div>

                  <!-- Form Comentario -->
                  @if (Auth::user())    
                    <div class="media border p-3" style="background-color: black;">
                        <img src="{{url ("storage/".auth()->user()->img_perfil)}}" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
                    <div class="media-body">
                        <form action="#" name="comentario" method="POST" name="comentario"> 
                            <!--   <form action="{{route('coment.store')}}" method="POST" name="postagem"> -->
                            @csrf
                            <input type="hidden" name="Id_Usuario" value="{{Auth::user()->id}}">
                            <input type="hidden" name="Id_Postagem" value="{{$post->id}}">
                            <div class="form-group">
                                <textarea type="text-area" rows="1" class="form-control" name="Comentario" placeholder="Comentario"></textarea>
                            </div>
                            <div class="form-group direita mr-3">
                                <button type="submit" class="btn btn-success btn-sm"><span class="fas fa-paper-plane"></span><b> Enviar</b></button>
                            </div>
                        </form>
                    </div>
                    </div>
                  @endif
                </div>
            </div>
        </div>
    @endforeach