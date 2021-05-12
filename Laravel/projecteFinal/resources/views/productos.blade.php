@extends('layouts.headers.headerTienda')

@section('title', 'Productos')

@section("seccion")

<div class="container titulo">
    <h2>Productos</h2>
</div>

<div id="productosCRUD" class="container">
    
    <table border=1 id="tablaProductos" class="table">
        <th class="tablaPrecio">Nombre</th>
        <th class="tablaPrecio">Descripcion</th>
        <th class="tablaPrecio">Precio</th>
        <th class="tablaPrecio">Imagenes</th>
        <th class="tablaPrecio">Gestion</th>
        
        @foreach($productos as $producto)
        <tr>
            <td class="tablaPrecio">{{$producto->nom}}</td>
            <td class="tablaPrecio">{{$producto->descripcio}}</td>
            <td class="tablaPrecio">{{$producto->preu}}</td>
            <td class="tablaPrecio">
            @foreach($producto->imagenesProducto as $imagen)
                <img src="{{$imagen->ruta}}" alt="Imagen del producto" class="img-fluid">
                <a href="{{route('eliminarImagenProducto', $imagen->id)}}" onclick="return confirm('¿Estas seguro que quieres eliminar la imagen? Esta acción no se pue deshacer')"><i class="fas fa-trash-alt"></i></a>
            @endforeach

            </td>
            <td class="tablaPrecio">
                 <form method="POST" id="" action="{{route('editarProducto', $producto->id)}}">
                    @csrf
                    <input type="submit" value="Editar">
                </form><br>
                <form method="POST" id="" action="{{route('eliminarProducto', $producto->id)}}">
                    @csrf
                    <input type="submit" value="Eliminar">
                </form>
            </td>
        </tr>
        @endforeach
    </table>

    
</div>
<div class="container">
<a href="{{route ('añadirProducto')}}" id="añadirProducto">Añadir producto</a>
</div>

@stop