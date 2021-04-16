window.onload = function() { init(); };

//Deshabilitar el botó Intro per enviar missatge
$("form").keypress(function(e) {
    if (e.which == 13) {
        return false;
    }
});

function init(){

    var script_tag = document.getElementById('functions');
    var user_id = script_tag.getAttribute("user-id");
    var user_name = script_tag.getAttribute("user_name");
    
    
    
    
    
    //Esdeveniments missatges, comentaris i like al canal muro
    Echo.private('muro')
        .listen('NewMessageNotification', (e) => {
            if(e.message.imagen){
                $("#muro").prepend('<div class="bg-light text-dark" style="border-style: solid; border-width: 2px;  margin: 20px"><input type="hidden" value='+e.message.id+'><p style="padding: 20px" ><strong>' + e.message.from + ": </strong>" + e.message.messages +'</p><div style="margin: 0 auto; width: 250px"><img width="250" height="125"src="https://dawjavi.insjoaquimmir.cat/mmallofre/Curs%202020%202021/Laravel/facebook/storage/app/public/'+e.message.imagen+'" alt=""></div><br><div id="likes'+e.message.id+'"><span>Likes: </span></div><form  action="https://dawjavi.insjoaquimmir.cat/mmallofre/Curs%202020%202021/Laravel/facebook/public/like" id="form'+e.message.id+'" method="post" class="form-inline"><button id="'+e.message.id+'" class="botolike" style="width:100%;" type="button">Like</button></form><button class="botocomentari" style="width:100%">Comentaris</button><div id=comentaris'+e.message.id+' style="display:none"><div id="comments"> </div> <form action="{{ route("sendComment")}}" method="post" class="form-inline"><input  type="text" name="comentario" id="comentario'+e.message.id+'" placeholder="Escriu el teu missatge"><button class="btn btn-primary enviarcomentario" value="'+e.message.id+'" type="button">Enviar comentario</button></form></div></div>');
            }else{
                $("#muro").prepend('<div class="bg-light text-dark" style="border-style: solid; border-width: 2px;  margin: 20px"><input type="hidden" value='+e.message.id+'><p style="padding: 20px" ><strong>' + e.message.from + ": </strong>" + e.message.messages +'</p><br><div id="likes'+e.message.id+'"><span>Likes: </span></div><form  action="https://dawjavi.insjoaquimmir.cat/mmallofre/Curs%202020%202021/Laravel/facebook/public/like" id="form'+e.message.id+'" method="post" class="form-inline"><button id="'+e.message.id+'" class="botolike" style="width:100%;" type="button">Like</button></form><button class="botocomentari" style="width:100%">Comentaris</button><div id=comentaris'+e.message.id+' style="display:none"><div id="comments"> </div> <form action="{{ route("sendComment")}}" method="post" class="form-inline"><input  type="text" name="comentario" id="comentario'+e.message.id+'" placeholder="Escriu el teu missatge"><button class="btn btn-primary enviarcomentario" value="'+e.message.id+'" type="button">Enviar comentario</button></form></div></div>');
            }  
        })
        
        .listen('NewCommentNotification', (e) => {
            $("#comentaris"+e.comment.id_post+" #comments").append('<div><p><strong>'+e.comment.user+'</strong><br>'+e.comment.comment+'</p></div>');
        })
        
        .listen('NewLike', (e) => {
            //Afegir/treure icona de like
            if(e.like.id_user==user_id && e.like.id_post == idpost && e.like.like==1){
                $('#form'+e.like.id_post+' button').prepend("<i class='far fa-thumbs-up'></i>");
                
            }else if(e.like.id_user==user_id && e.like.id_post == idpost && e.like.like==0){
                $('#form'+e.like.id_post+' button').html("Like"); 
            }

            //afegir/treure persones de la llista dels que han donat like
            if(e.like.like==1){
                $('div#likes'+e.like.id_post).append("<span id='"+e.like.id_user+"'>"+e.like.user_like+"</span>");
            }else if(e.like.like==0){
                $('#likes'+e.like.id_post+' #'+e.like.id_user).remove(); 
                console.log(e.like.id_user);
            }
        })
        
    //Envio el token del formulari
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content')
        }
    })

    //esdeveniment per enviar missatges i imatges al muro
    $("form#mensajemuro").submit(function(e){
        e.preventDefault();
        if($('#mensaje').val()!=""){
            let mensaje =$('#mensaje').val();
            let fd = new FormData(this);
            $.ajax({
                url: 'https://dawjavi.insjoaquimmir.cat/mmallofre/Curs%202020%202021/Laravel/facebook/public/message/send',
                type: 'post',
                data: fd,
                mensaje: mensaje,
                contentType: false,
                processData: false,
            })
        }
        $('#mensaje').val("");
        $('#imagen').val("");
    });

    //Quan es fa click al botó d'enviar es redirigeix al metode send que s'encarrega de guarda a la base de dades el missatge enviat i qui l'ha enviat
   /*  $('#enviar').click(function(){
        $.post('https://dawjavi.insjoaquimmir.cat/mmallofre/Curs%202020%202021/Laravel/facebook/public/message/send',{mensaje:$('#mensaje').val(), _token: $('meta[name=csrf-token]').attr('content')});
        $('#mensaje').val("");
        $('#imagen').val("");
    }); */


    //Whispering del muro principal 
    $('#mensaje').on('keydown', function(){
        Echo.private('muro')
            .whisper('typing', {
                name: user_name
            });
    });
    
    Echo.private('muro')
        .listenForWhisper('typing', (e) => {
            $('.escribiendo').html(e.name+" está escribiendo");
            setTimeout( () => {
                $('.escribiendo').html("")
              }, 3000)
        });


    //Llista dels usuaris conectats
    Echo.join('muro')
        .here(users => {
            users.forEach(element => {
                $('#usuariosConectados ul li#'+element.id).css("color", "green");  
            });
        })
        .joining(user => {
            $('#usuariosConectados ul li#'+user.id).css("color", "green");  
        })
        .leaving(user => {
            $('#usuariosConectados ul li#'+user.id).css("color", "red");  
        });


    var id;
    var nom;

    //Esdeveniment per mostrar el xat privat seleccionat
    $(document).on('click','#usuariosConectados ul li', function(){
       
        //agafo la id
        id=$(this).prop("id");
       
        //quan s'bre un xat privat, esborro el contingut de les notificacions de missatges nous
        $('#usuariosConectados ul li#'+id+' span').html("");
        
        //tanco tots els xats
        $('#chatPrivado').children().css("display", "none");
        
        nom=$(this).text();
        
        //obro el xat seleccionat
        $('#chatPrivado form').css("display", "block");
        $('#chatPrivado'+id).css("display", "block");
        $('.escribiendoprivado').css("display", "block");
        $("#muroMensajesPrivados"+id).scrollTop( $("#muroMensajesPrivados"+id).prop('scrollHeight') ); 
    });

    //esdevenimanet per tancar el chat privat
    $(document).on('click','#cerrarChat', function(){
        $('#chatPrivado form').css("display", "none");
        $('#chatPrivado'+id).css("display", "none");
        $('.escribiendoprivado').css("display", "none");
    });
    
   
   //esdeveniment per al xat privat
    Echo.private('chatPrivado.'+user_id)
        .listen('NewPrivateMessageNotification', (e) => {
            $("#muroMensajesPrivados"+id).append('<p class="text-left"><strong>' + nom + ": </strong>" + e.privateMessage.message +'</p>');
            $("#muroMensajesPrivados"+id).scrollTop( $("#muroMensajesPrivados"+id).prop('scrollHeight') ); 
        });
        
    //esdeveniment per enviar missatges per chat privat
    $('#enviarPrivado').click(function(){
        $.post('https://dawjavi.insjoaquimmir.cat/mmallofre/Curs%202020%202021/Laravel/facebook/public/privateMessage/send',{mensaje:$('#mensajePrivado').val(), to:id, _token: $('meta[name=csrf-token]').attr('content')});
        $("#muroMensajesPrivados"+id).append('<p class="text-right"><strong>Tu: </strong>' + $('#mensajePrivado').val() +'</p>');
        $("#muroMensajesPrivados"+id).scrollTop( $("#muroMensajesPrivados"+id).prop('scrollHeight') ); 
        $('#mensajePrivado').val("");
    });

    var idpost;

    //esdeveniment per obrir els comentaris
    $(document).on('click','.botocomentari', function(){
        idpost=$(this).parent().children('input[type=hidden]').val();
        $(this).parent().children('#comentaris'+idpost).toggle();
    });

    //esdeveniment per enviar comentaris
    $(document).on('click','.enviarcomentario',function(){
        idpost=$(this).val()
        $.post('https://dawjavi.insjoaquimmir.cat/mmallofre/Curs%202020%202021/Laravel/facebook/public/comment/send',{comentario:$('#comentario'+idpost).val(), post:idpost, user:user_name, _token: $('meta[name=csrf-token]').attr('content')});
        $('#comentario'+idpost).val("");
    });


   /*  Echo.private('comentarios')
        .listen('NewCommentNotification', (e) => {
            $("#comentaris"+idpost).prepend('<div><p><strong>'+e.comment.user+'</strong><br>'+e.comment.comment+'</p></div>');
        }) */

    //esdeveniment botó like
    $(document).on('click','.botolike',function(){
        idpost=$(this).attr("id");
        $.post('https://dawjavi.insjoaquimmir.cat/mmallofre/Curs%202020%202021/Laravel/facebook/public/like',{id_user:user_id, id_post:idpost, _token: $('meta[name=csrf-token]').attr('content')});       
    });

    //whispering del chat privat
    $('#mensajePrivado').on('keydown', function(){
        Echo.private('chatPrivado.'+id)
            .whisper('typing', {
                name: user_name
            });
    });
    
    Echo.private('chatPrivado.'+user_id)
        .listenForWhisper('typing', (e) => {
            $('.escribiendoprivado').html(e.name+" está escribiendo");
            setTimeout( () => {
                $('.escribiendoprivado').html("")
              }, 3000)
        });
        
    //whispering per a notificacions de missatges nous
    $('#enviarPrivado').on('click', function(){
        Echo.private('chatPrivado.'+id)
            .whisper('nuevomensaje', {
                id: user_id
            });
        });
        
        Echo.private('chatPrivado.'+user_id)
            .listenForWhisper('nuevomensaje', (e) => {
                if($('#chatPrivado'+e.id).is(":hidden")){
                    if($('#usuariosConectados ul li#'+e.id+' span').html()==""){
                        $('#usuariosConectados ul li#'+e.id+' span').html("1");
                    }else{
                        var numMens= $('#usuariosConectados ul li#'+e.id+' span').html();
                        numMens=parseInt(numMens);
                        $('#usuariosConectados ul li#'+e.id+' span').html(numMens+1);
                    } 
                }
            });
   
    
}
