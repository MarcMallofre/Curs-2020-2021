@extends('layouts.headers.headerAdmin')

@section('title', 'Añadir producto')

@section("seccion")


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
    
@stop