<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
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
        <a href="{{ route('home') }}"><img src="../img/logo.png" alt="Helway Studio Logo"></a>
      </div>

      <div class="col-sm-6 col-4 text-xl-right text-center">
      
        @if (Route::has('login'))
            <div id="auth">
                
                <ul class="nav">
                @auth
				<li><a href="#" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
					<ul>
                        <li><a href="{{ route('editarUsuario', Auth::user()->id ) }}"  >Editar datos</a></li>

            
                        @if(Auth::user()->id==1)
                        <li><a href="{{ route('administradores') }}" >Adminstradores</a></li>
                        <li><a href="{{ route('productos') }}" >Productos</a></li>
                        <li><a href="{{ route('pedidos') }}" >Pedidos</a></li>
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
			
				
                <li><a href="#" id="showSaluda">Salúdanos</a></li>
                
                @else
                <li><a  href="{{ route('login') }}" >Iniciar sesión</a></li>
                    

                    @if (Route::has('register'))
                        <li><a href="{{ route('register') }}">Registrar</a></li>
                    @endif
                @endauth

                
                </ul>            
            </div>
        @endif
      </div>
    </header>
    <div id="fons" class="position-absolute  sticky-top"></div>
    <div id="saluda" class="position-absolute  sticky-top">
        <div id="tanca" class="rounded-circle">
            <a href="#" id="hideSaluda" >Cierra</a>
        </div>
        
        <form action="#">
            @csrf
            <h2>Escribenos</h2>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre">
            <input type="text" name="email" id="email" placeholder="Email">
            <textarea name="mensaje" id="mensaje" cols="20" rows="6" placeholder="Mensaje"></textarea>
            <input type="submit" value="Envia" class="btn">
        </form>

        <div id="social" class="row">
            <div>
                <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a><br>
                <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
            </div>
            <div id="contact" class="text-right">
                <p>+34666666666</p>
                <p>info@agencia.com</p>
            </div>
        </div> 
    </div>

    <nav class="navbar navbar-expand-lg fixed-bottom navbar-light  ">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto flex-column" >
                <li class="nav-item"><a class="nav-link"  href="home#equipo">Equipo</a></li>
                <li class="nav-item"><a class="nav-link"  href="home#proyectos">Proyectos</a></li>
                <li class="nav-item"><a class="nav-link"  href="home#servicios">Servicios</a></li>
                <li class="nav-item"><a class="nav-link"  href="{{ route('tienda') }}">Tienda</a></li>
                <li class="nav-item"><a class="nav-link"  href="home#contacto">Contacto</a></li>
            </ul>
        </div>
    </nav>

    @section('seccion')
      
    @show

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="../js/script.js"></script>
</body>
</html>