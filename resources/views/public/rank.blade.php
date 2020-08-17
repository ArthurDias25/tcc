@extends('layouts.app')

@section('content')

<table class="table table-striped">
    <thead>
        <tr>
            <td width="100"> Imagem </td>
            <td> Jogo </td>
            <td> Categoria </td>
            <td> Genero </td>
            <td> Desenvolvedora </td>
            <td> Plataforma </td>
            <td> Media</td>
        </tr>
    </thead>
    <tbody>

        @foreach ($games as $game)
            <tr>
                <td>
                    <img src="{{ url("storage/{$game->Imagem_Jogo}") }}" style="max-width: 100px;" >
                </td>
                <td> {{$game->Nome_Jogo}}</td>
                <td>{{ $game->Nome_GameCategory}}</td>
                <td>
                    @foreach ($genres as $genre)
                        @if ($genre->Id_Game == $game->id)
                            <p> {{$genre->genero}} </p>
                        @endif
                    @endforeach    
                </td>
                <td>
                    @foreach ($developers as $developer)
                        @if ($developer->Id_Game == $game->id)
                           <p> {{$developer->Desenvolvedora}} </p>
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($platforms as $platform)
                        @if ($platform->Id_Game == $game->id)
                           <p> {{$platform->Plataforma}} </p>
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach ($orders as $order)
                        @if ($order->Id_Game == $game->id)
                            <p> {{$order->Nota}}</p>
                        @endif
                    @endforeach
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
    
@endsection