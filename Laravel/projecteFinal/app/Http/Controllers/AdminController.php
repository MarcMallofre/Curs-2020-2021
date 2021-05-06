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
     * Display a listing of the resource.
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
     * Store a newly created resource in storage.
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
     * Remove the specified resource from storage.
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
