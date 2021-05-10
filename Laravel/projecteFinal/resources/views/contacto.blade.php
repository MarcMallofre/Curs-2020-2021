<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/0617be7d0d.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <header class="row sticky-top">

      <div id="logo" class="col-sm-6 col-8 ">
        <a href="{{ route('home') }}"><img src="img/logo.png" alt="Imagen logo de la empresa"></a>
      </div>

      <div class="col-sm-6 col-4 text-xl-right text-center">
      
        @if (Route::has('login'))
            <div id="auth">
                
                <ul class="nav">
                @auth
				<li><a href="#">{{ Auth::user()->name }}</a>
					<ul>
                        <li><a href="{{ route('editarUsuario', Auth::user()->id ) }}">Editar datos</a></li>

                        @if(Auth::user()->id==1)
                        <li><a href="{{ route('administradores') }}" >Adminstradores</a></li>
                        <li><a href="{{ route('productos') }}" >Productos</a></li>
                        @endif
						<li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Cerrar sesión</a>
                            </form>
                            <hr>
                        </li>
            
					</ul>
				</li>
                @endauth

                <li><a href="{{route('home')}}">Volver</a></li>
                </ul>            
            </div>
        @endif
      </div>
    </header>

    <div class="container authForm">
        <h2>Briefing exprés</h2>
        <form action="" method="POST" id="contacta">
            <div id="infoEmpresa">

            
            <label for="informacionEmpresa">Información de la empresa y campos de trabajo</label>
            <input type="text" name="informacionEmpresa" id="informacionEmpresa" placeholder="Tu respuesta"> <br>

            <label for="actividadEmpresa">Actividad/producto/servicio de la empresa</label>
            <input type="text" name="actividadEmpresa" id="actividadEmpresa" placeholder="Tu respuesta"><br>

            <label for="wow">¿Cuál es tu "WOW"</label>
            <input type="text" name="wow" id="wow" placeholder="Tu respuesta"><br>

            <label for="posible">¿Cuál es tu "¿Eso es posible?"</label>
            <input type="text" name="posible" id="" placeholder="Tu respuesta"><br>

            <label for="objetivos">¿Cuáles son los objetivos y metas de la empresa?</label>
            <input type="text" name="objetivos" id="objetivos" placeholder="Tu respuesta"><br>

            <label for="ayuda">¿Cómo podemos ayudarte?</label>
            <input type="text" name="ayuda" id="ayuda" placeholder="Tu respuesta"><br>

            <label for="producto">¿Qué problemas resuelve el hecho de comprar tu producto?</label>
            <input type="text" name="producto" id="producto" placeholder="Tu respuesta"><br>
            </div>

            <div id="sociales">
                <label for="">Redes sociales</label>
                <input type="text" name="instagram" id="instagram" placeholder="Instagram"><br>
                <input type="text" name="facebook" id="facebook" placeholder="Facebook"><br>
                <input type="text" name="linkedin" id="linkedin" placeholder="Linkedin"><br>

                <label for="enlaceWeb">Enlace de tu sitio web</label>
                <input type="text" name="enlaceWeb" id="enlaceWeb" placeholder="https://"><br>
                <div id="datosContacto">
                    <input type="text" name="nombre" id="" placeholder="Nombre">
                    <input type="email" name="email" id="email" placeholder="Email">
                    <input type="text" name="telefono" id="telefono" placeholder="Telefono">
                </div>
                
            </div>

            
            

            <input type="submit" value="Enviar">

        </form>

    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
</body>
</html>