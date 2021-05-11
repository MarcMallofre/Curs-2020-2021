@extends('layouts.headers.header')

@section('title', 'Contacta')

@section("seccion")
<div class=container id="menu">
        <span><a href="{{route('home')}}" id="menuEnlace">Home</a> -> Contacto</span>
    </div>

    <div class="container authForm">
        <h2>Briefing exprés</h2>
        <form action="{{route('enviarMail')}}" method="POST" id="contacta">
            @csrf
            <div id="infoEmpresa">

            
            <label for="informacionEmpresa">Información de la empresa y campos de trabajo</label>
            <input type="text" name="informacionEmpresa" id="informacionEmpresa" placeholder="Tu respuesta"> <br>

            <label for="actividadEmpresa">Actividad/producto/servicio de la empresa</label>
            <input type="text" name="actividadEmpresa" id="actividadEmpresa" placeholder="Tu respuesta"><br>

            <label for="wow">¿Cuál es tu "WOW"</label>
            <input type="text" name="wow" id="wow" placeholder="Tu respuesta"><br>

            <label for="posible">¿Cuál es tu "¿Eso es posible?"</label>
            <input type="text" name="posible" id="" placeholder="Tu respuesta"><br>

            <label for="objetivos">¿Cuáles son los objetivos y metas de la empresa?</label>
            <input type="text" name="objetivos" id="objetivos" placeholder="Tu respuesta"><br>

            <label for="ayuda">¿Cómo podemos ayudarte?</label>
            <input type="text" name="ayuda" id="ayuda" placeholder="Tu respuesta"><br>

            <label for="producto">¿Qué problemas resuelve el hecho de comprar tu producto?</label>
            <input type="text" name="producto" id="producto" placeholder="Tu respuesta"><br>
            </div>

            <div id="sociales">
                <label for="">Redes sociales</label>
                <input type="text" name="instagram" id="instagram" placeholder="Instagram"><br>
                <input type="text" name="facebook" id="facebook" placeholder="Facebook"><br>
                <input type="text" name="linkedin" id="linkedin" placeholder="Linkedin"><br>

                <label for="enlaceWeb">Enlace de tu sitio web</label>
                <input type="text" name="enlaceWeb" id="enlaceWeb" placeholder="https://"><br>
                <div id="datosContacto">
                    <input type="text" name="nombre" id="" placeholder="Nombre">
                    <input type="email" name="email" id="email" placeholder="Email">
                    <input type="text" name="telefono" id="telefono" placeholder="Telefono">
                </div>
                
            </div>

            
            

            <input type="submit" value="Enviar">

        </form>

    </div>
@stop