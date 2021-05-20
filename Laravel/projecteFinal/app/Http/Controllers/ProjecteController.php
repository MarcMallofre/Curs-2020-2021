<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Projecte;
use App\Models\Admin;
use App\Models\User;
use App\Models\ImatgeProjecte;

class ProjecteController extends Controller
{
    /**
     * Devuelve los ultimos 5 proyectos guardados
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proyectos = Projecte::with('imagenes')->orderBy('id', 'desc')->take(5)->get();
        $data["proyectos"] = $proyectos;

        $admins = Admin::all();
        $data["admins"] = $admins;

        return view('home', $data);
    }

    /**
     * Devuelve la vista con el formulario para añadir un proyecto
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->isAdmin()){
            return view('añadirProyecto');
        }else{
            return redirect()->route('home');
        }
        
    }

    /**
     * Guarda un nuevo proyecto con los datos validados y sus imagenes.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admins = Admin::all();

        foreach($admins as $admin){
            if($admin["email"]==Auth::user()->email){
                $id=$admin["id"];
            }
        }

        $validatedData=$request->validate([
            'nombreProyecto' => 'required|string|max:255',
            'descripcionProyecto' => 'required|string',
            'imagenProyecto' => 'required',
            'imagenProyecto.*' => 'image'
        ]);

    
        $proyecto = new Projecte;
        $proyecto->setAttribute('nom', $request["nombreProyecto"]);
        $proyecto->setAttribute('descripcio', $request["descripcionProyecto"]);
        $proyecto->setAttribute('admin_id', $id);
        $proyecto->save();
 
        foreach($request->file("imagenProyecto") as $imagen){
           
            $nombreImagen=time().$imagen->getClientOriginalName();
            $imagenProyecto = new ImatgeProjecte;
            $imagenProyecto->setAttribute('nom', $nombreImagen);
            $imagenProyecto->setAttribute('ruta', 'img/proyectos/'.$proyecto->id.'/'.$nombreImagen);
            $imagenProyecto->setAttribute('projecte_id', $proyecto->id);
            $imagenProyecto->save();
    
            $imagen->move(public_path().'/img/proyectos/'.$proyecto->id, $nombreImagen);
        }
        
        return view('añadirProyecto');
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
     * Devuelve la vista con el formulario para editar un proyecto si eres admin.
     * Si no, redirecciona a la home
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->isAdmin()){
            $proyecto=Projecte::find($id);
            return view('editarProyecto', $proyecto);

        }else{
            return redirect()->route('home');
        }
    }

    /**
     * Actualiza un proyecto con los datos validados y sus imagenes
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData=$request->validate([
            'nombreProyecto' => 'required|string|max:255',
            'descripcionProyecto' => 'required|string',
            'imagenProyecto.*'  => 'image'
        ]);

        $proyecto = Projecte::find($id);
        $proyecto->nom = $request["nombreProyecto"];
        $proyecto->descripcio = $request["descripcionProyecto"];
        $proyecto->save();

        if($request->hasfile('imagenProyecto')){
            foreach($request->file("imagenProyecto") as $imagen){
           
                $nombreImagen=time().$imagen->getClientOriginalName();
                $imagenProyecto = new ImatgeProjecte;
                $imagenProyecto->setAttribute('nom', $nombreImagen);
                $imagenProyecto->setAttribute('ruta', 'img/proyectos/'.$proyecto->id.'/'.$nombreImagen);
                $imagenProyecto->setAttribute('projecte_id', $proyecto->id);
                $imagenProyecto->save();
        
                $imagen->move(public_path().'/img/proyectos/'.$proyecto->id, $nombreImagen);
            }
        }

        return view('editarProyecto', $proyecto);
    }

    /**
     * Borra la imagen del proyecto seleccionada si eres admin.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->isAdmin()){
            $imatge=ImatgeProjecte::find($id);
            unlink($imatge->ruta);
            $imatge->delete();
        }
        return redirect()->route('home');
        
    }
}
