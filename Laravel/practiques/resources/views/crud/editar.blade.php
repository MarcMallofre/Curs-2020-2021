<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar producto</title>
</head>
<body>
<form action="{{route('editarProducto', $id)}}" method="post">
    @csrf
    Nombre: <input type="text" name="nombre" id="" value="{{$nombre}}"><br><br>
    @if ($errors->has('nombre'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('nombre') }}</strong><br><br>
        </span>
    @endif
    
    Descripcion: <input type="text" name="descripcion" id="" value="{{$descripcion}}" size=50><br><br>
    @if ($errors->has('descripcion'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('descripcion') }}</strong><br><br>
        </span>
    @endif
    
    Precio: <input type="text" name="precio" id="" value="{{$precio}}"><br><br>
    @if ($errors->has('precio'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('precio') }}</strong><br><br>
        </span>
    @endif
    
    <input type="submit" value="Editar"><br>
    </form>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<br>
<a href="{{ route('listaProductos') }}">Atrás</a>

</body>
</html>