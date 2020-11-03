@extends('layouts.app')

@section('content')

<br>
<br>
<br>
<br>
<br>
<br>


@foreach ($games as $game)
<p class="text-white">{{$game->Nome_Jogo}}</p>
@endforeach


@endsection