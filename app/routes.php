<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', ['as' => 'index', 'uses' => 'HomeController@getIndex']);
Route::get('/register', ['as' => 'get-register', 'uses' => 'HomeController@getRegister']);
Route::post('/register', ['as' => 'get-register', 'uses' => 'HomeController@postRegister']);

Route::get('/competitions', ['as' => 'get-competitions', 'uses' => 'HomeController@getCompetitions']);
Route::get('/competition/{id}', ['as' => 'get-competition-page', 'uses' => 'HomeController@getCompetitionPage']);

Route::post('/login', ['as' => 'post-login', 'uses' => 'HomeController@postLogin']);
Route::any('/logout', ['as' => 'post-login', 'uses' => 'HomeController@anyLogout']);

Route::controller('user', 'UserController');
Route::controller('comment', 'CommentController');

Route::any('/test', ['as' => 'test-page', 'uses' => 'HomeController@anyTest']);
