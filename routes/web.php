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

Auth::routes();

Route::resource('posts', 'Admin\PostController');

Route::resource('like', 'Admin\PostLikeController');

Route::any('/perfil/{id}','Admin\UserController@perfil')->name('perfil');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('post/{id}', function(){
    return view('layouts.post');
});

Route::any('/rank', 'Admin\GameController@rank')->name('rank');

Route::any('/rank/filter/{id}','Admin\GameController@rankFilter')->name('rank.filter');