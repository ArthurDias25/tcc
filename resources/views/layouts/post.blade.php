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
                    @if ($post->Id_CategoriaPost == 1)
                        <small><i>Fez um Post - {{$post->created_at}}</i></small></h6>
                    @endif
                    @if ($post->Id_CategoriaPost == 2)
                        <small><i>Escreveu um artigo - {{$post->created_at}}</i></small></h6>
                        <img src="{{url("storage/{$post->Img_Artigo}")}}" style="width: 100%">
                    @endif
                    @if ($post->Id_CategoriaPost == 3)
                        @if (!isset($game_id))
                            <small><i>Fez um Check in de:</i></small></h6>
                            {{-- </div> --}}
                              @foreach ($games as $game)
                                  @if ($game->id == $post->Id_Game)
                                  <div style="background-color: black; width: 100%; min-height: 15ch;">
                                      <div class="media border p-3">
                                      <a href="{{route('game',$game->id)}}">
                                          <img src="{{url("storage/{$game->Imagem_Jogo}")}}" class="mr-3" style="height: 15ch;">
                                      </a>
                                      <div class="media-body">
                                          <a href="{{route('game',$game->id)}}">
                                              <h4 class="text-success">{{$game->Nome_Jogo}}</h4>
                                          </a>
                                          {{-- <p class="text-white">Plataforma: 
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
                                          </p> --}}
                                          <p class="text-white"> {{count($game->listings)}} Jogadores</p>      
                                      </div>
                                      </div>
                                  </div>
                                  @endif
                              @endforeach  
                              {{-- <div class="card-body"> --}}
                        @else
                            <small><i>Fez um Check in</i></small></h6>
                        @endif
                    @endif
                    <h4><p class="card-text text-left"><b>{{$post->Titulo}}</b></p></h4>
                    <p class="card-text text-justify">
                      <pre style="font-family: 'Arial'; font-size: 15px" >{{$post->Post}}</pre>  
                    </p>
                  </div>

                  <!-- Game Info -->
                  
                  @if ($post->Id_CategoriaPost != 3)                      
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
                                    {{-- <p class="text-white">Plataforma: 
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
                                    </p> --}}
                                    <p class="text-white"> {{count($game->listings)}} Jogadores</p>      
                                </div>
                                </div>
                            </div>
                            @endif
                        @endforeach  
                    
                    @endif
                  @endif
                 
                  <!-- Likes -->

                  <div class="container" style="height: 40px">
                  @php
                    $count = 0;
                  @endphp
                  @if (Auth::user())
                  <div class="row direita">
                    <div class="col-8 mr-3">
                        
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
                    {{-- <a href="#" class="curtir btn" Id_Usuario="{{Auth::user()->id}}" Id_Postagem="{{$post->id}}">
                        <span class="far fa-heart" style="font-size: 20px; color: gray;"></span>
                    </a> --}}
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

                    <div class="dropdown col-1">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @if (Auth::user()->id == $post->Id_Usuario)
                            <a class="dropdown-item" href="{{route('posts.edit',$post->id)}}"><span class="fas fa-edit" style="font-size: 20px; color: gray;"></span>  Editar</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deletePost-{{$post->id}}"><span class="fas fa-trash-alt" style="font-size: 20px; color: gray;"></span>  Deletar</a>
                            @endif
                          {{-- <a class="dropdown-item" href="#">Something else here</a> --}}
                        </div>
                      </div>

                      <!-- Modal -->
                      <div class="modal fade" id="deletePost-{{$post->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <p style="text-align: left;">
                              <pre class="text-white" style="font-family: 'Arial'; font-size: 15px">{{$comentario->Comentario}}</pre>
                            </p>

                            {{-- Opções Comentario --}}

                            <div class="row">
                                <button type="button" class="btn btn-success btn-sm" data-toggle="collapse" data-target="#resp{{$comentario->id}}"><b>Responder</b></button>
                                <div class="dropdown col-1">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      @if ((Auth::user()) && (Auth::user()->id == $comentario->Id_Usuario))
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editComent{{$comentario->id}}"><span class="fas fa-edit" style="font-size: 20px; color: gray;"></span>  Editar</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteComent{{$comentario->id}}"><span class="fas fa-trash-alt" style="font-size: 20px; color: gray;"></span> Excluir</a>
                                      @endif
                                      {{-- <a class="dropdown-item" href="#">Reportar</a> --}}
                                    </div>
                                  </div>
                            </div>

                            <div class="modal fade" id="editComent{{$comentario->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-body">
                                        <center>
                                            <p>Editar Comentario?</p>
                                            <form action="{{route('coment.update',$comentario->id)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <textarea type="text-area" rows="1" class="form-control" name="Comentario" placeholder="Comentario">{{$comentario->Comentario}}</textarea>
                                                </div>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                                <button type="submit" class="btn btn-success">Editar</button>
                                            </form>
                                        </center>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="deleteComent{{$comentario->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-body">
                                        <center>
                                            <p>Deseja deletar essa postagem?</p>
                                            <form action="{{route('coment.destroy',$comentario->id)}}" method="POST">
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

                                            {{-- Opções Resposta --}}

                                            <div class="row">
                                                <div class="dropdown col-1">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    @if ((Auth::user()) && (Auth::user()->id == $resposta->Id_Usuario))
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editResponse{{$resposta->id}}"><span class="fas fa-edit" style="font-size: 20px; color: gray;"></span>  Editar</a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteResponse{{$resposta->id}}"><span class="fas fa-trash-alt" style="font-size: 20px; color: gray;"></span> Excluir</a>
                                                    @endif
                                                      {{-- <a class="dropdown-item" href="#">Reportar</a> --}}
                                                    </div>
                                                  </div>
                                            </div>
                
                                            <div class="modal fade" id="editResponse{{$resposta->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-body">
                                                        <center>
                                                            <p>Editar Resposta?</p>
                                                            <form action="{{route('response.update',$resposta->id)}}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <textarea type="text-area" rows="1" class="form-control" name="Resposta" placeholder="Resposta">{{$resposta->Resposta}}</textarea>
                                                                </div>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                                                <button type="submit" class="btn btn-success">Editar</button>
                                                            </form>
                                                        </center>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                
                                            <div class="modal fade" id="deleteResponse{{$resposta->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-body">
                                                        <center>
                                                            <p>Deseja deletar essa Resposta?</p>
                                                            <form action="{{route('response.destroy',$resposta->id)}}" method="POST">
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
                                            </div>
                                    @endif
                                @endforeach

                                <div class="respostas" resposta="{{$comentario->id}}"></div>

                                <!-- Form Respostas -->
                                @if (Auth::user())
                                <div class="media border p-3" style="background-color: black;">
                                    <img src="{{url ("storage/".auth()->user()->img_perfil)}}" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">
                                <div class="media-body">
                                    <!--<form action="#" name="comentario" method="POST" name="postagem"> -->
                                    <form action="#" method="POST" name="resposta"> 
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