@extends('layouts.app')

@section('content')

<div>
    <ul class="nav nav-tabs rank">
        @if (isset($id))
            <li class="nav-item">
                <a class="nav-link" href="{{route('rank')}}">Todos os Jogos</a>
            </li>
            @foreach ($categories as $category)
                @if ($category->id == $id)
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('rank.filter',$category->id)}}">Top {{$category->Nome_GameCategory}}</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('rank.filter',$category->id)}}">Top {{$category->Nome_GameCategory}}</a>
                    </li>
                @endif
            @endforeach            
        @else
            <li class="nav-item">
                <a class="nav-link active" href="{{route('rank')}}">Todos os Jogos</a>
            </li>
            @foreach ($categories as $category)
                <li class="nav-item">
                    <a class="nav-link" href="{{route('rank.filter',$category->id)}}">Top {{$category->Nome_GameCategory}}</a>
                </li>
            @endforeach
        @endif
    </ul>
</div>

<table border="1" class="table table-striped">
    <thead style="background-color: #026d6c">
        <tr style="color: #ffffff">
            <td>Posição</td>
            <td width="100" > Imagem </td>
            <td>Nome do Jogo</td>
            <td>Genero</td>
            <td>Desenvolvedores</td>
            <td>Plataformas</td>
            <td>Nota Geral</td>
            <td>Nota</td>
            <td>Status</td>

        </tr>
    </thead>
    <tbody>
        @foreach ($games as $game)
        <tr>
            <td><p>{{$positions++}}</p></td>
            <td>
                <a href=""><img src="{{ url("storage/{$game->Imagem_Jogo}") }}" style="max-width: 100px;" ></a>
            </td>
            <td>
                <a href=""><b><p>{{$game->Nome_Jogo}}</p></b></a>
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

            </td>
            <td>
                @if (isset ($listings))
                    @php
                        $count = 0;
                    @endphp
                    @foreach ($listings as $listing)
                        @if ($listing->Id_Game == $game->id)
                            @if ($listing->Nota)
                                <p>{{$listing->Nota}}</p>
                                @php
                                    $count = 1;
                                @endphp
                            @else
                                <p>N/A</p>
                            @endif
                        @endif
                    @endforeach
                    @if ($count == 0)
                        <p>N/A</p>
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
                            <p><button type="button" class="btn btn-{{$listing->status->Status}}">{{$listing->status->Status}}</button></p>
                            @php
                                $count = 1;
                            @endphp
                        @endif
                    @endforeach
                    @if ($count == 0)
                        <p><button type="button" class="btn btn-primary">Adcionar a Lista</button></p>
                    @endif
                @else
                    <p><button type="button" class="btn btn-primary">Adcionar a Lista</button></p>
                @endif
            </td>           
        </tr>
        @endforeach    
    </tbody>
</table>
    
@endsection