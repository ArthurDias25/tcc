@extends('layouts.app')

@section('content')


<div class="perfil">

    <div class="capa" style="background-image:url({{url("storage/{$user->img_capa}")}})">
       <div class="container">
            <a href="">
                <img src="{{ url("storage/{$user->img_perfil}") }}" width="160">
            </a>
            <h1 class="nome">{{$user->name}}</h1>
        </div>
    </div>

    <div class="row barra2">
        <div class="col-3">
        </div>
        <div class="col-6">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="postagem-tab" data-toggle="tab" href="#postagem" role="tab" aria-controls="postagem" aria-selected="true">Postagem</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="game-tab" data-toggle="tab" href="#game" role="tab" aria-controls="game" aria-selected="false">Game List</a>
                </li>
                <!--
                <li class="nav-item">
                    <a class="nav-link" id="collection-tab" data-toggle="tab" href="#collection" role="tab" aria-controls="collection" aria-selected="false">collection list</a>
                </li>
                -->
            </ul>
        </div>
        <div class="col-3">
            <button class="btn">Seguindo</button>
            <button class="btn">Seguidores</button>
        </div>
    </div>    
</div>

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="postagem" role="tabpanel" aria-labelledby="postagem-tab">
        <div class="row">
            <div class="col-1 p-5 ">
            </div>

            <div class="col-7">
                @include('layouts.post')
            </div>

            <div class="col-3">
                <div class="card mt-2">
                    <div class="card-body">
                        <p class="card-text">descrição</p>
                    </div>
                </div>
                @if ($gamertags)
                <div class="card mt-2">
                    <div class="card-body">
                        <h5 class="card-title">gaming network</h5>
                        @foreach ($gamertags as $gamertag)
                            <p>
                                <img src="{{ url("storage/{$gamertag->gamertag->img}") }}" class="responsive-image mt-1" alt="" width="20" height="20">{{$gamertag->Nome}}<br>
                            </p>
                        @endforeach
                    </div>
                </div>
                @endif

                @if (!empty($listings))
                    <div class="card mt-2">
                        <div class="card-body">
                            <h5 class="card-title">Jogando Recentemente</h5>
                            @foreach ($listings as $listing)
                                <a href=""><img src="{{ url("storage/{$listing->games->Imagem_Jogo}") }}" class="responsive-image" alt="" width="60" ></a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="card mt-2">
                    <div class="card-body">
                        <h5 class="card-title">Jogos Favoritos</h5>
                        @foreach ($favorites as $favorite)
                            <a href=""><img src="{{ url("storage/{$favorite->games->Imagem_Jogo}") }}" class="responsive-image" alt="" width="60"></a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="tab-pane fade" id="game" role="tabpanel" aria-labelledby="game-tab">
        <div class="row">
            <div class="col-3">
                <div class="card mt-2">
                    <div class="card-body">
                        <p class="card-text">jogando</p>
                        <hr>
                        <p class="card-text">jogando continuamente</p>
                        <hr>
                        <p class="card-text">completos</p>
                        <hr>
                        <p class="card-text">pausados</p>
                        <hr>
                        <p class="card-text">dropados</p>
                        <hr>
                        <p class="card-text">planeja jogar</p>
                        <hr>
                        <p class="card-text">todos os jogos</p>
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="card-body">
                        <p class="card-text">filtros</p><br>
                        <p class="card-text">plataforma</p>
                        <hr>
                        <p class="card-text">ano</p>
                        <hr>
                        <p class="card-text">genero</p>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="card mt-2">
                    <div class="card-body">
                        <h2>jogando</h2>
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th scope="col">n</th>
                                    <th scope="col">capa</th>
                                    <th scope="col">nome</th>
                                    <th scope="col">nota</th>
                                    <th scope="col">plataforma</th>
                                    <th scope="col">checks in's</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td><img src="https://picsum.photos/1801/1800" class="responsive-image" alt="" width="60" height="90"></td>
                                    <td>assasins creed<br>comentarios</td>
                                    <td>7</td>
                                    <td>ps3</td>
                                    <td>exibir</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td><img src="https://picsum.photos/1802/1800" class="responsive-image" alt="" width="60" height="90"></td>
                                    <td>sla<br>comentarios</td>
                                    <td>8</td>
                                    <td>ps3</td>
                                    <td>exibir</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td><img src="https://picsum.photos/1803/1800" class="responsive-image" alt="" width="60" height="90"></td>
                                    <td>sei la 3<br>comentarios</td>
                                    <td>9</td>
                                    <td>ps3</td>
                                    <td>exibir</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</div>
    
@endsection