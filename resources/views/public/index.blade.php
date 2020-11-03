@extends('layouts.app')

@section('content')

<div class="container" style="margin-top:80px">
  <div class="row">

    <div class="col-sm-8">
      @include('layouts.formPost')
      @include('layouts.post')
    </div>


    <div class="col-sm-4">
      <div class="d-flex flex-column">
        <div class="p-2 text-white" style="background-color: black;"><b>{{count($listings)}} Jogos Listados</b></div>
        <!-- <div class="p-2 text-white" style="background-color: black;"><b>15 Jogos de Coleção</b></div> -->
        <div class="p-2 text-white" style="background-color: black;"><b>{{count($seguidores)}} Seguidores</b></div>
        <div class="p-2 text-white" style="background-color: black;"><b>{{count($seguindo)}} Seguindo</b></div>
        {{-- <div class="p-2 text-white" style="background-color: black;"><b>28 Análises</b></div>  --}}
      </div>
      <br>
      <div class="d-flex flex-column">
        <center><div class="p-2 text-white" style="background-color: lightseagreen;"><h6><b>Quem Seguir</b></h6></center></div>
      
      @foreach ($users as $user)
        <div class="d-flex justify-content-between mb-3" style="background-color: black;"> 
          <div class="p-2 text-white">
            <a href="{{route ('perfil',$user->id)}}">
              <img class="rounded-circle border" src = "{{ url("storage/{$user->img_perfil}") }}" style="height: 5ch; width: 5ch;"> 
            </a>
            <a href="{{route ('perfil',$user->id)}}">
              <b  class="text-white">{{$user->name}}</b>
            </a>
          </div>
          @php
              $count = 0;
          @endphp
          @foreach ($seguindo as $s)
            @if ($s->Following == $user->id)
                <form action="{{route ('unfollow',$s->id)}}" method="POST" name="unfollow">
                    @csrf
                    {{-- @method('DELETE') --}}
                    <div class="p-2"><<button class="btn btn-danger" type="submit">Deixar de Seguir <span class="fas fa-user-minus"></span></button></div>
                </form>
                @php
                    $count = 1;
                @endphp
            @endif
          @endforeach

            @if ($count == 0)
              <form action="{{route ('follow')}}" method="POST" name="follow">
                  @csrf
                  <input type="hidden" name="Follower" value="{{Auth::user()->id}}">
                  <input type="hidden" name="Following" value="{{$user->id}}">
                  <div class="p-2"><button class="btn btn-success" type="submit">Seguir <span class="fa fa-user-plus"></span></button></div>
              </form>
            @endif
          
          {{-- <div class="p-2"><button type="button" class="btn btn-success">Seguir <span class="fa fa-user-plus"></span></button></div> --}}
        </div>
      @endforeach

  </div>
</div>
    
@endsection