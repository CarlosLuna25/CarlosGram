@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Imagenes que me gustan</h1>
            <hr>
            @foreach ($likes as $like)

              @include('includes.pagination',['image'=>$like->image])
                
            @endforeach
             {{$likes->links()}}
        </div>
    </div>
</div>
@endsection
