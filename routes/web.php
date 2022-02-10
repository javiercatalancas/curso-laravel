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
|Route::get('/usuarios', 'UserController@index');
Route::get('/usuarios/crear', 'UserController@create');
Route::post('/usuarios/crear', 'UserController@store');
*/


// Route::resource('usuarios','UserController');
// Route::resource('post','UserController', ['except'=>['create','update']]);
//Route::resource('posts','PostController')->names(['create'=>'posts.crear']);

Route::get('/usuarios', 'UserController@index');

Route::resources(
    ['usuarios'=>'UserController',
    'posts'=>'PostController']
);


//Controladores anidados

Route::resource('post.comments', 'PostCommentController');

Route::resource('comments','CommentController', ['only'=>['index','show']]);
Route::get('/', function () {
    return view('welcome');
});


Route::get('users/{user}', function(App\User $user){
    return $user->email;

});



