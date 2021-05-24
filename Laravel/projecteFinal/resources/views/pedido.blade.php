@extends('layouts.headers.headerAdmin2')

@section('title', 'Pedido')

@section("seccion")

<div class="container titulo">
    <h2>Datos pedido</h2>
    <p><b>ID:</b> {{$pedido->id}}</p>
    <p><b>Usuario: </b> {{$pedido->usuario->name}}</p>
    <p><b>Total: </b> {{$pedido->total}}</p>
    <p><b>Fecha: </b> {{$pedido->data}}</p>
</div>

<div class="container titulo">
    <h2>Datos entrega</h2>
    <p><b>Nombre:</b> {{$pedido->nom}}</p>
    <p><b>Primer Apellido: </b> {{$pedido->primerCognom}}</p>
    <p><b>Segundo Apellido: </b> {{$pedido->segonCognom}}</p>
    <p><b>Email: </b> {{$pedido->email}}</p>
    <p><b>Teléfono: </b> {{$pedido->telefon}}</p>
    <p><b>Dirección: </b> {{$pedido->direccio}}</p>
    <p><b>Ciudad: </b> {{$pedido->ciutat}}</p>
    <p><b>Codigo Postal: </b> {{$pedido->codiPostal}}</p>
    <p><b>Provincia: </b> {{$pedido->provincia}}</p>
</div>

<div class="container titulo">
    <h2>Detalle pedido</h2>

    @foreach($detalles as $detalle)

    <p><b>Producto:</b> {{$detalle->productos->nom}}. <b>Cantidad: </b>{{$detalle->quantitat}}</p>

    @endforeach
</div>
<br><br>
@stop