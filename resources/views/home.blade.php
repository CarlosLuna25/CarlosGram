@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('message'))
            <div class="alert alert-success"> {{session('message')}} </div>
            @endif
         <div id="posts">
            @foreach ($images as $image )
             @include('includes.pagination',['image'=>$image])
            @endforeach
          </div> {{-- final de id posts --}}
          {{$images->links()}}
          
        </div>
    </div>
</div>
@endsection

  {{--    <script>
        let page = 2;
        
        
        window.onscroll = () => {
            if ((window.innerHeight + window.pageYOffset+0.5) >= document.body.offsetHeight) {
                const section = document.getElementById('posts');
                console.log(`/pagination?page=${page}`);
                // Pedir al servidor
                fetch(`/pagination?page=${page}`, {
                    method: 'get'
                })
                .then(response => response.text())
                .then(htmlContent => {
                    // Respuesta en HTML
                    section.innerHTML += htmlContent;
                    page += 1;
                })
                .catch(err => console.log(err));                                
            }
        };
    </script> --}}