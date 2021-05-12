@extends('layouts.headers.headerAdmin')

@section('title', 'Administradores')

@section("seccion")

<div class="container titulo">
    <h2>Administradores</h2>
</div>

<div id="productosCRUD" class="container titulo">
    <table border=1 class="table">
        <th>Nombre</th>
        <th>Email</th>
        <th>Eliminar</th>
        @foreach($admins as $admin)
            @if($admin->id!=1)
            <tr>
                <td>{{$admin->nom}}</td>
                <td>{{$admin->email}}</td>
                <td>
                    <form method="POST" id="eliminarAdmin" action="{{ route('eliminarAdmin', $admin->id)}}">
                        @csrf
                        <input type="submit" value="Eliminar">
                    </form>
            
                </td>
            </tr>
            @endif
        @endforeach
    </table>
</div>

<div class="container">
    <form id="añadirAdmin" action="{{ route('añadirAdmin')}}" method="POST">
        @csrf
        <label for="users">Añadir administrador</label><br>
        <select name="users" id="users">
            <option value="">--Selecciona usuario--</option>
            @foreach($users as $user)
            @if($user->id!=1)
            <option value="{{$user->id}}">{{$user->name}}, {{$user->email}}</option>
            @endif
            @endforeach
        </select><br>
        <input type="submit" value="Añadir">
    </form>
</div>

@stop