@extends('layouts.app')

@section('content')


<div class="container" style="margin-top:60px">
    <h1 class="text-success">Pesquisa de Usuarios</h1>
    <div class="row">
        <div class="col-sm-12">
            <form class="form-inline" action="{{route('users')}}">
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
        @foreach ($users as $user)
            <div class="col-2 mt-2">
                <a href="{{route('perfil',$user->id)}}">
                    <div class="card" style="background-color: #585858">
                        <img src="{{ url("storage/{$user->img_perfil}") }}" class="card-img-top">
                        <div class="card-body" style="color: white">
                            {{$user->name}}
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
{{-- 
@if (isset($filters))
    {!! $user->appends($filters)->links() !!}
@else
    {!! $user->links() !!}
@endif --}}


@endsection