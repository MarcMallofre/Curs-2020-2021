<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Producto</title>
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

                <li><a href="{{route('tienda')}}">Volver</a></li>
                </ul>            
            </div>
        @endif
      </div>
    </header>

    <div class="container authForm">
        <h2>Añadir producto</h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{route('guardarProducto')}}" method="POST" enctype="multipart/form-data" >
        @csrf
            <label for="nombreProducto">Nombre</label>
            <input type="text" name="nombreProducto" id="nombreProducto"><br>

            <label for="descripcionProducto">Descripción</label><br>
            <textarea name="descripcionProducto" id="descripcionProducto"></textarea><br>

            <label for="precioProducto">Precio</label>
            <input type="number" name="precioProducto" id="precioProducto"><br>

            <label for="imagenProducto">Imagen</label>
            <input type="file" name="imagenProducto[]" id="imagenProducto" multiple><br>

            <input type="submit" value="Añadir">    
        </form>
    </div>
    
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="js/script.js"></script>  
</body>
</html>