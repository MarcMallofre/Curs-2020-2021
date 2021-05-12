@extends('layouts.headers.header2')

@section('title', 'Editar usuario')

@section("seccion")

<div class="container authForm titulo" >
    <h2>Editar datos personales</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('actualizaUsuario', $id) }}" method="POST" >
    @csrf
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" value="{{$name}}">

   
<br>

    <label for="email">Correo</label>
    <input type="text" name="email" id="email" value="{{$email}}">

<br>
    <label for="contraseña">Contraseña</label>
    <input type="password" name="contraseña" id="contraseña">

    <br>
    <label for="contraseña_confirmation">Confirma contraseña</label>
    <input type="password" name="contraseña_confirmation" id="contraseña_confirmation">
<br>
    <input type="submit" value="Editar">
    <br><br>
    </form>
    <form action="{{route('eliminarUsuario', $id)}}" method="POST">
    @csrf
    <input type="submit" value="Borrar usuario" class="btn btn-danger" onclick="return confirm('¿Estas seguro que quieres eliminar la cuenta? Esta acción no se pue deshacer')">
    </form>
</div>

@stop