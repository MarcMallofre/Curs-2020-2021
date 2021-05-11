@extends('layouts.headers.headerAdmin')

@section('title', 'Añadir proyecto')

@section("seccion")

    <div class="container authForm">
        <h2>Añadir proyecto</h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{route('guardarProyecto')}}" method="POST" enctype="multipart/form-data" >
            @csrf
            <label for="nombreProyecto">Nombre</label>
            <input type="text" name="nombreProyecto" id="nombreProyecto">
            <br><br>
            <label for="imagenProyecto">Imagen</label>
            <input type="file" name="imagenProyecto[]" id="imagenProyecto" multiple>
            <br><br>
            <label for="descripcionProyecto">Descripcion</label><br>
            <textarea name="descripcionProyecto" id="descripcionProyecto"></textarea>
            <br>

            <input type="submit" value="Añadir">
        </form>

    </div>
@stop