@extends('layouts.headers.headerAdmin2')

@section('title', 'Editar producto')

@section("seccion")

    <div class="container authForm">
        <h2>Editar producto</h2>
        <form action="{{route('actualizaProducto', $id)}}" method="POST" enctype="multipart/form-data">
        @csrf
            <label for="nombreProducto">Nombre</label>
            <input type="text" name="nombreProducto" id="nombreProducto" value="{{$nom}}"><br>

            <label for="descripcionProducto">Descripción</label><br>
            <textarea name="descripcionProducto" id="descripcionProducto">{{$descripcio}}</textarea><br>

            <label for="precioProducto">Precio</label>
            <input type="number" name="precioProducto" id="precioProducto" value="{{$preu}}"><br>

            <label for="imagenProducto">Imagen</label>
            <input type="file" name="imagenProducto[]" id="imagenProducto" multiple><br>

            <input type="submit" value="Editar"> 
        
        </form>

    </div>
@stop