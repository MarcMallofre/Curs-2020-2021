@extends('layouts.headers.headerProducto')

@section('title', $producto->nom)

@section("seccion")

    <div class=container id="menu">
        <span><a href="{{route('tienda')}}" id="menuEnlace">Tienda</a>-> {{$producto->nom}} </span>
    </div>

    <div class="container" id="producto">
        
        <div id="productoImgDesc">
            <div>
            
            @if($imagenes->Count()>1)
                <div class="slideshow-container" id="carusel">
                    @foreach($imagenes as $imagen)
                    <div class="mySlides ">
                        <img src="../{{$imagen->ruta}}" alt="Imagen del producto" class="img-fluid"> 
                    </div>
                    @endforeach
                
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                </div>
            @else
                @foreach($imagenes as $imagen)
                    <img src="../{{$imagen->ruta}}" alt="" class="img-fluid">
                @endforeach
            @endif
            </div>
            <div id="descripcionProducto">
                <h3>{{$producto->nom}}</h3>
                <p style="white-space: pre-line;">{{$producto->descripcio}}</p>
                <p>{{$producto->preu}} €</p>

                <form action="{{route('añadirCarrito')}}" method="post">
                    @csrf
                    <label for="cantidadProducto">Cantidad</label>
                    <input type="number" name="quantity" id="quantity" value="1" max="5" min="1">
                    <input type="hidden" name="id" value="{{$producto->id}}">
                    <input type="hidden" name="name" value="{{$producto->nom}}">
                    <input type="hidden" name="price" value="{{$producto->preu}}">
                    <input type="submit" value="Añadir al carrito">
                </form>
            </div>
            
        </div>
        
    </div>
@stop