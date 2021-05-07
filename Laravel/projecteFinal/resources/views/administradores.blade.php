<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adminstradores</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/0617be7d0d.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="row sticky-top">

<div id="logo" class="col-sm-6 col-8 ">
  <a href="{{ route('home') }}"><img src="img/logo.png" alt="Imagen logo de la empresa"></a>
</div>

<div class="col-sm-6 col-4 text-xl-right text-center">

  @if (Route::has('login'))
      <div id="auth">
          
          <ul class="nav">
          @auth
          <li><a href="#">{{ Auth::user()->name }}</a>
                <ul>
                    <li><a href="{{ route('editarUsuario', Auth::user()->id ) }}"  >Editar datos</a></li>
                    @if(Auth::user()->id==1)
                    <li><a href="{{ url('/administradores') }}" >Adminstradores</a></li>
                    @endif
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Cerrar sesión</a>
                        </form>
                        <hr>
                    </li> 
                </ul>
          </li>

          <li><a href="{{ route('home') }}">Volver</a></li>
          @endauth

          </ul>            
      </div>
  @endif
</div>
</header>


<div id="admins" class="container">
<h2>Administradores</h2>
<table border=1>
    <th>Nombre</th>
    <th>Email</th>
    <th>Eliminar</th>
    @foreach($admins as $admin)
        @if($admin->id!=1)
        <tr>
            <td>{{$admin->nom}}</td>
            <td>{{$admin->email}}</td>
            <td>
                <form method="POST" id="eliminarAdmin" action="{{ route('eliminarAdmin', $admin->id)}}">
                    @csrf
                    <input type="submit" value="Eliminar">
                </form>
        
            </td>
        </tr>
        @endif
    @endforeach
</table>

<form id="añadirAdmin" action="{{ route('añadirAdmin')}}" method="POST">
    @csrf
    <label for="users">Añadir administrador</label><br>
    <select name="users" id="users">
        <option value="">--Selecciona usuario--</option>
        @foreach($users as $user)
        @if($user->id!=1)
        <option value="{{$user->id}}">{{$user->name}}, {{$user->email}}</option>
        @endif
        @endforeach
    </select><br>
    <input type="submit" value="Añadir">
</form>

</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
</body>
</html>