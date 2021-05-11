@extends('layouts.headers.headerAdmin2')

@section('title', 'Editar proyecto')

@section("seccion")

<div class="container authForm">
<h2>Editar Proyecto</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{route('actualizaProyecto', $id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="nombreProyecto">Nombre</label>
        <input type="text" name="nombreProyecto" id="nombreProyecto" value="{{$nom}}">
        <br><br>
        <input type="file" name="imagenProyecto[]" id="imagenProyecto" multiple>
        <br><br>
        <label for="descripcionProyecto">Descripcion</label><br>
        <textarea name="descripcionProyecto" id="descripcionProyecto" value="{{$descripcio}}">{{$descripcio}}</textarea>
        <br>

        <input type="submit" value="Editar">
        <label for=""></label>
    </form>

</div>

@stop