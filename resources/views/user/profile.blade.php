@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div  class="data-user ">
               
                 @if ($user->image)
                 <div class="avatar-container-profile ml-2">
                    <img class="avatar" src="{{ action('userController@getimg', ['filename'=>$user->image]) }} " alt=""> 
                 </div>
                @endif
                
                 
                <div class="user-info mb-5">
                    <h2>{{$user->name." "." $user->surname"}}</h2>
                    <h3>{{"@".$user->nick}}</h3>
                    <p> {{'se unio: '.\FormatTime::LongTimeFilter($user->created_at)}} </p>
                     <div class="clearfix"></div>
                     <h4><div class="count-pub">{{count($user->images).' Publicaciones '}}</div> <div class="count-pub fav">{{count($likes).' Favoritas'}}</div> </h4>
                    
                    
                  
                </div>

            </div>
           
            <div class="clearfix"></div> <hr>
            <br>
            @foreach ($user->images as $image)

              @include('includes.pagination',['image'=>$image])
                
            @endforeach
             
        </div>
    </div>
</div>
@endsection