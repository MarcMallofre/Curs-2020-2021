<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir producto</title>
</head>
<body>
<form action="{{route('añadirProducto')}}" method="post">
    @csrf
    Nombre: <input type="text" name="nombre" id=""><br><br>
    @if ($errors->has('nombre'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('nombre') }}</strong><br><br>
        </span>
    @endif
    
    Descripcion: <input type="text" name="descripcion" id="" size=50><br><br>
    @if ($errors->has('descripcion'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('descripcion') }}</strong><br><br>
        </span>
    @endif
    
    Precio: <input type="text" name="precio" id=""><br><br>
    @if ($errors->has('precio'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('precio') }}</strong><br><br>
        </span>
    @endif
    
    <input type="submit" value="Añadir"><br>
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