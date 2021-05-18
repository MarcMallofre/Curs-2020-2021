@extends('layouts.headers.headerTienda')

@section('title', 'Compra hecha')

@section("seccion")

<div class="container text-center">
    <p>La compra se ha realizado correctamente.</p>
    <a href="{{route('tienda')}}">Volver a la tienda</a>


</div>

@stop