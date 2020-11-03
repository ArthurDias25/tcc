
<div class="perfil">
    <div class="capa" style="background-image:url({{url("storage/{$user->img_capa}")}})">
       <div class="container">
            <img src="{{ url("storage/{$user->img_perfil}") }}" width="160">
            <h1 class="nome">{{$user->name}}</h1>
        </div>
    </div>

    <div class="row barra2">
        <div class="col-3">
        </div>
        <div class="col-6">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    @if ($url == "Perfil")
                        <a class="nav-link active" href="{{Route('perfil',$id)}}"> <b>Postagens</b></a>
                    @else
                        <a class="nav-link" href="{{Route('perfil',$id)}}"> <b class="text-white">Postagens</b></a>
                    @endif
                </li>
                <li class="nav-item">
                    @if ($url == "Lista")
                        <a class="nav-link active" href="{{Route('list',$id)}}"><b>Game List</b></a>                    
                    @else
                        <a class="nav-link" href="{{Route('list',$id)}}"><b class="text-white">Game List</b></a>
                    @endif
                </li>
                <!--
                <li class="nav-item">
                    <a class="nav-link" id="collection-tab" data-toggle="tab" href="#collection" role="tab" aria-controls="collection" aria-selected="false">collection list</a>
                </li>
                -->
            </ul>
        </div>
        <div class="col-3">
            <div class="p-1">
            @if ((Auth::user()) && (Auth::user()->id == $id))
                <a href="{{route('userForm',$id)}}">
                    
                        <button class="btn btn-secondary">Editar Perfil</button>
                    
                </a>
            @endif
            @if ((Auth::user()) && (Auth::user()->id != $id))
                @if (!$follow)
                    <form action="{{route ('follow')}}" method="POST" name="follow">
                        @csrf
                        <input type="hidden" name="Follower" value="{{Auth::user()->id}}">
                        <input type="hidden" name="Following" value="{{$id}}">
                        <button class="btn btn-success" type="submit">Seguir <span class="fa fa-user-plus"></span></button>
                    </form>
                @else
                    <form action="{{route ('unfollow',$follow->id)}}" method="POST" name="unfollow">
                        @csrf
                        {{-- @method('DELETE') --}}
                        <button class="btn btn-danger" type="submit">Deixar de Seguir <span class="fas fa-user-minus"></span></button>
                    </form>
                @endif
            @endif
        </div>
        </div> 
    </div>    
</div>