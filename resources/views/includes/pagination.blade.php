@foreach ($images as $image )

<div class="card pub_image mb-5">
    <div class="card-header">
        @if ($image->user->image)
        <div class="avatar-container">
            <img
                class="avatar"
                src="{{ action('userController@getimg', ['filename'=>$image->user->image]) }} "
                alt=""
            />
        </div>
        @endif
        <div class="data-user">
            {{  '@'.$image->user->nick.' ( '.$image->user->name.' '.$image->user->surname.' )' }}
        </div>
    </div>

    <div class="card-body">
        <div class="image-container">
            <a href="{{ route('image.detail',['id'=>$image->id])}}">
                <img
                  sizes="500"  src="{{ route('image.file', ['filename'=>$image->image_path]) }}"
                />
            </a>
        </div>
        <div class="likes">
            <img src="{{ asset('images/hearts-grey.png') }}" alt="" />
        </div>
        <div class="comments">
            <a href="" class="btn btn-warning btn-sm btn-comments">
                Comentarios({{count($image->comments)}})
            </a>
        </div>
        <div class="description clearfix">
           
            <strong class="cursive"> {{  '@'.$image->user->nick.':' }} </strong>
            

            {{$image->description}}
            <span>{{'| '.\FormatTime::LongTimeFilter($image->created_at)}}</span>
        </div>
    </div>
</div>
@endforeach
