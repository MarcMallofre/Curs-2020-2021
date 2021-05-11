<?php

namespace App\Http\Controllers; 
use Mail;
use Illuminate\Http\Request;
use App\Mail\CloudHostingProduct;

class MailController extends Controller
{    
    public function mail(Request $request)
    {
        $to_name = 'Marc';
        $to_email = 'mmallofree@fp.insjoaquimmir.cat';
        $data = array('name'=>"Cloudways (sender_name)", "body" => "A test mail");
        
        Mail::send('mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
            ->subject('Laravel Test Mail');
            $message->from('mmallofree@fp.insjoaquimmir.cat','Test Mail');
        });
    
    return 'Email sent Successfully';

    }
}
