<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = "images";

    
    //relacion de uno a muchos
    public function comments(){
        return $this->hasMany('App\Comment')->orderBy('id','desc');
    }

    //relacion de uno a muchos con los likes
    public function likes(){
        return $this->hasMany('App\Like');
    }

    //relacion de muchos a uno para usuarios
   public function user(){
       return $this->belongsTo('App\user', 'user_id'); //recibe el campo con el que se relaciona en la tabla image
   }
}
