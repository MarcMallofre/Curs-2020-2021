<h1>Hola {{$nombre}}</h1>
<p>Has realizado una compra en nuestra página web.</p>

<h2>Datos de entrega:</h2>
<p>Nombre: {{$nombre}}</p>
<p>Primer Apellido: {{$primerApellido}}</p>
<p>Segundo Apellido{{$segundoApellido}}</p>
<p>Email: {{$email}}</p>
<p>Teléfono: {{$telefono}}</p>
<p>Dirección: {{$direccion}}</p>
<p>Ciudad: {{$ciudad}}</p>
<p>Codigo Postal: {{$codigoPostal}}</p>
<p>Provincia: {{$provincia}}</p>

<h2>Pedido</h2>
@foreach (Cart::getContent() as $item)
@foreach ($item->attributes as $key => $attribute)
   <img src="{{$attribute}}" alt="" class="img-fluid">
@endforeach
<p>{{$item->name}} x {{$item->quantity}}</p>
@endforeach