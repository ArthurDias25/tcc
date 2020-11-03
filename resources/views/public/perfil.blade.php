@extends('layouts.app')

@section('title', $user->name.' Perfil - ')  

@section('content')

@include('layouts.banner')

<div class="container">
    <div class="row">
        <div class="col-sm-8" style="margin-top:8px">
            @if ((Auth::user()) && (Auth::user()->id == $id))
                @include('layouts.formPost')
            @endif
            @include('layouts.post')
        </div>
    
        <div class="col-sm-4">
            <div class="card mt-2">
                <div class="card-body">
                    <p class="card-text">{{$user->descricao}}</p>
                </div>
            </div>

            @if (count($gamertags) != 0)
            <div class="card mt-2">
                <div class="card-body">
                    <h5 class="card-title">Gaming Network</h5>
                    @foreach ($gamertags as $gamertag)
                        <p>
                            <img src="{{ url("storage/{$gamertag->gamertag->img}") }}" class="responsive-image mt-1" alt="" width="20" height="20">{{$gamertag->Nome}}<br>
                        </p>
                    @endforeach
                </div>
            </div>
            @endif
    
            @if (count($listings) != 0)
                <div class="card mt-2">
                    <div class="card-body">
                        <h5 class="card-title">Jogando Recentemente</h5>
                        @foreach ($listings as $listing)
                            <a href=""><img src="{{ url("storage/{$listing->games->Imagem_Jogo}") }}" class="responsive-image" alt="" width="60" ></a>
                        @endforeach
                    </div>
                </div>
            @endif
            
            @if (count($favorites) != 0)
                <div class="card mt-2">
                    <div class="card-body">
                        <h5 class="card-title">Jogos Favoritos</h5>
                        @foreach ($favorites as $favorite)
                            <a href=""><img src="{{ url("storage/{$favorite->games->Imagem_Jogo}") }}" class="responsive-image" alt="" width="60"></a>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
    
    </div>
</div>

@endsection