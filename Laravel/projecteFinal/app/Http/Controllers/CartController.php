<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Models\ImatgeProducte;

class CartController extends Controller
{
    /**
     * Devuelve la vista del carrito
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("carritoCompra");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Añade el producto seleccionado al carrito, con una imagen asociada a él.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imagen = ImatgeProducte::where('producte_id', $request->id)->first();
        $ruta = $imagen->ruta;

        Cart::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' =>$request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $ruta,
            )
        ));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Actualiza los datos del carrito
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        Cart::update($id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request["quantity"]
            ),
          ));
        return back();
    }

    /**
     * Elimina el producto seleccionado del carrito
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cart)
    {
        Cart::remove($cart);
        return back();
    }
}
