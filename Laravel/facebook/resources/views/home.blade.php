
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script id="functions" users="{{$users}}" user_name="{{ $user_name }}" user-id="{{ $user_id }}" src="{{ asset('js/functions.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/0617be7d0d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


</head>
<body>
    <div class="container col-md-8 offset-md-2">
        <h4>Muro Facebook</h4><p class="typing"></p>
        <form enctype="multipart/form-data" action="{{ route('send')}}" method="post" class="form-inline" id="mensajemuro">
        @csrf
            
            <input class="form-control col-md-9" type="text" name="mensaje" id="mensaje" placeholder="Escriu el teu missatge">
            <input type="file" name="imagen" id="imagen"><br><br>
            <button class="btn btn-primary" id="enviar" type="submit">Enviar</button>
            
            
        </form>
        
        <div class="escribiendo"></div>
        
    </div>

    
    <div id="pagina" class="row" style="padding-top: 50px">
        <div id="usuariosConectados" class="col-md-2" style="padding-left: 25px">
            <h5>Usuarios conectados</h5>
            <ul>
                @foreach($users as $user)
                    <li id="{{$user->id}}" style="color: red">{{$user->name}} <span></span></li>
                @endforeach

            </ul>
        </div>
        <div id="muro" class="col-md-6" style="height:700px; width: 50%;border: 1px solid #ddd;overflow-y: scroll;">
            @if($mensajes->count()) 
                @foreach($mensajes as $mensaje)
                    <div class="bg-light text-dark" style="border-style: solid; border-width: 2px;  margin: 20px">
                        <input type="hidden" value="{{$mensaje->id}}">
                        <p style="padding: 20px" ><strong>{{$mensaje->from}}:</strong> {{$mensaje->messages }} </p>
                        @if($mensaje->imagen)
                        <div style="margin: 0 auto; width: 250px">
                        <img width="250" height="125"src="https://dawjavi.insjoaquimmir.cat/mmallofre/Curs%202020%202021/Laravel/facebook/storage/app/public/{{$mensaje->imagen}}" alt="">
                        </div>
                        @endif
                        <br>

                        <div id="likes{{$mensaje->id}}">
                        <span>Likes: </span>
                        @foreach($likes as $like)
                        @if($like->id_post == $mensaje->id && $like->like == 1)  
                        <span id="{{$like->id_user}}">{{$like->user_like}} </span>
                        @endif
                        @endforeach
                        </div>

                        <form  action="{{ route('sendLike')}}" id="form{{$mensaje->id}}" method="post" class="form-inline" >
                        @csrf
                        
                        
                        
                        
                        <button id="{{$mensaje->id}}" class="botolike" style="width:100%" type="button">
                        @foreach($likes as $like)
                        @if($like->id_user == $user_id && $like->id_post == $mensaje->id && $like->like == 1)  
                            <i class="far fa-thumbs-up"></i>
                        @endif
                        @endforeach
                        Like
                        </button>
                        
                        </form>
                        <button class="botocomentari" style="width:100%">Comentaris</button>
                        <div id="comentaris{{$mensaje->id}}" style="display:none">
                        <div id="comments">
                        @foreach($comentaris as $comentari)
                        @if($comentari->id_post == $mensaje->id)
                            <div>
                                <p><strong>{{$comentari->user}}</strong><br>{{$comentari->comment}}</p>
                            </div>
                        @endif
                        @endforeach
                        </div>
                       



                            <form action="{{ route('sendComment')}}" method="post" class="form-inline">
                            @csrf
                                
                                <input  type="text" name="comentario" id="comentario{{$mensaje->id}}" placeholder="Escriu el teu missatge">
                                
                                <button class="btn btn-primary enviarcomentario"  value="{{$mensaje->id}}" type="button">Enviar comentario</button>
                            </form>
                            
                                
                        </div>
                    </div>
                    

                @endforeach
            @endif
        </div>
        <div id="chatPrivado" style="padding-left: 30px"> 
            @if($mensajesPrivados->count()) 
            @foreach($users as $user)
            <div id="chatPrivado{{$user->id}}" style="display: none">
                <span id="{{$user->id}}"></span>
                <div style="padding-right: 100px">
                    <h5 id="nombreChat" style="display: inline">Chat Privado </h5>
                    <span id="cerrarChat" style="float: right">Cerrar</span>
                </div>
                
                
                    <div id="muroMensajesPrivados{{$user->id}}" style="height: 300px;border: 1px solid #ddd;overflow-y: scroll;">

                    
                        @foreach($mensajesPrivados as $mensajePrivado)
                            @if($mensajePrivado->from == $user_id && $mensajePrivado->to == $user->id)
            
                                <p class="bg-light text-dark text-right"><strong>Tu:</strong> {{$mensajePrivado->message }} </p>
                            @elseif($mensajePrivado->from == $user->id && $mensajePrivado->to == $user_id)
                                <p class="bg-light text-dark text-left"><strong>{{$user->name}}:</strong> {{$mensajePrivado->message }} </p>                  
                            @endif
                        @endforeach
                    
                    </div>
                    

            </div>
            @endforeach
            @endif
            <form style="display: none; " action="{{ route('sendPrivateMessage')}}" method="post" class="form-inline ">
                @csrf
                    <input class="form-control col-md-9" type="text" name="mensajePrivado" id="mensajePrivado" placeholder="Escriu el teu missatge">
                    <button class="btn btn-primary" id="enviarPrivado" type="button">Enviar</button>
            </form>
            <div style="display: none;" class="escribiendoprivado"></div>
        </div>
            
            
        
    </div>
    
</body>
</html>


