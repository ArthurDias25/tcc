  <!-- Modal -->
  <div class="modal fade" id="insert-{{$game->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <h5 style="color: black" class="modal-title" id="exampleModalLabel">{{$game->Nome_Jogo}} </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <img src="{{ url("storage/{$game->Imagem_Jogo}") }}" style="max-width: 50px;" >
          <form action="{{route('listAdd')}}" method="POST" name="listAdd">
            @csrf
            <input type="hidden" name="Id_Game" value="{{$game->id}}">
            <input type="hidden" name="Id_Usuario" value="{{Auth::user()->id}}">
            <div class="form-group text-dark">
            <label for="Id_Game">Status:</label>
              <select name="Id_Status" id="Id_Status">
                <option value=""></option>
                  @foreach ($statuses as $status)
                      <option value="{{$status->id}}" style="color: {{$status->Status}}">{{$status->Status}}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group text-dark">
            <label for="Comentario">Comentario: </label>
            <input type="text" name="Comentario">
            </div>
            <div class="form-group text-dark">
            <label for="Nota">Nota: </label>
            <input type="text" style="width: 30px" name="Nota">
            </div>
            <div class="form-group text-dark">
              <label for="Favorite">Favorite: </label>
              <input class="form-check-input" type="checkbox" value="1" name="Favorite">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            <!--  <div class="form-group text-dark">
            <label for="Comentario">Tempo de Jogo: </label>
            <input type="text" style="width: 30px" name="Comentario"> Horas
            <input type="text" style="width: 30px" name="Comentario" > Minutos
            </div> -->
            
          </form>
        </div>
        {{-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Send message</button>
          </div> --}}
      </div>
    </div>
  </div>









@if (isset($listing))
<div class="modal fade" id="edit-{{$listing->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h5 style="color: black" class="modal-title" id="exampleModalLabel">{{$listing->games->Nome_Jogo}} </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <img src="{{ url("storage/{$listing->games->Imagem_Jogo}") }}" style="max-width: 50px;" >
        <form action="{{route('listEdit',$listing->id)}}" method="POST" name="listEdit">
          @csrf
            {{-- <input type="hidden" name="Id_Game" value="{{$listing->Id_Game}}">
            <input type="hidden" name="Id_Usuario" value="{{Auth::user()->id}}"> --}}
            <div class="form-group text-dark">
              <label for="Id_Game">Status:</label>
                <select name="Id_Status" id="Id_Status">
                  <option value=""></option>
                    @foreach ($statuses as $status)
                    @if ($listing->Id_Status == $status->id)
                        <option selected value="{{$status->id}}">{{$status->Status}}</option>                          
                    @else
                        <option value="{{$status->id}}">{{$status->Status}}</option>                          
                    @endif

                    @endforeach
                </select>
            </div>
            <div class="form-group text-dark">
              <label for="Comentario">Comentario: </label>
              <input type="text" name="Comentarios" value="{{$listing->Comentarios}}">
            </div>
            <div class="form-group text-dark">
              <label for="Nota">Nota: </label>
              <input type="text" style="width: 30px" name="Nota" value="{{$listing->Nota}}">
            </div>
            <div class="form-group text-dark">
              @if ($listing->Favorite == 1)
                <input class="form-check-input" type="checkbox" value="0" name="Favorite">
                <label for="Favorite">Desfavoritar </label>
              @else
                <input class="form-check-input" type="checkbox" value="1" name="Favorite">
                <label for="Favorite">Favoritar </label>
              @endif
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          <!--  <div class="form-group text-dark">
              <label for="Comentario">Tempo de Jogo: </label>
              <input type="text" style="width: 30px" name="Comentario"> Horas
              <input type="text" style="width: 30px" name="Comentario" > Minutos
            </div> -->
        </form>
      </div>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div> --}}
    </div>
  </div>
</div>    
@endif
