<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <script src="https://kit.fontawesome.com/0617be7d0d.js" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<header class="row">

      <div id="logo" class="col-6">
        <img src="img/logo.png" alt="Imagen logo de la empresa">
      </div>

      <div class="col-6 text-right">
      
        @if (Route::has('login'))
            <div>
                @auth
                    <a href="{{ url('/dashboard') }}" >Dashboard</a>
                @else
                    <a href="{{ route('login') }}" >Iniciar sesión</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Registrar</a>
                    @endif
                @endauth
            </div>
        @endif

        
          
      </div>
    </header>
    <p>hola</p>
</body>
</html>