@extends('layouts.headers.headerAdmin')

@section('title', 'Pedidos')

@section("seccion")

<div class="container titulo">
    <h2>Pedidos</h2>
</div>

<div id="pedidos" class="container titulo">
    <table border=1 class="table">
        <th>ID</th>
        <th>Usuario</th>
        <th>Total</th>
        <th>Fecha</th>
        <th >Ver</th>
        @foreach($pedidos as $pedido)
            <tr>
                <td>{{$pedido->id}}</td>
                <td>{{$pedido->usuario->name}}</td>
                <td>{{$pedido->total}}</td>
                <td>{{$pedido->data}}</td>
                <td class="text-center"><a href="{{route('pedido', $pedido->id)}}"><i class="fas fa-eye"></i></a></td>
            </tr>
        @endforeach
    </table>
</div>
@stop