@extends('layouts.headers.headerTienda')

@section('title', 'Tienda')

@section("seccion")
   
    <div class="container" id="productos">
        <h2>Nuestras ilustraciones</h2>

        <form action="{{route('busqueda')}}" method="post">
            @csrf
            <div class="input-group">
                <div class="form-outline">
                    <input type="search" name="busqueda" id="busqueda" class="form-control" placeholder="Buscar..."/>
                </div>
                <button type="submit" class="btn" aria-label="Buscar">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>

        @foreach($productos as $producto)
        <div class="fichaProducto">
            <a href="{{route('producto', $producto->id)}}"><img src="{{$producto->imagenProducto->ruta }}" alt="" class="img-fluid"></a>
            <a href="{{route('producto', $producto->id)}}">{{$producto->nom}}</a>
            <p>Precio: {{$producto->preu}} €</p>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center" style="margin-bottom:150px;">
            {!! $productos->links() !!}
    </div>

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

@stop