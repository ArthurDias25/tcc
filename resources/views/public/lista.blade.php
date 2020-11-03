@extends('layouts.app')

@section('title', $user->name.' - Lista - ')  

@section('content')

@include('layouts.banner')

<div class="container" style="margin-top:40px">
    <div class="row">
        <div class="col-sm-3">
            <div class="d-flex flex-column">
                <form action="{{route("list",$id)}}">                    
                    <input type="hidden" value="">
                    <div class="p-2 text-white" style="background-color: black;">
                    <b>
                        <button class="btn text-white" type="submit">Todos os Jogos</button>
                    </b>
                    </div>
                </form>
                @foreach ($statuses as $status)
                <form action="{{route("list",$id)}}">
                    <input type="hidden" name="status" value="{{$status->id}}">
                    <div class="p-2 text-white" style="background-color: black;">
                    <b>
                        <button class="btn text-white" type="submit">{{$status->Status}}</button>
                    </b>
                    </div>
                </form>
                @endforeach
                {{-- <div class="p-2 text-white" style="background-color: black;"><a class="text-white" href="#"><b>Jogando</b></a></div>
                <div class="p-2 text-white" style="background-color: black;"><a class="text-white" href="#"><b>Jogos Continuos</b></a></div>
                <div class="p-2 text-white" style="background-color: black;"><a class="text-white" href="#"><b>Completos</b></a></div>
                <div class="p-2 text-white" style="background-color: black;"><a class="text-white" href="#"><b>Pausado</b></a></div>
                <div class="p-2 text-white" style="background-color: black;"><a class="text-white" href="#"><b>Dropados</b></a></div>
                <div class="p-2 text-white" style="background-color: black;"><a class="text-white" href="#"><b>Planeja Jogar</b></a></div>
                <div class="p-2 text-white" style="background-color: black;"><a class="text-white" href="#"><b>Todos os Jogos</b></a></div> --}}
            </div>
            <br>
            <br>
            <div style="background-color: black;">
              <br>
              <center><h5 class="text-success">Filtros</h5></center>
              <div class="container">
              <form action="{{route("list",$id)}}">
                <label for="plat" style="color: white">Plataforma</label>
                <select name="plat" class="custom-select mb-3" placeholder="Plataforma">
                    <option value="">Todas</option>
                    @foreach ($platforms as $platform)
                        <option value="{{$platform->id}}">{{$platform->Plataforma}}</option>
                    @endforeach    
                </select>
                {{-- <br>
                <label for="ano" style="color: white">Ano</label>
                <select name="ano" class="custom-select mb-3">
                  <option selected>Ano</option>
                  <option value="volvo">2017</option>
                  <option value="fiat">2015</option>
                  <option value="audi">2012</option>
                </select> --}}
                <br>
                <label for="genero" style="color: white">Genero</label>
                <select name="genero" class="custom-select mb-3">
                    <option value="">Todos</option>
                  @foreach ($genres as $genre)
                    <option value="{{$genre->id}}">{{$genre->genero}}</option>
                  @endforeach
                </select>
                <button type="submit">Filtrar</button>
              </form>
              </div>
            </div>
        </div>
        <div class="col-8">
            
            <!-- Tabela de Jogando -->
            @foreach ($statuses as $status)
            
            @if ($stat)
            
            @if ($stat == $status->id)
            <div class="container" style="background-color: black;">
                <h2 class="text-success">{{$status->Status}}</h2>
            </div>  
            <table class="table table-dark table-bordered">
                <thead>
                  <tr>
                    <th width="50">Nº</th>
                    <th width="100">Capa</th>
                    <th>Nome do Jogo</th>
                    <th width="50">Nota</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($games as $game)
                        @if ($game->Id_Status == $status->id)
                        <tr>
                            <td>
                                @if (Auth::user()->id == $id)
                                    <a href="">Edit</a>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('game',$game->id)}}"><img src="{{ url("storage/{$game->games->Imagem_Jogo}") }}" style="max-width: 100px;" ></a>    
                            </td>
                            <td>
                                <a href="{{route('game',$game->id)}}"><b><p>{{$game->games->Nome_Jogo}}</p></b></a>
                                <p>{{$game->Comentarios}}</p>
                            </td>
                            <td>
                                {{$game->Nota}}
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            @endif

            @else

            <div class="container" style="background-color: black;">
                <h2 class="text-success">{{$status->Status}}</h2>
            </div>  
            <table class="table table-dark table-bordered">
                <thead>
                  <tr>
                    <th width="50">Nº</th>
                    <th width="100">Capa</th>
                    <th>Nome do Jogo</th>
                    <th width="50">Nota</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($games as $game)
                        @if ($game->Id_Status == $status->id)
                        <tr>
                            <td>
                                @if (Auth::user()->id == $id)
                                    <a href="">Edit</a>
                                @endif
                            </td>
                            <td>
                                <a href=""><img src="{{ url("storage/{$game->games->Imagem_Jogo}") }}" style="max-width: 100px;" ></a>    
                            </td>
                            <td>
                                <a href=""><b><p>{{$game->games->Nome_Jogo}}</p></b></a>
                                <p>{{$game->Comentarios}}</p>
                            </td>
                            <td>
                                {{$game->Nota}}
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

            @endif
            
            @endforeach
        </div>
        </div>
    </div>
</div>
    
@endsection