@extends('layouts.app')

@section('title', 'Top Jogos - ')  

@section('content')

<div class="container" style="margin-top:60px">
    <div>
        <ul class="nav nav-tabs rank">
            @if (isset($id))
                <li class="nav-item">
                    <a class="nav-link" href="{{route('rank')}}">
                        <b class="text-white">Todos os Jogos</b>
                    </a>
                </li>
                @foreach ($categories as $category)
                    @if ($category->id == $id)
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route('rank.filter',$category->id)}}">
                                <b class="text-white">Top {{$category->Nome_GameCategory}}</b>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('rank.filter',$category->id)}}">
                                <b class="text-white">Top {{$category->Nome_GameCategory}}</b>
                            </a>
                        </li>
                    @endif
                @endforeach            
            @else
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('rank')}}">
                        <b class="text-white">Todos os Jogos</b> 
                    </a>
                </li>
                @foreach ($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('rank.filter',$category->id)}}">
                            <b class="text-white">Top {{$category->Nome_GameCategory}}</b> 
                        </a>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
    
    <table class="table table-dark table-bordered">
        <thead style="background-color: #026d6c">
            <tr style="color: #ffffff">
                <td>Posição</td>
                <td width="100">Imagem</td>
                <td>Nome do Jogo</td>
                <td>Genero</td>
                <td>Desenvolvedores</td>
                <td>Plataformas</td>
                <td width="80">Nota Geral</td>
                <td width="80">Nota</td>
                <td>Status</td>
    
            </tr>
        </thead>
        <tbody>
            @foreach ($games as $game)
            <tr>
                <td><p>{{$positions++}}</p></td>
                <td>
                    <a href="{{route('game',$game->id)}}"><img src="{{ url("storage/{$game->Imagem_Jogo}") }}" style="max-width: 100px;" ></a>
                </td>
                <td>
                    <a href="{{route('game',$game->id)}}"><b><p>{{$game->Nome_Jogo}}</p></b></a>
                    <p>{{$game->categories->Nome_GameCategory}}</p> 
                </td>
                <td>
                    @foreach ($game->genres as $genre)     
                        <p>{{$genre->genero}}</p> 
                    @endforeach
                </td>
                <td>
                    @foreach ($game->developers as $developer)
                        <p>{{$developer->Desenvolvedora}}</p>
                    @endforeach
                </td>   
                <td>
                    @foreach ($game->platforms as $platform)
                        <p>{{$platform->Plataforma}}</p>
                    @endforeach
                </td>
                <td>
                    <i class="fas fa-star" style="color: yellow"></i>{{$game->listings->avg('Nota')}}
                </td>
                <td>
                    @if (isset ($listings))
                        @php
                            $count = 0;
                        @endphp
                        @foreach ($listings as $listing)
                            @if ($listing->Id_Game == $game->id)
                                @if ($listing->Nota)
                                    <p>
                                        <i class="fas fa-star" style="color: yellow"></i>{{$listing->Nota}}
                                    </p>
                                @else
                                <p>
                                    <i class="far fa-star" style="color: yellow"></i>N/A
                                </p>
                                @endif
                                @php
                                    $count = 1;
                                @endphp
                            @endif
                        @endforeach
                        @if ($count == 0)
                            <p><i class="far fa-star" style="color: yellow"></i>N/A</p>
                        @endif
                    @else
                        <p>N/A</p>
                    @endif
                </td>
                <td>
                    @if (isset ($listings))
                        @php
                            $count = 0;
                        @endphp
                        @foreach ($listings as $listing)
                            @if ($listing->Id_Game == $game->id)
                                <p><button type="button" style="width: 150px" class="btn btn-{{$listing->status->Status}}" data-toggle="modal" data-target="#edit-{{$listing->id}}">{{$listing->status->Status}}</button></p>
                                @php
                                    $count = 1;
                                @endphp
                            @endif
                            @include('layouts.listForm')
                        @endforeach
                        @if ($count == 0)
                            <p><button type="button" style="width: 150px" class="btn btn-primary" data-toggle="modal" data-target="#insert-{{$game->id}}"><i class="fas fa-plus" style="color: white"></i>  Adcionar a Lista</button></p>
                        @endif
                        @include('layouts.listForm')
                    @else
                        <p><button type="button" style="width: 150px" class="btn btn-primary">Adcionar a Lista</button></p>
                    @endif

                </td>           
            </tr>
            @endforeach    
        </tbody>
    </table>
</div>
    
@endsection