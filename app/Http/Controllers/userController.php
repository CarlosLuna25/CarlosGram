<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class userController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    //
    public function config(){
        return view('user.config');
    }
    public function update(Request $request){

        //conseguir usuario identificado
        $user= \Auth::user();
        $id=  $user->id;

        //validacion del formulario
        $validate= $this->validate($request, [
            'name'=> 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,'.$id,//verifica nick unico o que sea del usuario que esta cambiando los datos
            'email' => 'required|string|email|max:255|unique:users,email,'.$id, //verifica email unico o que sea del usuario que esta cambiando
        ]);
        
        
        //recoger datos de formulario
        $name=$request->input('name');
        $surname= $request->input('surname');
        $nick= $request->input('nick');
        $email= $request->input('email');

        //asignar nuevos valores al objeto del usuario
        $user->name=$name;
        $user->surname=$surname;
        $user->nick=$nick;
        $user->email=$email;

        //subir la imagen
        $image_path= $request->file('image_path');
       if ($image_path) {
           # code...
           //poner nombre unico
           $image_path_full= time().$image_path->getClientOriginalName();
           //guardar en la carpeta storage/users
           Storage::disk('users')->put($image_path_full,File::get($image_path));
           //setear img a la variable $user
           $user->image= $image_path_full;

       }

        //ejecutar consultas y cambion de BD
        $user->update();
        return redirect(route('config'))->with(['message'=>'Usuario Actualizado Correctamente']);
       
    }
    public function getimg($filename){
        $file= Storage::disk('users')->get($filename);
        return new Response($file,200);
        

    }
}
