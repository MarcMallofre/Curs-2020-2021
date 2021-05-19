@extends('layouts.headers.headerTienda')

@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />


@section('title', 'Pago')

@section("seccion")


<div class="container" id="pago">
    
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="panel panel-default">
                
                
                    @if (Session::has('success'))
                    <div class="alert alert-primary text-center">
                        <p>{{ Session::get('success') }}</p>
                    </div>
                    @endif

                    <form role="form" action="{{ route('make-payment') }}" method="post" class="stripe-payment" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="stripe-payment">
                        @csrf
                        <h2>Información de entrega</h2>
                        <div class="panel-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Nombre</label> 
                                <input class='form-control' size='20' type='text' name="Nombre">
                            </div>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Primer Apellido</label> 
                                <input class='form-control' size='20' type='text' name="PrimerApellido">
                            </div>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Segundo Apellido</label> 
                                <input class='form-control' size='20' type='text' name="SegundoApellido">
                            </div>
                        </div>
                     
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Email</label> 
                                <input class='form-control' size='30' type='email' name="Email">
                            </div>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Teléfono</label> 
                                <input class='form-control' size='20' type='text' name="Telefono">
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Dirección</label> 
                                <input class='form-control' size='40' type='text' name="Direccion">
                            </div> 
                        </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Ciudad</label> 
                                <input class='form-control' size='20' type='text' name="Ciudad">
                            </div>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Codigo Postal</label> 
                                <input class='form-control' size='20' type='text' name="CodigoPostal">
                            </div>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Provincia</label> 
                                <input class='form-control' size='20' type='text' name="Provincia">
                            </div>
                        </div>
                   


                        <h2>Información de pago</h2>
            
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Nombre de la tarjeta</label> 
                                <input class='form-control' size='20' type='text'>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Número de la tarjeta</label> 
                                <input autocomplete='off' class='form-control card-num' size='20' type='text'>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVC</label>
                                <input autocomplete='off' class='form-control card-cvc' placeholder='e.g 595' size='4' type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Mes de caducidad</label> 
                                <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Año de caducidad</label> 
                                <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                            </div>
                        </div>

                        <div class='form-row row'>
                            <div class='col-md-12 hide error form-group'>
                                <div class='alert-danger alert'>Fix the errors before you begin.</div>
                            </div>
                        </div>

                        <div class="row">
                            <button class="btn btn-success btn-lg btn-block" type="submit">Pagar {{Cart::getTotal()}}€</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
    $(function () {
        var $form = $(".stripe-payment");
        $('form.stripe-payment').bind('submit', function (e) {
            var $form = $(".stripe-payment"),
                inputVal = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputVal),
                $errorStatus = $form.find('div.error'),
                valid = true;
            $errorStatus.addClass('hide');

            $('.has-error').removeClass('has-error');
            $inputs.each(function (i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorStatus.removeClass('hide');
                    e.preventDefault();
                }
            });

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-num').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeRes);
            }

        });

        function stripeRes(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }
    });
</script>
@stop