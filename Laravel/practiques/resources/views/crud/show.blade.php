<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto</title>
</head>
<body>
    <table border=1>
        <tr>
            <td><strong>ID</strong> </td>
            <td><strong>Nombre</strong> </td>
            <td><strong>Descripcion</strong> </td>
            <td><strong>Precio</strong> </td>
        </tr>
        <tr>
            <td>{{$id}}</td>
            <td>{{$nombre}}</td>
            <td>{{$descripcion}}</td>
            <td>{{$precio}}</td>
        </tr>
    </table>
    <a href="{{ route('listaProductos') }}">Atrás</a>
</body>
</html>