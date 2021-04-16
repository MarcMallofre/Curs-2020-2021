<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\NewMessageNotification;  
use App\Events\NewPrivateMessageNotification;
use App\Events\NewCommentNotification;  
use App\Events\NewLike; 
use App\Models\Message;
use App\Models\Imagen;
use App\Models\MensajePrivado;
use App\Models\User;
use App\Models\Comentario;
use App\Models\Like;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data["user_id"] = Auth::user()->id;
        $data["user_name"]= Auth::user()->name;

        $users = User::all()->except(Auth::id());
        
        $mensajes = Message::all();
        $mensajes= $mensajes->reverse();
        $data["mensajes"] = $mensajes;
        $data["users"] = $users;

        $mensajesPrivados = MensajePrivado::all();
        $data["mensajesPrivados"] = $mensajesPrivados;

        $comentaris = Comentario::all();
        $data["comentaris"] = $comentaris;

        $likes = Like::all();
        $data["likes"] = $likes;
        
        
        return view('home', $data);
    }

    public function send(Request $request)
{
        $message = new Message;
        

        $message->setAttribute('from', Auth::user()->name);
        $message->setAttribute('messages', $request["mensaje"]);
        
        

        if($request->file("imagen")){
            $imatge=$request->file("imagen");
            $nomImatge=time().$imatge->getClientOriginalName(); 
            $ruta= $request->file("imagen")->storeAs(Auth::user()->id, $nomImatge, 'public');
    
            $message->setAttribute('imagen', $ruta); 
        }
        $message->save();


        // want to broadcast NewMessageNotification event
        event(new NewMessageNotification($message));
        
    }

    public function sendPrivateMessage(Request $request){

        $privateMessage = new MensajePrivado;


        $privateMessage->setAttribute('from', Auth::user()->id);
        $privateMessage->setAttribute('to', $request["to"]);
        $privateMessage->setAttribute('message', $request["mensaje"]);
        
        
        $privateMessage->save();

        event(new NewPrivateMessageNotification($privateMessage));
    }

    public function sendComment(Request $request){

        $comment = new Comentario;


        $comment->setAttribute('comment', $request["comentario"]);
        $comment->setAttribute('from', Auth::user()->id);
        $comment->setAttribute('user', $request["user"]);
        $comment->setAttribute('id_post', $request["post"]);
        
        
        $comment->save();

        event(new NewCommentNotification($comment));
    }

    public function like(Request $request){


        if (DB::table('likes')
        ->where('id_user', Auth::user()->id)
        ->where('id_post', $request["id_post"])
        ->doesntExist()) {    
            $like = new Like; 
            $like->setAttribute('id_user', Auth::user()->id);
            $like->setAttribute('id_post', $request["id_post"]);
            $like->setAttribute('like', 1);
            $like->setAttribute('user_like', Auth::user()->name);
            $like->save();

        }else{
            $like = Like::where('id_user', Auth::user()->id)
            ->where('id_post', $request["id_post"])
            ->first();
            if($like->like==1){
                Like::where('id_user', Auth::user()->id)
                ->where('id_post', $request["id_post"])
                ->update(['like' => 0]);
            }
            if($like->like==0){
                Like::where('id_user', Auth::user()->id)
                ->where('id_post', $request["id_post"])
                ->update(['like' => 1]);
            }
        }

        $like = Like::where('id_user', Auth::user()->id)
            ->where('id_post', $request["id_post"])
            ->first();
            
        event(new NewLike($like));
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
