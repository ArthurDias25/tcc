$(function () {
    const BASE_URL = "http://127.0.0.1:8000/";
    $(document).on('submit', 'form[name="comentario"]', function () {
        var forma = $(this);
        var id = forma.find('input[name="Id_Postagem"]').val();
        var user = forma.find('input[name="Id_Usuario"]').val();
        var dados = $(this).serialize();

        //alert(dados);
        //alert(id);
        var comentario = forma.find('textarea[name="Comentario"]').val();
           $.ajax({
               type: "POST",
               //url: "{{ route ('coment.store') }}",
               url: BASE_URL + 'comentAdd',
               dataType: "json",
               data: dados,
               beforeSend: function () {
               },
               success: function (json) {
                //alert(JSON.stringify(json));
                //alert(id);
                //$('.comentarios[comentario="'+id+'"]').prepend(comentario).show();

                // var div = '';
                // div += '<li class="coments">';
                // div += '<div class="row">';
                // div += '<div class="mt-1">';
                // div += '<img src="{{ url("storage/'+ json +'") }}" width="50">'
                // div += '</div>';
                // div += '<div class="card mt-1 col-11">';
                // div += '<p><b>'+ +'</b></p>';
                // div += '<p>'+ +'</p>';
                // div += '</div>';
                // div += '</div>';
                // div += '</li>';
                // $('.comentarios[comentario="'+id+'"]').prepend(div).show();

                console.log("Submit Clicado")

                var div = '';
                div += '<div class="media border p-3" style="background-color: black;">';
                div += '<a href="perfil/'+user+'">';
                div += '<img src="'+ BASE_URL +'storage/'+ json.img_perfil +'" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">';
                div += '</a>';
                div += '<div class="media-body">';
                div += '<a href="perfil/'+user+'">';
                div += '<h5 class="text-white" style="text-align: left;"><b class="text-success">'+ json.name +'</b>';
                div += '</a>';
                div += '<p class="text-white" style="text-align: left;">'+ comentario +'</p>';


                // div += '<button type="button" class="btn btn-success btn-sm" data-toggle="collapse" data-target="#resp{{$comentario->id}}"><b>Responder</b></button>';
                // div += '<div id="resp{{$comentario->id}}" class="collapse">'
                // div += '<br>';
                // div += '<div class="media border p-3" style="background-color: black;">';
                // div += '<a href="perfil/'+user+'">';
                // div += '<img src="'+ BASE_URL +'storage/'+ json.img_perfil +'" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">';
                // div += '</a>';
                // div += '<div class="media-body">';
                // div += '<a href="perfil/'+user+'">';
                // div += '<h5 class="text-white" style="text-align: left;"><b class="text-success">'+ json.name +'</b>';
                // div += '</a>';
                // div += '<p class="text-white" style="text-align: left;">'+ comentario +'</p>';
                // div += '</div>';

                
                div += '</div>';
                div += '</div>';
                $('.comentarios[comentario="'+id+'"]').prepend(div).show();

                //$('.comentarios').prepend(comentario);     
                // <li class="coments">
                //     <div class="row">
                //         <div class="mt-1">
                //             <img src="{{ url("storage/{$comentario->users->img_perfil}") }}" width="50">
                //         </div>
                //         <div class="card mt-1 col-11">
                //             <p><b>{{$comentario->users->name}}</b></p>
                //             <p>{{$comentario->Comentario}}</p>
                //         </div>
                //     </div>
                // </li>


               },
               error: function (response) {
                   console.log(response);
               }
           });
           return false;
       });
   
    
   
   });


   $(function(){
        const BASE_URL = "http://127.0.0.1:8000/";
       $("#search").keyup(function(){
           var texto = $(this).val();

           console.log(texto);      

           $.ajax({
            type: "POST",
            //url: "{{ route ('coment.store') }}",
            url: BASE_URL + 'dinamic',
            dataType: "json",
            data: texto,
            beforeSend: function () {
            },
            success: function (json) {
             alert(JSON.stringify(json));

            //  var div = '';
            //  div += '<ul>';
            //  div += '<li>';
            //  div += '<p>'+json.game+'</p>';
            //  div += '</li>';
            //  div += '</ul>';
            //  $('.search').prepend(div).show();

            },
            error: function (response) {
                console.log(response);
            }
        });

       })
   })