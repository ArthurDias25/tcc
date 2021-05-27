@extends('layouts.app')

@section('title', $game->Nome_Jogo.' - ')

@section('content')

<div class="container" style="margin-top:80px">
    <div class="row">
        <div class="col-sm-3 bg-dark">
          <img src="{{ url("storage/{$game->Imagem_Jogo}") }}" class="mr-3 mt-3" style="width: 255px;">
          <br>
          <br>
          <div>
            @if (isset ($listings))
                @php
                    $count = 0;
                @endphp
                @foreach ($listings as $listing)
                    @if ($listing->Id_Game == $game->id)
                        <p><button type="button" style="width: 255px" class="btn btn-{{$listing->status->Status}}" data-toggle="modal" data-target="#edit-{{$listing->id}}-{{$game->id}}">{{$listing->status->Status}}</button></p>
                        @php
                            $count = 1;
                        @endphp
                    @endif
                    @include('layouts.listForm')
                @endforeach
                @if ($count == 0)
                    <p><button type="button" style="width: 255px" class="btn btn-primary" data-toggle="modal" data-target="#insert-{{$game->id}}"><i class="fas fa-plus" style="color: white"></i>  Adcionar a Lista</button></p>
                @endif
                @include('layouts.listForm')
            @else
                <p><button type="button" style="width: 255px" class="btn btn-primary">Adcionar a Lista</button></p>
            @endif
          </div>
          <div class="container text-white border p-3" style="width: 255px;">
            <div class="d-flex">
              <p class="text-justify">
                <h5>
                  Produtora: 
                @foreach ($game->developers as $developers)
                  {{$developers->Desenvolvedora}}
                @endforeach
                </h5>
              </p>
            </div>
            <div class="d-flex ">
              <p class="text-justify">
                <h5>
                  Plataforma: 
                @foreach ($game->platforms as $platforms)
                  {{$platforms->Plataforma}},
                @endforeach
                </h5>
              </p>
            </div>
            <div class="d-flex ">
              <p class="text-justify">
                <h5>
                  Gêneros: 
                @foreach ($game->genres as $genero)
                  {{$genero->genero}},
                @endforeach
                </h5>
              </p>
            </div>
          </div>
          <br>
        </div>
        <div class="col-sm-8" >
            <div style="background-color: black;">
              <div>              
                <br>  
                <div class="d-flex ">
                <h2 class="text-success">{{$game->Nome_Jogo}}</h2>
                </div>
            </div>
            <br>
            <div class="d-flex justify-content-between text-white ">
                <div class="p-2 border p-3">
                  <center><h6 class="text-success">Nota Geral</h6> 
                    <h2>{{number_format($game->listings->avg('Nota'),2)}}</h2>
                    <h7>{{$game->listings->count()}} Usuários</h7></center>
                </div>
                {{-- <div class="p-2 border p-3">
                    <h6 class="text-success">Posição no Rank</h6> 
                    <center><h2>Xº</h2></center>
                </div>
                <div class="p-2 border p-3">
                    <h6 class="text-success">Popularidade</h6> 
                    <center><h2>X</h2></center>
                </div> --}}
            </div>
            </div>
            <br>
            <div>
              @if (Auth::user())
                @include('layouts.formPost')            
              @endif
              @include('layouts.post')
            </div>
            {{-- <div class="d-flex justify-content-start text-white">
                <div class="p-2 dropdown">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" style="background-color: lightseagreen;">
                    Adicionar a Lista
                    </button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Jogando</a>
                    <a class="dropdown-item" href="#">Completo</a>
                    <a class="dropdown-item" href="#">Parado</a>
                    <a class="dropdown-item" href="#">Dropado</a>
                    <a class="dropdown-item" href="#">Planeja Jogar</a>
                    </div>
                </div>
                <div class="p-2"></div>
                <div class=" p-2 dropdown">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" style="background-color: lightseagreen;">
                    Adicionar a Coleção
                    </button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Normal</a>
                    <a class="dropdown-item" href="#">Royale</a>
                    </div>
                </div>
            </div>
            <br>
            <div class="d-flex text-white">
              <h4 class="text-success">Sinopse</h4>
            </div>
            <div class="d-flex">
              <p class="text-justify border p-3 text-white">
                x <br>
                x <br>
                x <br>
                x <br>
                x <br>
                x <br>
                x <br>
                x <br>
                x <br>
                x
              </p>
            </div>
            <br>
            <br> --}}
        </div>
    </div>

    
@endsection