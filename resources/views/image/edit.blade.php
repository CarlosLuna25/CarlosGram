@extends('layouts.app')


@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                   Editar imagen
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('image.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="image_id" value="{{$image->id}}"/>
                        <div class=" form-group row">
                            <label for="image_path" class="col-md-3 col-form-label text-md-right"> Imagen </label>
                            <div class="col-md-7">
                             @if ($image->user->image)
                            <div class="prev-img-container">
                                <img class="avatar"
                                    src="{{ action('imageController@getimg', ['filename'=>$image->image_path]) }} "
                                    alt="" />
                            </div>
                            @endif
                                <input type="file" id="image_path" name="image_path" class="form-control" />
                                @if($errors->has('image_path'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image_path')}}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class=" form-group row">
                            <label for="description" class="col-md-3 col-form-label text-md-right"> descripción </label>
                            <div class="col-md-7">
                                <textarea id="description" name="description" class="form-control" required>{{$image->description}} </textarea>
                                @if($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description')}}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class=" form-group row">
                            <div class="col-md-6 offset-md-3">
                                <input type="submit" value="Actualizar imagen" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection