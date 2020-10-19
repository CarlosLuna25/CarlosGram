@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
           
            <div id="posts">
                <div class="card pub_image_detail mb-5">
                    <div class="card-header">
                        @if ($image->user->image)
                        <div class="avatar-container">
                            <img class="avatar"
                                src="{{ action('userController@getimg', ['filename'=>$image->user->image]) }} "
                                alt="" />
                        </div>
                        @endif
                        <div class="data-user">
                            {{  '@'.$image->user->nick.' ( '.$image->user->name.' '.$image->user->surname.' )' }}
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="image-detail">
                            <img src="{{ route('image.file', ['filename'=>$image->image_path]) }}" />
                        </div>
                        <div class="likes">
                            <img src="{{ asset('images/hearts-grey.png') }}" alt="" />
                        </div>

                        <div class="description mt-2 clearfix">
                            <strong class="cursive">
                                {{  '@'.$image->user->nick.':' }}
                            </strong>

                            {{$image->description}}
                            <span>{{'| '.\FormatTime::LongTimeFilter($image->created_at)}}</span>
                        </div>
                        <div class="comments">
                            <div calss="clearfix"></div>
                            @if (session('message'))
                            <div class="alert alert-success"> {{session('message')}} </div>
                            @endif
                            <h2>Comentarios({{count($image->comments)}})</h2>
                            <hr />
                            <form action="{{ route('comment.save') }}" method="post">
                                @csrf
                                <input type="hidden" value=" {{$image->id}}" name="image_id" />

                                <p>
                                    <textarea name="content" class="form-control" id=""
                                       placeholder="leave a comment" ></textarea>
                                    @if($errors->has('content'))
                                    <span  class="form-control alert alert-danger {‌{ $errors->has('content') ? ' is-invalid' : '' }}"  role="alert">
                                        <strong>{{ $errors->first('content')}}</strong>
                                    </span>
                                    @endif
                                </p>
                                <button type="submit" class="btn btn-success">
                                    Enviar
                                </button>
                            </form>
                            @foreach($image->comments as $comment)
                                <div class="comment"> <strong class="cursive">
                                    {{  '@'.$comment->user->nick.':' }}
                                </strong>
    
                                {{$comment->content}}
                                <span>{{'|     '.\FormatTime::LongTimeFilter($comment->created_at)}}</span>
                                @if(Auth::check() && ($comment->user_id== Auth::user()->id || $comment->image->user_id==Auth::user()->id))
                                <p><a href="{{route('comment.delete',['id'=>$comment->id])}}">Eliminar</a></p>
                                @endif
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {{-- final de id posts --}}
        </div>
    </div>
</div>
@endsection