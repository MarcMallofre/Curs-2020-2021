<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Projecte;


class AdminController extends Controller
{
    /**
     * Muestra todos los administradores y usuarios de la web para el superusuario (ID=1).
     * Si el usuario que intenta acceder no es superusuario, se redirecciona a la home. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->id==1){
            $admins = Admin::all();
            $data["admins"] = $admins;

            $users = User::all();
            $data["users"] = $users;
            return view('administradores', $data);
  
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
     * Obtiene los datos del usuario seleccionado y si no lo es, lo convierte en administrador
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userID = $request->get('users');

        $usuario = User::find($userID);
        

        if (DB::table('admins')
        ->where('email', $usuario->email)
        ->doesntExist()) {    
            $admin = new Admin;
        
            $admin->setAttribute('nom', $usuario->name);
            $admin->setAttribute('email', $usuario->email);

            $admin->save();
        }

    
        return redirect()->route('administradores');
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
     * Elimina el administrador seleccionado para el superusuario. Si esta asociado a algun proyecto, el campo pasará a ser null
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->id==1){
            Projecte::where('admin_id', $id)->update(['admin_id' => null]);

            Admin::find($id)->delete();
        }

        return redirect()->route('administradores');
    }
}
