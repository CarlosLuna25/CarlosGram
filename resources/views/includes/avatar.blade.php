
 @if (Auth::user()->image != null)
    <div class="avatar-container ml-2">
        <img class="avatar" src="{{ action('userController@getimg', ['filename'=>\Auth::user()->image]) }} " alt=""> 
    </div>
@endif