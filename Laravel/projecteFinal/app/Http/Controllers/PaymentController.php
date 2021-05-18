<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Cart;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use App\Models\Comanda;
use App\Models\DetallComanda;
use Illuminate\Support\Facades\Auth;




class PaymentController extends Controller
{

    public function index()
    {
        if((!Cart::isEmpty())){
            return view('pagar');
        }else{
            return redirect()->route('tienda');
        }
        
    }
  
    public function makePayment(Request $request)
    {

        $validatedData=$request->validate([
            'Nombre' => 'required|string|max:255',
            'PrimerApellido' => 'required|string|max:255',
            'SegundoApellido' => 'required|string|max:255',
            'Email' => 'required|string|max:255|email',
            'Telefono' => 'required|string|max:255',
            'Direccion' => 'required|string|max:255',
            'Ciudad' => 'required|string|max:255',
            'CodigoPostal' => 'required|string|max:255',
            'Provincia' => 'required|string|max:255',
        ]);

        try {
                        Stripe::setApiKey(env('STRIPE_SECRET'));

            $customer = Customer::create(array(
                'email' => $request->Email,
                'source'  => $request->stripeToken,
                'name'  => $request->Nombre,
            ));

            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount'   => Cart::getTotal() * 100,
                'currency' => 'eur'
            ));

            $comanda = new Comanda;
            $comanda->setAttribute('usuari_id', Auth::user()->id);
            $comanda->setAttribute('total', Cart::getTotal());
            $comanda->setAttribute('nom', $request->Nombre,);
            $comanda->setAttribute('primerCognom', $request->PrimerApellido);
            $comanda->setAttribute('segonCognom', $request->SegundoApellido);
            $comanda->setAttribute('email', $request->Email);
            $comanda->setAttribute('telefon', $request->Telefono);
            $comanda->setAttribute('direccio', $request->Direccion);
            $comanda->setAttribute('ciutat', $request->Ciudad);
            $comanda->setAttribute('codiPostal', $request->CodigoPostal);
            $comanda->setAttribute('provincia', $request->Provincia);
            $comanda->setAttribute('data', date("Y-m-d H:i:s"));
            $comanda->save();

            foreach (Cart::getContent() as $item){
                $detallComanda = new DetallComanda;
                $detallComanda->setAttribute('comanda_id', $comanda->id);
                $detallComanda->setAttribute('producte_id', $item->id);
                $detallComanda->setAttribute('quantitat', $item->quantity);
                $detallComanda->save();
            }

            
            Cart::clear();
            return view("compraOk");
       
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
          
        return back();
    }
}