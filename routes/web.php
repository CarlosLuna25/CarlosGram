<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 //use App\Image;

use App\Http\Controllers\HomeController;

Route::get('/welcome', function () {

    //para listar y mostrar comentarios y likes de imagenes
   /*  $images = Image::all();
    foreach ($images as $img) {
        echo $img->image_path . "<br/>";
        echo $img->description . "<br/>";
        echo $img->user->name . " " . $img->user->surname . "<br/>";
        echo $img->user->nick . "<br/>";
        echo "<br/>";
        echo "<strong>".count($img->likes)." LIKES </strong> <br/>";
        if (count($img->comments) >= 1) {
            echo "<strong> Comentarios </strong> <br/>";
            //comentarios de la foto
            foreach ($img->comments as $comment) {
                echo "<strong>" . $comment->user->nick . "</strong>";
                echo "<blockquote>" . $comment->content . "</blockquote>";
            }
        }
        echo "<hr/>";
    }        
    die;           */
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/pagination', 'HomeController@pagination');
Route::get('/configuracion', 'userController@config')->name('config');
Route::post('/user/update', 'userController@update')->name('user.update');
Route::get('/user/avatar/{filename}', 'userController@getimg')->name('user.avatar');
Route::get('/subir-imagen','imageController@create')->name('image.create');
Route::post('/image/save', 'imageController@save')->name('image.save');
Route::get('/image/file/{filename}', 'imageController@getimg')->name('image.file');
Route::get('/image/{id}', 'imageController@detail')->name('image.detail');
Route::post('/comment/save', 'commentController@save')->name('comment.save');
Route::get('/comment/delete/{id}', 'commentController@delete')->name('comment.delete');
Route::get('/like/{image_id}', 'likeController@like')->name('like.save');
Route::get('/dislike/{image_id}', 'likeController@dislike')->name('like.delete');
Route::get('/likes', 'likeController@likes')->name('likes');
Route::get('/profile/{id}', 'userController@profile')->name('profile');
Route::get('/image/delete/{id}', 'imageController@delete')->name('image.delete');
Route::get('/image/edit/{id}', 'imageController@edit')->name('image.edit');
Route::post('/image/update', 'imageController@update')->name('image.update');




