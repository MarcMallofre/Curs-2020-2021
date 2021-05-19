<h1>Se ha realizado una nueva compra</h1>

<h2>Cliente:</h2>
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
<p>{{$item->name}} x {{$item->quantity}}</p>
@endforeach