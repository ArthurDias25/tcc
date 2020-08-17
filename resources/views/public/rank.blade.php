@extends('layouts.app')

@section('content')

<table class="table table-striped">
    <thead>
        <tr>
            <td width="100"> Imagem </td>
            <td> Jogo </td>
            <td> Categoria </td>
            <td> Genero </td>
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
            </tr>
        @endforeach

    </tbody>
</table>
    
@endsection