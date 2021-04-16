<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulari</title>
</head>
<body>
    <form enctype="multipart/form-data" action="{{route('postFormAvanzado')}}" method="post">
    @csrf
    Email: <input type="text" name="email" id=""><br><br>
    @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong><br><br>
        </span>
    @endif
    
    NIF: <input type="text" name="nif" id=""><br><br>
    @if ($errors->has('nif'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('nif') }}</strong><br><br>
        </span>
    @endif
    
    Fitxer: <input type="file" name="fitxer" id=""><br><br>
    @if ($errors->has('fitxer'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('fitxer') }}</strong><br><br>
        </span>
    @endif

    Imatge: <input type="file" name="imatge" id=""><br><br>
    @if ($errors->has('imatge'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('imatge') }}</strong><br><br>
        </span>
    @endif
    
    
    
    <input type="submit" value="enviar"><br>
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

</body>
</html> 