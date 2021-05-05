<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar datos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/0617be7d0d.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header class="row sticky-top">

    <div id="logo" class="col-sm-6 col-8 ">
        <a href="{{ route('home') }}"><img src="../img/logo.png" alt="Imagen logo de la empresa"></a>
    </div>

    <div class="col-sm-6 col-4 text-xl-right text-center">
      
        @if (Route::has('login'))
            <div id="auth">
                
                <ul class="nav">
                @auth
				<li><a href="#">{{ Auth::user()->name }}</a>
					<ul>
                        <li><a href="{{ route('editarUsuario', Auth::user()->id ) }}"  >Editar datos</a></li>

                        @if(Auth::user()->id==1)
                        <li><a href="{{ route('administradores') }}" >Adminstradores</a></li>
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
                <li><a href="{{ route('home') }}">Volver</a></li>
                @endauth

                </ul>            
            </div>
         @endif
    </div>
</header>

<div class="container authForm" id="editar">
    <h2>Editar datos personales</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('actualizaUsuario', $id) }}" method="POST" >
    @csrf
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" value="{{$name}}">

   
<br>

    <label for="email">Correo</label>
    <input type="text" name="email" id="email" value="{{$email}}">

<br>
    <label for="contraseña">Contraseña</label>
    <input type="password" name="contraseña" id="contraseña">

    <br>
    <label for="contraseña_confirmation">Confirma contraseña</label>
    <input type="password" name="contraseña_confirmation" id="contraseña_confirmation">
<br>
    <input type="submit" value="Editar">
    <br><br>
    <a class="btn btn-danger" onclick="return confirm('¿Estas seguro que quieres eliminar la cuenta? Esta acción no se pue deshacer')" href="{{route('eliminarUsuario', $id)}}">Borrar usuario</a>
    </form>

</div>

<script src="../js/script.js"></script>
</body>
</html>