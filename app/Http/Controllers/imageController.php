<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\File;
use App\Image;

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
}
