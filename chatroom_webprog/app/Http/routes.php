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

<<<<<<< HEAD
// Add Friend
Route::post('/addfriend','HomeController@addfriend');
=======
Route::get('/', 'HomeController@index');

Route::post('/add', 'HomeController@add');

Route::post('/send', 'HomeController@send');
>>>>>>> bd8e049b214d4e810ff0ff31635ce91bf6f1c17e
