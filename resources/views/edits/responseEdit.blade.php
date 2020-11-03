<div class="card-body">
    @if (isset($usu_id))
        <div class="row">
            <div class="mt-2">
                <img src="{{ url("storage/{$user->img_perfil}") }}" width="50">
            </div>
            <div class="mt-2 col-10">
             <!--   <form action="#" name="comentario" method="POST" name="postagem"> -->
                <form action="{{route('response.store')}}" method="POST" name="postagem"> 
                    @method('PUT')
                    @csrf
                        <input type="hidden" name="Id_Usuario" value="{{$usu_id}}">
                        <input type="hidden" name="Id_Comentario" value="{{$comentario->id}}">
                        <div class="form-group">
                            <textarea type="text-area" rows="1" class="form-control" name="Resposta" placeholder="Resoista" value={{$comentario->Comentario}}></textarea>
                        </div>
                        <div class="form-group direita mr-3">
                            <button class="btn btn-outline-success my-2 my-sm-0 bg-primary text-warning" type="submit">publicar</button>
                        </div>
                </form>
            </div>
        </div>
    @endif
</div>