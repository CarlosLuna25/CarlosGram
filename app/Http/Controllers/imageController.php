<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\File;
use App\Image;
use App\Like;
use App\Comment;

class imageController extends Controller
{
    //constructor, y aplicacion de middleware para usuarios registrados
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        return view('image.create');
    }

    public function save(Request $request)
    {
        //validacion
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'required|image',
        ]);

        //recoger datos
        $description = $request->input('description');
        $image_path = $request->file('image_path');
        //asignar Valores a un nuevo objeto
        $user = \Auth::user();
        $image = new Image();
        $image->user_id = $user->id;
        $image->image_path = null;
        $image->description = $description;

        //subir imagen
        if ($image_path) {
            $image_path_name= time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }
        $image->save();
        return redirect()->route('home')->with([
            'message'=>'La imagen se subio correctamente'
        ]);
    }

    public function getimg($filename){
        $file= Storage::disk('images')->get($filename);
        return new Response($file,200);
    }
    public function detail($id){
        $image= Image::find($id);
        return view('image.detail',['image'=>$image]);
    }
    public function delete($id){
        $user=\Auth::user();
        $pic= Image::find($id);
        $comments=Comment::where('image_id',$id)->get();
        $likes=Like::where('image_id',$id)->get();
        if($user && $pic&& ($pic->user->id==$user->id)){
            //eliminar comentarios
            if($comments && count($comments)>=1){
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }
            //eliminar likes
            if($likes && count($likes)>=1){
                foreach ($likes as $like) {
                    $like->delete();
                }
            }
            //eliminar ficheros de imagen
            Storage::disk('images')->delete($pic->image_path);

            //eliminar registro de la imagen
            $pic->delete();
            $message= ['message'=>'La imagen se ha borrado correctamente'];
        }else{
            $message= ['message'=>'La imagen no se ha borrado'];
        }
        return redirect()->route('home')->with($message);
    }
    public function edit($id){
        $user=\Auth::user();
        $image= Image::find($id);
        if($user && $image && ($image->user_id==$user->id)){
            return view('image.edit')->with(['image'=>$image]);
        }else{
            return redirect()->route('home');
        }
    }
    public function update(Request $request){
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path' => 'image',
        ]);
        $image_id= $request->input('image_id');
        $description=$request->input('description');
        $image_path=$request->file('image_path');
        //conseguir imagen en bd
        $image= Image::find($image_id);
        $image->description=$description;
         //subir imagen
         if ($image_path) {
            $image_path_name= time().$image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }
        $image->update();
        return redirect()->route('image.detail',['id'=>$image_id])->with(['message'=>'Actualizada correctamente la imagen']);
        


    }
}
