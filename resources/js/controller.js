const { trim } = require("jquery");
const { isArray } = require("lodash");

$(function () {
    const BASE_URL = "http://127.0.0.1:8000/";
    $(document).on('submit', 'form[name="comentario"]', function () {
        var forma = $(this);
        var id = forma.find('input[name="Id_Postagem"]').val();
        var user = forma.find('input[name="Id_Usuario"]').val();
        var dados = $(this).serialize();
        var comentario = forma.find('textarea[name="Comentario"]').val();

        if(trim(comentario) == ""){
            alert("Campo Obrigatorio");
        }
        else{

           $.ajax({
               type: "POST",
               //url: "{{ route ('coment.store') }}",
               url: BASE_URL + 'comentAdd',
               dataType: "json",
               data: dados,
               beforeSend: function () {
               },
               success: function (json) {
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
                div += '<p style="text-align: left;">'
                div += '<pre class="text-white" style="font-family: Arial; font-size: 15px">'+ comentario +'</pre>';
                div += '</p>';

                div += '<div class="row">';
                div += '<button type="button" class="btn btn-success btn-sm" data-toggle="collapse" data-target="#resp'+ json.id +'"><b>Responder</b></button>';

                


                // div += '<div class="dropdown col-1">';
                // div += '<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';

                // div += '</button>';
                // div += '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                // div += '<a class="dropdown-item" href="#" data-toggle="modal" data-target="#editComent'+ json.id +'"><span class="fas fa-edit" style="font-size: 20px; color: gray;"></span>Editar</a>';
                // div += '<a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteComent'+ json.id +'"><span class="fas fa-trash-alt" style="font-size: 20px; color: gray;"></span> Excluir</a>';
                // div += '<a class="dropdown-item" href="#">Reportar</a>';
                // div += '</div>';
                // div += '</div>';
                div += '</div>';



                // div += '<div class="modal fade" id="editComent'+ json.id +'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                // div += '<div class="modal-dialog">';
                // div += '<div class="modal-content">';
                // div += '<div class="modal-body">';
                // div += '<center>';
                // div += '<p>Editar Comentario?</p>';
                // div += '<form action="{{route('coment.update',$comentario->id)}}" method="POST">';
                // div += '@csrf';
                // div += '@method('PUT')';
                // div += '<div class="form-group">';
                // div += '<textarea type="text-area" rows="1" class="form-control" name="Comentario" placeholder="Comentario">{{$comentario->Comentario}}</textarea>';
                // div += '</div>';
                // div += '<button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>';
                // div += '<button type="submit" class="btn btn-success">Editar</button>';
                // div += '</form>';
                // div += '</center>';
                // div += '</div>';
                // div += '</div>';
                // div += '</div>';
                // div += '</div>';

                // div += '<div class="modal fade" id="deleteComent{{$comentario->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                // div += '<div class="modal-dialog">';
                // div += '<div class="modal-content">';
                // div += '<div class="modal-body">';
                // div += '<center>';
                // div += '<p>Deseja deletar essa postagem?</p>';
                // div += '<form action="{{route('coment.destroy',$comentario->id)}}" method="POST">';
                // div += '@csrf';
                // div += '@method('DELETE')';
                // div += '<button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>';
                // div += '<button type="submit" class="btn btn-danger">Deletar</button>';
                // div += '</form>';
                // div += '</center>';
                // div += '</div>';
                // div += '</div>';
                // div += '</div>';
                // div += '</div>';


                div += '<div id="resp'+ json.id +'" class="collapse">'
                div += '<br>';

                div += '<div class="respostas" resposta="'+ json.id +'"></div>';

                div += '<div class="media border p-3" style="background-color: black;">';
                div += '<img src="'+ BASE_URL +'storage/'+ json.img_perfil +'" alt="John Doe" class="mr-3 mt-3 rounded-circle" style="width:60px;">';
                div += '<div class="media-body">';
                div += '<form action="#" method="POST" name="resposta"> ';
                div += '<input type="hidden" name="Id_Usuario" value="'+ user +'">';
                div += '<input type="hidden" name="Id_Comentario" value="'+ json.id +'">';
                div += '<div class="form-group">';
                div += '<textarea type="text-area" rows="1" class="form-control" name="Resposta" placeholder="Resposta"></textarea>';
                div += '</div>';
                div += '<div class="form-group direita mr-3">';
                div += '<button type="submit" class="btn btn-success btn-sm"><span class="fas fa-paper-plane"></span><b> Enviar</b></button>';
                div += '</div>';
                div += '</form>';
                div += '</div>';

                
                div += '</div>';
                div += '</div>';
                $('.comentarios[comentario="'+id+'"]').prepend(div).show();
               },
               error: function (response) {
                   alert(response);
               }
           });
        }
           return false;
       });
   
    
   
   });


   $(function () {
    const BASE_URL = "http://127.0.0.1:8000/";
    $(document).on('submit', 'form[name="resposta"]', function () {
        var forma = $(this);
        var id = forma.find('input[name="Id_Comentario"]').val();
        var user = forma.find('input[name="Id_Usuario"]').val();
        var dados = $(this).serialize();
        var comentario = forma.find('textarea[name="Resposta"]').val();

        if(trim(comentario) == ""){
            alert("Campo Obrigatorio");
        }
        else{

           $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
               type: "POST",
               //url: "{{ route ('coment.store') }}",
               url: BASE_URL + 'responseAdd',
               dataType: "json",
               data: dados,
               beforeSend: function () {
               },
               success: function (json) {
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
                div += '<p style="text-align: left;">'
                div += '<pre class="text-white" style="font-family: Arial; font-size: 15px">'+ comentario +'</pre>';
                div += '</p>';              
                div += '</div>';
                div += '</div>';
                $('.respostas[resposta="'+id+'"]').prepend(div).show();
               },
               error: function (response) {
                   alert(response);
               }
           });
        }
           return false;
       });
   
    
   
   });


   $(function () {
    const BASE_URL = "http://127.0.0.1:8000/";
    $(document).on('click', '.curtir', function () {
        var forma = $(this);
        var id = forma.attr('Id_Postagem');
        var user = forma.attr('Id_Usuario');
        var dados = $(this).serialize();
        alert(forma);
        alert (id);
        alert (user);
        alert(dados);
        // alert('teste');
           $.ajax({
               type: "POST",
               //url: "{{ route ('coment.store') }}",
               url: BASE_URL + 'LikePostAdd',
               //dataType: "json",
               data: {
                    "Id_Postagem": id,
                    "Id_Usuario": user
               },
               beforeSend: function () {
                //alert("Before Send");
               },
               success: function (json) {
                alert('Success');
                alert(json);
               },
               error: function (response) {
                   alert(response);
                   console.log(response);
               }
           });
           return false;
       });
   
    
   
   });


//    $(function () {
//     const BASE_URL = "http://127.0.0.1:8000/";
//     $(document).on('submit', 'form[name="like"]', function () {
//         var forma = $(this);
//         var _token = forma.find('_token').val();
//         var id = forma.find('Id_Postagem').val();
//         var user = forma.find('Id_Usuario').val();
//         // var dados = $(this).serialize();
//         // alert (dados);
//         // var dados: 
//         // alert('teste');
//            $.ajax({
//                type: "POST",
//                //url: "{{ route ('coment.store') }}",
//                url: BASE_URL + 'LikePostAdd',
//                //dataType: "json",
//                data: {_token: _token, Id_Postagem: id, Id_Usuario: user},
//                beforeSend: function () {
//                 alert("Before Send");
//                },
//                success: function (json) {
//                 alert('Success');
//                 alert(json);
//                },
//                error: function (response) {
//                    alert(response);
//                    console.log(response);
//                }
//            });
//            return false;
//        });
   
    
   
//    });
