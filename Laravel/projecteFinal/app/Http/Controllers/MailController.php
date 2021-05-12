<?php

namespace App\Http\Controllers; 
use Mail;
use Illuminate\Http\Request;
use App\Mail\CloudHostingProduct;

class MailController extends Controller
{    
    public function mailBriefing(Request $request)
    {
        $validatedData=$request->validate([
            'informacionEmpresa' => 'required|string|max:255',
            'actividadEmpresa' => 'required|string|max:255',
            'wow' => 'required|string|max:255',
            'posible' => 'required|string|max:255',
            'objetivos' => 'required|string|max:255',
            'ayuda' => 'required|string|max:255',
            'producto' => 'required|string|max:255',
            'instagram' => 'required|string|max:255',
            'facebook' => 'required|string|max:255',
            'linkedin' => 'required|string|max:255',
            'enlaceWeb' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|max:255|email',
            'telefono' => 'required|string|max:255',
        ]);


        $to_name = 'Agencia';
        $to_email = 'mmallofree@fp.insjoaquimmir.cat';
        $data = array(
            'informacionEmpresa'=>$request["informacionEmpresa"], 
            "actividadEmpresa" => $request["actividadEmpresa"],
            "wow" => $request["wow"], 
            "posible" => $request["posible"], 
            "objetivos" => $request["objetivos"], 
            "ayuda" => $request["ayuda"], 
            "producto" => $request["producto"], 
            "instagram" => $request["instagram"], 
            "facebook" => $request["facebook"], 
            "linkedin" => $request["linkedin"], 
            "enlaceWeb" => $request["enlaceWeb"], 
            "nombre" => $request["nombre"], 
            "email" => $request["email"], 
            "telefono" => $request["telefono"] 
        );
        
        Mail::send('mails/mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
            ->subject('Nuevo Briefing');
            $message->from('mmallofree@fp.insjoaquimmir.cat','Agencia Briefing');
        });
    
    return view("mails/emailEnviado");

    }

    public function mailSaluda(Request $request)
    {
        
        $to_name = 'Agencia';
        $to_email = 'mmallofree@fp.insjoaquimmir.cat';
        $data = array(
            'nombre'=>$request["nombre"], 
            "email" => $request["email"],
            "mensaje" => $request["mensaje"], 
        );
        
        Mail::send('mails/mailSaluda', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
            ->subject('Nuevo Mensaje');
            $message->from('mmallofree@fp.insjoaquimmir.cat','Agencia');
        });
    
    return view("mails/emailEnviado");

    }
}


