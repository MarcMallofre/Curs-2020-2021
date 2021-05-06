<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Projecte;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if($id==Auth::user()->id){
            $usuario=User::find($id);
            return view('editarUsuario', $usuario);
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
        if(!$request["contraseña"]){

            $validatedData=$request->validate([
                'nombre' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
            ]);

            $usuario = User::find($id);
            $usuario->name = $request["nombre"];
            $usuario->email = $request["email"];
            $usuario->save();

            return view('editarUsuario', $usuario);

        }else{
            $validatedData=$request->validate([
                'nombre' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'contraseña' => 'required|string|confirmed|min:8',
            ]);

            $usuario = User::find($id);
            $usuario->name = $request["nombre"];
            $usuario->email = $request["email"];
            $usuario->password = Hash::make($request["contraseña"]);
            $usuario->save();

            return view('editarUsuario', $usuario);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id==Auth::user()->id){
            $usuario=User::find($id);

            $usuario->delete();

            $admins = Admin::all();

            foreach($admins as $admin){
                if($admin["email"]==Auth::user()->email){
                    $idAdmin=$admin["id"];
                }
            }

            Projecte::where('admin_id', $idAdmin)->update(['admin_id' => null]);
            
            Admin::where('email', $usuario->email)->delete();
        }
        return redirect()->route('home');
    }
}
