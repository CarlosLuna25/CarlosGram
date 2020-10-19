<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;
class commentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request){
        $validate= $this->validate($request,
          [
              'image_id'=>'integer|required',
              'content'=>'string |required',
          ]);
          $user= \Auth::user();
        $image_id=$request->input('image_id');
        $content= $request->input('content');

        //asignar valores al objeto que guardara el comentario
        $comment= new Comment();
        $comment->user_id= $user->id;
        $comment->image_id=$image_id;
        $comment->content=$content;
        //guardar
        $comment->save();


        return redirect()->route('image.detail',['id'=>$image_id])
        ->with(['message'=>'Comentario publicado con exito!']);
        
       
        

    }
    public function delete($id){
        //conseguir datos de user identificado
        $user=\Auth::user();
        //conseguir comentario
        $comment= Comment::find($id);
        
        //comprobar si soy dueño del comment o publicacion
            if($user && ($comment->user_id== $user->id || $comment->image->user_id==$user->id)){
                $comment->delete();
                return redirect()->route('image.detail',['id'=>$comment->image->id])
        ->with(['message'=>'Comentario eliminado con exito!']);
            }
            else{
                return redirect()->route('image.detail',['id'=>$comment->image->id])
        ->with(['message'=>'NO SE HA ELIMINADO!']);
            }
    }
}
