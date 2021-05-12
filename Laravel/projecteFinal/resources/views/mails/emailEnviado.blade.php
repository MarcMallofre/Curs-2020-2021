@extends('layouts.headers.header')

@section('title', 'Contacta')

@section("seccion")

<div class="container">
    <h2>Mail enviado</h2>
    <p>Nuestro equipo ha recibido la información que has facilitado y en breve se pondrán en contacto contigo.</p>
    <p>Esperamos que tengas una agradable experiencia navegando por nuestra web.</p>
    <p>¡Muchas gracias por confiar en nosotros!</p>
    <p>Pincha <a href="{{route('home')}}">aquí</a> para volver a la página principal</p>
</div>

@stop