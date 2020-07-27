<?php

use Illuminate\Support\Facades\Route;

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
//para llamar al modelo image
use App\Image;

Route::get('/', function () {
	/*
	//para acceder a todos los registros de  la tabla images Image(el modelo)::all(); all() es el metodo que te saca los registros
	$images = Image::all();

	foreach($images as $image){
		// echo "<pre>";
		// 	var_dump($image);
		// echo "</pre>";
		echo $image->image_path.'<br>';
		echo $image->description.'<br>';
		echo $image->user->name." ".$image->user->surname."<br>";
		echo "comentarios".'<br>';
		if(count($image->comments) > 0){
			foreach($image->comments as $comment){
				echo $comment->user->name.' '.$comment->user->surname.' dice : ';
				echo $comment->content.'<br>';
			}
		}
		if(count($image->likes) > 0){
			echo "likes: ". count($image->likes);
		}

		echo "<hr>";


	}
	die();
	*/
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//ese ->name(): es para colocarle un nombre a la ruta pero de manera interna que va a funcionar por dentro(no se va a ver en la url)
//USUARIO
Route::get('/configuracion', 'UserController@config')->name('config');
Route::post('/user/update', 'UserController@update')->name('user.update');
Route::get('/user/avatar/{filename}', 'UserController@getImage')->name('user.avatar');
Route::get('/profile/{id}', 'UserController@profile')->name('profile');
Route::get('/gente/{search?}', 'UserController@index')->name('user.index');

//IMAGEN
Route::get('/subir-imagen', 'ImageController@create')->name('image.create');	
Route::post('/image/save', 'ImageController@save')->name('image.save');
Route::get('/image/file/{filename}', 'ImageController@getImage')->name('image.file');
Route::get('/imagen/{id}', 'ImageController@detail')->name('image.detail');
Route::get('/image/delete/{id}', 'ImageController@delete')->name('image.delete');
Route::get('/image/editar/{id}', 'ImageController@edit')->name('image.edit');
Route::post('image/update', 'ImageController@update')->name('image.update');

//COMENTARIOS

Route::post('/comment/save', 'CommentController@store')->name('comment.save');
Route::get('/comment/delete/{id}', 'CommentController@delete')->name('comment.delete');

//LIKES

Route::get('/like/{image_id}', 'LikeController@like')->name('like.save');
Route::get('/dislike/{image_id}', 'LikeController@dislike')->name('like.delete');
Route::get('/likes', 'LikeController@index')->name('like.likes');