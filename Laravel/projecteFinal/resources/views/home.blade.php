@extends('layouts.headers.header')

@section('title', 'Helway Studio')

@section("seccion")



    <div class="fullAltura">
    
    </div>
    <div class="container">
        <h1>Helway Studio</h1>
    </div>

    <div id="equipoDIV">
        <div class="container" id="equipo">
            <h2>Equipo</h2>
            <div class="slideshow-container">

                <div class="mySlides ">
                    <div class="numbertext">1 / 3</div>
                    <img src="img/equipo/marc.jpg" style="width:100%" alt="Imagen miembro equipo">
                    <div class="text">Marc Mallofré</div>
                </div>

                <div class="mySlides ">
                    <div class="numbertext">2 / 3</div>
                    <img src="img/equipo/eric.jpg" style="width:100%" alt="Imagen miembro equipo">
                    <div class="text">Eric Rodriguez</div>
                </div>

                <div class="mySlides ">
                    <div class="numbertext">3 / 3</div>
                    <img src="img/equipo/carla.jpg" style="width:100%" alt="Imagen miembro equipo">
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

                    <div id="imagenesProyecto">
                    @foreach ($proyecto->imagenes as $imagen)
                    
                        <div>
                            
                            <img src="{{$imagen->ruta}}" alt="Imagen identificativa del proyecto" class="img-fluid"> <br>
                            @foreach($admins as $admin)
                                @auth
                                    @if(Auth::user()->email == $admin->email)
                                <a href="{{route('eliminarImagenProyecto', $imagen->id)}}" onclick="return confirm('¿Estas seguro que quieres eliminar la imagen? Esta acción no se pue deshacer')"><i class="fas fa-trash-alt"></i>Borrar imagen</a>
                                    @endif
                                @endauth
                            @endforeach  
                        </div>
                    
                    @endforeach
                    </div>
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
                <img src="img/logos/1.svg" alt="" >
                <p>Examinamos en detalle qué competidores y marcas compiten contigo en el mercado.</p>
            </div>
            <div>
                <h3>Estrategia</h3>
                <img src="img/logos/2.svg" alt="">
                <p>La estrategia es un plan de futuro para tu marca, que creará su propia historia. Se necesita estrategia para marcar la diferencia.</p>
            </div>
            <div>
                <h3>Diseño</h3>
                <img src="img/logos/3.svg" alt="">
                <p>Es momento de renovar tu imagen.</p>
            </div>
            <div>
                <h3>Publicidad</h3>
                <img src="img/logos/4.svg" alt="">
                <p>Podemos hacer la mejor publicidad para mejorar la personalidad de tu marca.</p>
            </div>
            <div>
                <h3>Marketing</h3>
                <img src="img/logos/5.svg" alt="">
                <p>Te ayudamos a realizar todo lo que has planeado.</p>
            </div>        
        </div>
    </div>


<div id="footerDiv">


    <footer id="contacto" class="container">

        <div >
            <p>Contacta con nosotros en:</p>
            <p><i class="fas fa-phone-alt"></i>+34666666666</p>
            <p><i class="fas fa-envelope"></i>info@agencia.com</p>
            <a id="briefing" href="{{route('contacto')}}"><i class="fas fa-at"></i>O aquí tienes un briefing</a>
        </div>
        <div>
            <p>Vilanova i la Geltrú, Barcelona</p>
            <p>Síguenos: </p>
            <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://www.twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
        </div>
    </footer>
</div> 

    
@stop
