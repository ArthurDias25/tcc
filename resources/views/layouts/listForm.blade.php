    <!-- Modal -->
  <div class="modal fade" id="insert-{{$game->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        
        {{-- Header --}}

        <div class="modal-header">
          <div class="d-inline-flex p-3">
            <div class="p-2">
              <img src = "{{ url("storage/{$game->Imagem_Jogo}") }}" class="border border-dark" style="height: 13ch; ">
            </div>
            <div class="p-2">
              <h4 class="modal-title" style="color: black"> <br>{{$game->Nome_Jogo}}</h4>
            </div>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>


        <div class="modal-body">
            {{-- <img src="{{ url("storage/{$game->Imagem_Jogo}") }}" style="max-width: 50px;" > --}}
          <form action="{{route('listAdd')}}" method="POST" name="listAdd">
            @csrf
            <input type="hidden" name="Id_Game" value="{{$game->id}}">
            <input type="hidden" name="Id_Usuario" value="{{Auth::user()->id}}">

            <div class="form-group text-dark">
              <label for="Id_Status">Status:</label>
              <select name="Id_Status" id="Id_Status" class="custom-select mb-3">
                  {{-- <option value="">Status</option> --}}
                  @foreach ($statuses as $status)
                      <option value="{{$status->id}}">{{$status->Status}}</option>
                  @endforeach
              </select>
            </div>

            <div class="form-group text-dark">
              <label for="Nota">Nota: </label>
              <select name="Nota" id="Nota">
                <option value=""></option>
                @for ($i = 10; $i > 0; $i--)
                  <option value="{{$i}}">{{$i}}</option>
                @endfor
              </select>
            </div>

            <div class="form-group text-dark">
              <label for="Inicio"><b>Data de Início:</b></label>
              <input type="date" class="form-control" name="Inicio">
            </div>

            <div class="form-group text-dark">
              <label for="Finalização"><b>Data de Finalização:</b></label>
              <input type="date" class="form-control" name="Finalização">
            </div>

            <div class="form-group text-dark">
              <label for="Comentario">Comentario: </label>
              <textarea class="form-control" rows="2" id="Comentarios" name="Comentarios"></textarea>
            </div>

            <div class="form-check-inline text-dark">
              <label for="Favorite">Favorite: 
              <input class="form-check-input" type="checkbox" value="1" name="Favorite">
            </label>
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

{{-- Modal Edit --}}
@if (isset($listing))
    
  <div class="modal fade" id="edit-{{$listing->id}}-{{$game->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        
        {{-- Header --}}

        <div class="modal-header">
          <div class="d-inline-flex p-3">
            <div class="p-2">
              <img src = "{{ url("storage/{$game->Imagem_Jogo}") }}" class="border border-dark" style="height: 13ch;">
            </div>
            <div class="p-2">
              <h4 class="modal-title" style="color: black"> <br>{{$game->Nome_Jogo}}</h4>
            </div>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>


        <div class="modal-body">
            {{-- <img src="{{ url("storage/{$game->Imagem_Jogo}") }}" style="max-width: 50px;" > --}}
          <form action="{{route('listEdit',$listing->id)}}" method="POST" name="listEdit">
            @csrf
            <div class="form-group text-dark">
              <label for="Id_Status">Status:</label>
              <select name="Id_Status" id="Id_Status" class="custom-select mb-3">
                {{-- <option value="">Status</option>   --}}
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
              <label for="Nota">Nota: </label>
              <select name="Nota" id="Nota">
                <option value=""></option>
                @for ($i = 10; $i > 0; $i--)
                @if ($i == $listing->Nota)
                  <option selected value="{{$i}}">{{$i}}</option>                    
                @endif
                  <option value="{{$i}}">{{$i}}</option>
                @endfor
              </select>
            </div>

            <div class="form-group text-dark">
              <label for="Inicio"><b>Data de Início:</b></label>
              <input type="date" class="form-control" name="Inicio" value="{{$listing->Inicio}}">
            </div>

            <div class="form-group text-dark">
              <label for="Finalização"><b>Data de Finalização:</b></label>
              <input type="date" class="form-control" name="Finalização" value="{{$listing->Finalização}}">
            </div>

            <div class="form-group text-dark">
              <label for="Comentario">Comentario: </label>
              <textarea class="form-control" rows="2" id="Comentarios" name="Comentarios">{{$listing->Comentarios}}</textarea>
            </div>

            <div class="form-check-inline text-dark">
              @if ($listing->Favorite == 1)
              <label for="Favorite">Desfavoritar: 
                <input class="form-check-input" type="checkbox" value="0" name="Favorite">
              </label>
              @else
              <label for="Favorite">Favorite: 
                <input class="form-check-input" type="checkbox" value="1" name="Favorite">
              </label>
              @endif
            </label>
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

@endif




