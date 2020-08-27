        @if ((isset($usu_id))&&($usu_id == $user->id))
        <div class="row">
            <div class="mt-5">
                <a href="">
                    <img src="{{ url("storage/{$user->img_perfil}") }}" width="100">
                </a>
            </div>
            <div class="card mt-5 col-10">
                <div class="card-body">
                <form action="{{route('posts.store')}}" method="POST" name="postagem">
                    @csrf
                        <input type="hidden" name="Id_Pagina" value="{{$usu_id}}">
                        <div class="form-group">
                            <input type="text" class="form-control" name="Titulo" placeholder="titulo">
                        </div>
                        <div class="form-group">
                            <textarea type="text-area" rows="4" class="form-control" name="Post" placeholder="postagem"></textarea>
                        </div>
                        
                        <div class="form-group direita mr-3">
                            <button class="btn btn-outline-success my-2 my-sm-0 bg-primary text-warning" type="submit">publicar</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        @endif
        
        <!-- publicações -->

        @foreach ($posts as $post)

        <div class="row">
            <div class="mt-5">
                <a href="">
                    <img src="{{ url("storage/{$user->img_perfil}") }}" width="100">
                </a>
            </div>
            <div class="card mt-5 col-10">
                <div class="card-body">
                    <h5 class="card-title">{{$post->Titulo}}</h5>
                    <p class="card-text">{{$post->Post}}</p>
                </div>
                <div class="card-body">
                    @if (isset($usu_id))
                        @php
                            $count = 0;
                        @endphp
                        @foreach ($post->postlikes as $like)
                            @if ($like->Id_Usuario == $usu_id)
                                Oi
                                @php
                                    $count = 1;
                                @endphp
                            @endif
                            @endforeach  
                            @if ($count == 0)
                                Funcionou?
                            @endif
  
                    @else
                        Me Morri
                    @endif
                </div>
            </div>
        </div>
        @endforeach

