<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class likeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function like($id)
    {
        //recoger datos del usuario y la imagen


        $user = \Auth::user();

        //condicion para no duplicar el like
        $isset_like = Like::where('user_id', $user->id)->where('image_id', (int)$id)->count();
        if ($isset_like == 0) {
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int)$id;
            //guardar
            $like->save();
            return response()->json([
                'like' => $like,
            ]);
        } else {
            return response()->json([
                'message' => 'Ya diste like',
            ]);
        }
    }
    public function dislike($id)
    {
        //recoger datos del usuario y la imagen


        $user = \Auth::user();

        //condicion para no duplicar el like
        $like = Like::where('user_id', $user->id)->where('image_id', (int)$id)->first();
        if ($like) {
           
            //eliminar si existe
            $like->delete();
            return response()->json([
                'like' => $like,
                'message'=>'Dislike correctamente'
            ]);
        } else {
            return response()->json([
                'message' => 'El like no existe',
            ]);
        }
    }

    //listar likes
    public function likes(){
        $user= \Auth::user();
        $likes= Like::where('user_id',$user->id)->orderBy('id', 'desc')->paginate(5);

        return view('like.likes',[
            'likes'=>$likes
        ]);

    }
}
