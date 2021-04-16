<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function formulario(){
        return view ("formulario");
    }

    public function showform(Request $request){
        $validatedData=$request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $data["email"]=$request->input("email");

        return view("showform", $data);
    }

    public function formAvanzado(){
        return view ("formAvanzado");
    }

    public function showFormAvanzado(Request $request){
        $validatedData=$request->validate([
            'email' => 'required|email',
            'nif' => 'required|regex:/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i',
            'fitxer' => 'required|mimes:doc,odt,txt,pdf|max:1000',
            'imatge' => 'required|image|dimensions:min_width=1920,min_height=1080'
        ]);

        $fitxer=$request->file("fitxer");
        $imatge=$request->file("imatge");

        $nomFitxer=time().$fitxer->getClientOriginalName();
        $nomImatge=time().$imatge->getClientOriginalName();

        $fitxer->move(public_path()."/img/", $nomFitxer);
        $imatge->move(public_path().'/img/', $nomImatge);

        $data["email"]=$request->input("email");
        $data["nif"]=$request->input("nif");
        $data["fitxer"]=$nomFitxer;
        $data["imatge"]=$nomImatge;

        return view("showFormAvanzado", $data);
    }
}
 
?>
