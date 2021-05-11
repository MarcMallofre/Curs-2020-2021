@extends('layouts.headers.headerTienda')

@section('title', 'Tienda')

@section("seccion")
   
    <div class="container" id="productos">
        <h2>Nuestros productos</h2>
        @foreach($productos as $producto)
        <div class="fichaProducto">
            <a href="{{route('producto', $producto->id)}}"><img src="{{$producto->imagenProducto->ruta }}" alt="" class="img-fluid"></a>
            <a href="{{route('producto', $producto->id)}}">{{$producto->nom}}</a>
            <p>Precio: {{$producto->preu}} €</p>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
            {!! $productos->links() !!}
    </div>


@stop