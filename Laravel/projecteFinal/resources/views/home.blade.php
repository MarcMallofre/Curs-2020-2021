<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
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
                        <li><a href="{{ route('editarUsuario', Auth::user()->id ) }}"  >Editar datos</a></li>

            
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
			
				
                
                
                @else
                <li><a  href="{{ route('login') }}" >Iniciar sesión</a></li>
                    

                    @if (Route::has('register'))
                        <li><a href="{{ route('register') }}">Registrar</a></li>
                    @endif
                @endauth

                <li><a href="#" id="showSaluda">Salúdanos</a></li>
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
                <li class="nav-item"><a class="nav-link"  href="#equipo">Equipo</a></li>
                <li class="nav-item"><a class="nav-link"  href="#proyectos">Proyectos</a></li>
                <li class="nav-item"><a class="nav-link"  href="#servicios">Servicios</a></li>
                <li class="nav-item"><a class="nav-link"  href="{{ route('tienda') }}">Tienda</a></li>
                <li class="nav-item"><a class="nav-link"  href="#contacto">Contacto</a></li>
            </ul>
        </div>
    </nav>

    <div class="container" id="home">
        <img src="img/home.jpg" alt="Imatge presentació empresa" class="img-fluid">
        <h1>Mi página web</h1>
    </div>

    <div id="equipoDIV">
        <div class="container" id="equipo">
            <h2>Equipo</h2>
            <div class="slideshow-container">

                <div class="mySlides ">
                    <div class="numbertext">1 / 3</div>
                    <img src="img/home.jpg" style="width:100%">
                    <div class="text">Marc Mallofré</div>
                </div>

                <div class="mySlides ">
                    <div class="numbertext">2 / 3</div>
                    <img src="img/home.jpg" style="width:100%">
                    <div class="text">Eric Rodriguez</div>
                </div>

                <div class="mySlides ">
                    <div class="numbertext">3 / 3</div>
                    <img src="img/equipo/carla.jpg" style="width:100%">
                    <div class="text">Carla Soria</div>
                </div>

                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>

            </div>
            <br>

            <div style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span> 
                <span class="dot" onclick="currentSlide(2)"></span> 
                <span class="dot" onclick="currentSlide(3)"></span> 
            </div>
        </div>
    </div>
   

    <div id="proyectosDIV">

    
        <div class="container" id="proyectos">
            <h2>Proyectos</h2>
            @foreach($admins as $admin)
                @auth
                    @if(Auth::user()->email == $admin->email)
                    <a href="{{route ('añadirProyecto')}}" id="añadirProyecto">Añadir proyecto</a>
                    @endif
                @endauth
            @endforeach
            <div id="listaProyectos">
            @foreach($proyectos as $proyecto)
                
                <span class="abrirProyecto" id="{{$proyecto->id}}"><strong>Nombre: </strong>{{$proyecto->nom}}</span> 

                @foreach($admins as $admin)
                @auth
                    @if(Auth::user()->email == $admin->email)
                    <a href="{{route('editarProyecto', $proyecto->id)}}" ><i class="fas fa-pencil-alt"></i></a> <br>
                    @endif
                @endauth
                @endforeach

                
                <div class="infoProyecto" id="info{{$proyecto->id}}">
                    <p> <strong>Descripción: </strong> {{$proyecto->descripcio}}</p>
                    @foreach ($proyecto->imagenes as $imagen)


                    @foreach($admins as $admin)
                        @auth
                            @if(Auth::user()->email == $admin->email)
                        <a href="{{route('eliminarImagenProyecto', $imagen->id)}}" onclick="return confirm('¿Estas seguro que quieres eliminar la imagen? Esta acción no se pue deshacer')"><i class="fas fa-trash-alt"></i>Borrar imagen</a>
                            @endif
                        @endauth
                    @endforeach
                    <img src="{{$imagen->ruta}}" alt="Imagen identificativa del proyecto" class="img-fluid">   
                    @endforeach
                </div>
                <hr>
                
            @endforeach




            
            </div>
            
        </div>

    </div>

    
    <div id="serviciosDIV">
        <div class="container" id="servicios">
            <h2>Servicios</h2>

            <div>
                <h3>Análisis de mercado</h3>
                <p>Examinamos en detalle qué competidores y marcas compiten contigo en el mercado.</p>
            </div>
            <div>
                <h3>Estrategia</h3>
                <p>La estrategia es un plan de futuro para tu marca, que creará su propia historia. Se necesita estrategia para marcar la diferencia.</p>
            </div>
            <div>
                <h3>Diseño</h3>
                <p>Es momento de renovar tu imagen.</p>
            </div>
            <div>
                <h3>Publicidad</h3>
                <p>Podemos hacer la mejor publicidad para mejorar la personalidad de tu marca.</p>
            </div>
            <div>
                <h3>Marketing</h3>
                <p>Te ayudamos a realizar todo lo que has planead.</p>
            </div>        
        </div>
    </div>



    <footer id="contacto" class="container">
        <h2>Contacta</h2>
        <div >
            <p>Contacta con nosotros en:</p>
            <p>+34666666666</p>
            <p>info@agencia.com</p>
            <a href="{{route('contacto')}}">O envíanos un correo</a>
        </div>
        <div>
            <p>Vilanova i la Geltrú, Barcelona</p>
            <span>Síguenos: </span>
            <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
        </div>
    </footer>

    
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
</body>
</html>