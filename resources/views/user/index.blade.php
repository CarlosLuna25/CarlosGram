@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
         <form method="GET" action="{{route('user.index')}}" id="buscador">
                <div class=" form-check-inline ml-5">
                   <input name="search" id="search" class="form-control" style="margin-left:20%; heigth:10%;" placeholder="search an user.." type=text/>
                 <input type="submit" value="submit"  class="btn btn-sm btn-light float-right "/>
                </div>
                </form>
            @foreach ($users as $user)
            <div  class="data-user ">
               
                 @if ($user->image)
                 <div class="avatar-container-profile ml-2">
                    <img class="avatar" src="{{ action('userController@getimg', ['filename'=>$user->image]) }} " alt=""> 
                 </div>
                @endif
            </div>    
                 
                <div class="user-info mb-5 mt-2">
                    <h2>{{$user->name." "." $user->surname"}}</h2>
                    <h3>{{"@".$user->nick}}</h3>
                    <p> {{'se unio: '.\FormatTime::LongTimeFilter($user->created_at)}} </p>
                     <div class="clearfix"></div>
                     <a href=" {{route('profile',['id'=>$user->id])}} " style="text-decoration:none" class="btn btn-sm btn-success mt-2">visitar perfil</a>
                    
                    
                  
                </div>

            
            <div class="clearfix"></div>
            <hr>
            @endforeach
          </div> {{-- final de id posts --}}
          {{$users->links()}}
          
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