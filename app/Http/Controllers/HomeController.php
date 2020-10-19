<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    //variable de paginacion
    private $paginate=4;
    public function index()
    {
        $images= Image::orderBy('id','desc')->paginate($this->paginate);
        return view('home',['images'=>$images]);
    }
    public function pagination(){
        $images= Image::orderBy('id','desc')->paginate($this->paginate);
        return view('includes.pagination',['images'=>$images]);
    }
}
