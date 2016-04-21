<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// Route::get('/', function () {
//     return view('home');
// });

Route::get('login', function () {
    return view('auth.login');
});

Route::get('register',function(){
	return view('auth.register');
});


Route::auth();

Route::get('/home', 'HomeController@index');

// Add Friend
Route::post('/addfriend','HomeController@addfriend');
Route::get('/', 'HomeController@index');

Route::post('/add', 'HomeController@add');

Route::post('/send', 'HomeController@send');

Route::post('/chat/{fchatkey}', 'HomeController@getchat');
