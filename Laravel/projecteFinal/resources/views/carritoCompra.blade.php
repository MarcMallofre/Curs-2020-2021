@extends('layouts.headers.headerTienda')

@section('title', 'Carrito de la compra')

@section("seccion")

<div class=container id="menu">
        <span><a href="{{route('tienda')}}" id="menuEnlace">Tienda</a>-> Carrito </span>
</div>

<div class="container titulo">
    <h2>Carrito de la compra</h2>
</div>


<div class="container" id="productosCRUD">
@if (!Cart::isEmpty())
    <table border=1 class="table" id="tablaProductos">
        <tr>
            <th scope="col">Imagen</th>
            <th scope="col">Nombre</th>
            <th scope="col">Precio</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Accion</th>
        </tr>
        
    
        @foreach (Cart::getContent() as $item)
            <tr>
                <td>
                    @foreach ($item->attributes as $key => $attribute)
                    <a href="{{route('producto', $item->id)}}"><img src="{{$attribute}}" alt="Imagen identificativa producto" class="img-fluid"></a>
                    @endforeach
                </td>
                <td> <a href="{{route('producto', $item->id)}}">{{$item->name}}</a> </td>
                <td>{{$item->price}}</td>
                <td>
                    <form action="{{route('actualizarCarrito', $item->id)}}" method="post">
                        @csrf
                        <select name="quantity" onchange='this.form.submit()'>
                            @for ($i = 1; $i < 5; $i++)
                            <option @if($item->quantity==$i)selected @endif value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                        <input type="hidden" name="id" value="{{$item->id}}">
                        <input type="hidden" name="name" value="{{$item->nom}}">
                        <input type="hidden" name="price" value="{{$item->preu}}">
                    </form>
                </td>
                
                <th scope="row">
                    <form method="POST" action="{{route('eliminarCarrito',$item->id)}}">
                    @csrf
                    <button type="submit"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </th>
            </tr>
        @endforeach
        
    </table>

    <table class="table">
        <thead>
            <tr>
                <th sc ope="col">Items</th>
                  
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">{{Cart::getTotalQuantity()}}</th>
                      
                <th scope="row">{{Cart::getTotal()}}</th>
            </tr>
        </tbody>
    </table>
@else
    <p>No hay productos en tu carrito</p>
@endif
</div>

<div class="container" id="botonComprar">
    @auth
    <form action="{{route('pagar')}}">
        <input type="submit" value="Comprar">
    </form>
    @else
    <p>Inicia sesión para comprar</p>
    @endif
</div>


@stop