<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comanda;

class ComandaController extends Controller
{
    /**
     * Muestra todos los pedidos si eres administrador.
     * Si no, redirecciona al home
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::user()->isAdmin()){
            $pedidos = Comanda::with('usuario')->orderBy('id', 'desc')->get();
            $data["pedidos"] = $pedidos;

            return view('pedidos', $data);
        }else{
            return redirect()->route('home');
        }
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Muestra el pedido seleccionado con sus detalles si eres administrador.
     * Si no, redirecciona al home.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->isAdmin()){
            $data["pedido"]=Comanda::find($id);
            $data["detalles"]=Comanda::find($id)->detallComanda;

            return view('pedido', $data);
        }else{
            return redirect()->route('home');
        }
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
