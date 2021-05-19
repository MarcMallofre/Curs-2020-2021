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
                <button type="submit" class="btn btn-primary">
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

    <div class="d-flex justify-content-center">
            {!! $productos->links() !!}
    </div>


@stop