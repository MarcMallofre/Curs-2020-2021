<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
<table border=1>
    <tr>
        <td><strong>ID</strong> </td>
        <td><strong>Nombre</strong> </td>
        <td><strong>Descripcion</strong> </td>
        <td><strong>Precio</strong> </td>
        <td><strong>Editar</strong> </td>
        <td><strong>Borrar</strong> </td>
    </tr>
    @if($productos->count()) 
        @foreach($productos as $producto)
        <tr>
            <td>{{$producto->id}}</td>
            <td>{{$producto->nombre}}</td>
            <td>{{$producto->descripcion}}</td>
            <td>{{$producto->precio}}</td>
            <td><a href="{{route('formularioEditar', $producto->id)}}">Editar</a></td>
            <td><a href="{{route('borrar', $producto->id)}}">Borrar</a></td>
        </tr>
        @endforeach
    @else
        <tr>
            <td>No hay registro !!</td>
        </tr>
    @endif
</table>
<br>
<a href="{{ route('formularioAñadirProducto') }}">Añadir Producto</a>
</body>
</html>