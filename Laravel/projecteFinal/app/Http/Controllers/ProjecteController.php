<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Projecte;
use App\Models\Admin;

class ProjecteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proyectos = Projecte::all();
        $data["proyectos"] = $proyectos;

        $admins = Admin::all();
        $data["admins"] = $admins;

        return view('home', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admins = Admin::all();

        foreach($admins as $admin){
            if($admin["email"]==Auth::user()->email){
                return view('añadirProyecto');
            }
        }
        return redirect()->route('home');
    }

    /**
     * Store a newly created resource in storage.
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
        ]);

        $proyecto = new Projecte;
        
        $proyecto->setAttribute('nom', $request["nombreProyecto"]);
        $proyecto->setAttribute('descripcio', $request["descripcionProyecto"]);
        $proyecto->setAttribute('admin_id', $id);
        $proyecto->save();

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
