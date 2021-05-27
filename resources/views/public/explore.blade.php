@extends('layouts.app')

@section('content')


<div class="container" style="margin-top:60px">
    <h1 class="text-success">Pesquisa de Jogos</h1>
    <div class="row">
        <div class="col-sm-12">
            <form class="form-inline" action="{{route('games')}}">
                @csrf
                <div class="form-group">
                    <div class="d-flex flex-column">
                        <label for="search" style="color: white">Pesquisa</label>
                        <input class="form-control mr-sm-2" name="search" type="text" placeholder="Search" style="width: 40ch;"
                        @if (isset($pesquisa))
                            value="{{$pesquisa}}"
                        @endif
                        >
                    </div>
                </div>
                <div class="form-group">
                    <div class="d-flex flex-column"> 
                        <label for="genero" style="color: white">Genero</label>
                        <select name="genero" class="btn custom-select">
                            <option selected value="">Todos</option>
                        @foreach ($genres as $genre)
                            @if ($genre->id == $genero)
                                <option selected value="{{$genre->id}}">{{$genre->genero}}</option>
                            @else
                                <option value="{{$genre->id}}">{{$genre->genero}}</option>
                            @endif
                        @endforeach
                        </select>
                    </div> 
                </div>
                <div class="form-group">
                    <div class="d-flex flex-column"> 
                        <label for="plataforma" style="color: white">Plataforma</label>
                        <select name="plataforma" class="btn custom-select">
                            <option selected value="">Todos</option>
                        @foreach ($platforms as $platform)
                            @if ($platform->id == $plataforma)
                                <option selected value="{{$platform->id}}">{{$platform->Plataforma}}</option>
                            @else
                                <option value="{{$platform->id}}">{{$platform->Plataforma}}</option>
                            @endif
                        @endforeach
                        </select>
                    </div> 
                </div>
                <div class="form-group mr-sm-2">
                    <div class="d-flex flex-column"> 
                        <label for="desenvolvedora" style="color: white">Desenvolvedora</label>
                        <select name="desenvolvedora" class="btn custom-select">
                            <option selected value="">Todos</option>
                        @foreach ($developers as $developer)
                            @if ($developer->id == $desenvolvedora)
                                <option selected value="{{$developer->id}}">{{$developer->Desenvolvedora}}</option>
                            @else
                                <option value="{{$developer->id}}">{{$developer->Desenvolvedora}}</option>
                            @endif
                        @endforeach
                        </select>
                    </div> 
                </div>
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-success">Pesquisar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="container" style="margin-top:40px">
    <div class="row">
        <!--inicio card-->
        @foreach ($games as $game)
            <div class="col-2 mt-2">
                <a href="{{route('game',$game->id)}}">
                    <div class="card" style="background-color: #585858">
                        <img src="{{ url("storage/{$game->Imagem_Jogo}") }}" class="card-img-top">
                        <div class="card-body" style="color: white">
                            {{$game->Nome_Jogo}}
                        </div>
                    </div>
                </a>
            </div>            
        @endforeach
        <!--fim card-->

        <!--td aqui dentro-->
    </div>
</div>

<br>
<br>

@if (isset($filters))
    {!! $games->appends($filters)->links() !!}
@else
    {!! $games->links() !!}
@endif


@endsection