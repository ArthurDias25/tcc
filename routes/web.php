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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

// Rotas de JavaScript

Route::post('comentAdd', 'Admin\ComentController@store');
Route::post('LikePostAdd','Admin\LikePostController@store');
Route::post('responseAdd','Admin\ResponseController@store');

// Rotas de Form e Inserts no BD

Route::resource('posts', 'Admin\PostController');

Route::resource('likePost', 'Admin\LikePostController');

Route::resource('likeComent', 'Admin\LikeComentController');

Route::resource('coment', 'Admin\ComentController');

Route::post('listAdd', 'Admin\GameController@listStore')->name('listAdd');
Route::post('listEdit/{id}', 'Admin\GameController@listEdit')->name('listEdit');

Route::post('userEdit/{id}','Admin\UserController@editPerfil')->name('editPerfil');

Route::post('follow','Admin\UserController@follow')->name('follow');
Route::post('unfollow/{id}','Admin\UserController@unfollow')->name('unfollow');

Route::resource('response','Admin\ResponseController');

//Route das Views

Route::any('perfil/{id}','Admin\UserController@perfil')->name('perfil');

Route::any('lista/{id}','Admin\GameController@listing')->name('list');

Route::any('seguindo/{id}','Admin\UserController@seguindo')->name('seguindo');

Route::any('seguidores/{id}','Admin\UserController@seguidores')->name('seguidores');

Route::any('/','Admin\UserController@index')->name('index')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');

Route::any('/game/{game_id}','Admin\GameController@game')->name('game');

Route::any('/rank', 'Admin\GameController@rank')->name('rank');

Route::any('/rank/filter/{id}','Admin\GameController@rankFilter')->name('rank.filter');

Route::any('/search','Admin\GameController@search')->name('search');

Route::any('/games','Admin\GameController@games')->name('games');
Route::any('/users','Admin\UserController@users')->name('users');

Route::view('userForm/{id}','public\userEdit')->name('userForm');
