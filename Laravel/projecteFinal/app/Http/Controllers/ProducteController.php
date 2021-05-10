<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producte;
use App\Models\ImatgeProducte;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class ProducteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function productos()
    {
        if (Auth::user()->isAdmin()){
            $productos = Producte::with('imagenesProducto')->get();
            $data["productos"] = $productos;

            return view('productos', $data);
        }else{
            return redirect()->route('home');
        }
        
    } 


    public function index()
    {
        $productos = Producte::with('imagenProducto')->get();
        $data["productos"] = $productos;

        $admins = Admin::all();
        $data["admins"] = $admins;

        return view('tienda', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->isAdmin()){
            return view('añadirProducto');
        }else{
            return redirect()->route('home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData=$request->validate([
            'nombreProducto' => 'required|string|max:255',
            'descripcionProducto' => 'required|string',
            'imagenProducto' => 'required',
            'imagenProducto.*' => 'image',
            'precioProducto' => 'required',
        ]);

        $producto = new Producte;
        $producto->setAttribute('nom', $request["nombreProducto"]);
        $producto->setAttribute('descripcio', $request["descripcionProducto"]);
        $producto->setAttribute('preu', $request["precioProducto"]);
        $producto->save();
 
        foreach($request->file("imagenProducto") as $imagen){
           
            $nombreImagen=time().$imagen->getClientOriginalName();
            $imagenProducto = new ImatgeProducte;
            $imagenProducto->setAttribute('nom', $nombreImagen);
            $imagenProducto->setAttribute('ruta', 'img/productos/'.$producto->id.'/'.$nombreImagen);
            $imagenProducto->setAttribute('producte_id', $producto->id);
            $imagenProducto->save();
    
            $imagen->move(public_path().'/img/productos/'.$producto->id, $nombreImagen);
        }
        
        return view('añadirProducto');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto=Producte::find($id)->imagenesProducto()->get();
        return view('producto', $producto);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->isAdmin()){
            $producto=Producte::find($id);
            return view('editarProducto', $producto);

        }else{
            return redirect()->route('home');
        }
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
        $validatedData=$request->validate([
            'nombreProducto' => 'required|string|max:255',
            'descripcionProducto' => 'required|string',
            'imagenProducto.*'  => 'image',
            'precioProducto' => 'required',
        ]);

        $producto = Producte::find($id);
        $producto->nom = $request["nombreProducto"];
        $producto->descripcio = $request["descripcionProducto"];
        $producto->preu = $request["precioProducto"];
        $producto->save();

        if($request->hasfile('imagenProducto')){
            foreach($request->file("imagenProducto") as $imagen){
           
                $nombreImagen=time().$imagen->getClientOriginalName();
                $imagenProducto = new ImatgeProducte;
                $imagenProducto->setAttribute('nom', $nombreImagen);
                $imagenProducto->setAttribute('ruta', 'img/productos/'.$producto->id.'/'.$nombreImagen);
                $imagenProducto->setAttribute('producte_id', $producto->id);
                $imagenProducto->save();
        
                $imagen->move(public_path().'/img/productos/'.$producto->id, $nombreImagen);
            }
        }

        return redirect()->route('tienda');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->isAdmin()){
            

            $dir='img/productos/'.$id;
            if (is_dir($dir)) { 
                $objects = scandir($dir);
                foreach ($objects as $object) { 
                  if ($object != "." && $object != "..") { 
                    if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
                      rrmdir($dir. DIRECTORY_SEPARATOR .$object);
                    else
                      unlink($dir. DIRECTORY_SEPARATOR .$object); 
                  } 
                }
                rmdir($dir); 
            } 
            ImatgeProducte::where('producte_id', $id)->delete();

            
            Producte::find($id)->delete();
        }
        return redirect()->route('productos');
    }
}
