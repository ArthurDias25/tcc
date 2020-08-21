@extends('layouts.app')

@section('content')

<table border="1" class="table table-striped">
    <thead style="background-color: #026d6c">
        <tr style="color: #ffffff">
            <td width="100" > Imagem </td>
            <td>Nome do Jogo</td>
            <td>Genero</td>
            <td>Desenvolvedores</td>
            <td>Plataformas</td>
            <td>Nota</td>
            <td>Status</td>

        </tr>
    </thead>
    <tbody>
        @foreach ($games as $game)
        <tr>
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
                @foreach ($game->listings as $listing)
                
                <p>{{$listing->Nota}}</p>
                    
                @endforeach
            </td>
            <td>
                @foreach ($game->listings as $listing)
                    @if ($listing->Id_Status == 1)
                        <p><button type="button" class="btn btn-outline-success">{{$listing->status->Status}}
                        
                        </button></p>
                    @elseif($listing->Id_Status == 2)
                        <p><button type="button" class="btn btn-outline-info">{{$listing->status->Status}}</button></p>
                    @elseif($listing->Id_Status == 3)
                        <p><button type="button" class="btn btn-outline-secondary">{{$listing->status->Status}}</button></p>
                    @elseif($listing->Id_Status == 4)
                        <p><button type="button" class="btn btn-outline-dark">{{$listing->status->Status}}</button></p>
                    @elseif($listing->Id_Status == 5)
                        <p><button type="button" class="btn btn-outline-warning">{{$listing->status->Status}}</button></p>
                    @elseif($listing->Id_Status == 6)
                        <p><button type="button" class="btn btn-outline-danger">{{$listing->status->Status}}</button></p>
                    @elseif($listing->Id_Status == 4)
                        <p><button type="button" class="btn btn-outline-secondary">{{$listing->status->Status}}</button></p>   
                    @else
                        <p><button type="button" class="btn btn-outline-primary">Adcionar a Lista</button></p>
                    @endif
                @endforeach
            </td>
        </tr>
        @endforeach
    
    </tbody>
</table>
    
@endsection