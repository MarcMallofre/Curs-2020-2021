<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/0617be7d0d.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
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

                <a href="#" id="showSaluda">Salúdanos</a>
            </div>
        @endif
      </div>
    </header>

    <div id="saluda" class="position-absolute text-right">
        <div id="tanca" class="rounded-circle">
            <a href="#" id="hideSaluda" >Tanca</a>
        </div>
        <form action="#">
            <input type="text" name="" id="">
        </form>
    </div>
   

<script src="js/script.js"></script>
</body>
</html>