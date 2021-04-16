<?php

namespace App\Http\Controllers; 
use Mail;
use Illuminate\Http\Request;
use App\Mail\EnviarMail;

class MailController extends Controller{    
    public function mail(){      
        $name = 'Cos del missatge';      
        Mail::to('mmalloen@gmail.com')->send(new EnviarMail($name));         
        return 'Email enviat correctament';    
    }
}

?>