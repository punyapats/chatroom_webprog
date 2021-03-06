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


Route::post('/addfriend','HomeController@addfriend');
// Add Friend
// Route::post('/addfriend','HomeController@addfriend');

Route::get('/', 'HomeController@index');

Route::get('add', 'HomeController@addfriend');

Route::get('/creategroup','HomeController@creategroup');

Route::post('/chat/{fchatkey}/send', ['as' => 'send', 'uses' => 'HomeController@send']); 
Route::get('/chat/add','HomeController@addfriend');
Route::get('/chat/creategroup','HomeController@creategroup');

Route::get('/chat/{fchatkey}', 'HomeController@getchat');


Route::get('/chat/{fchatkey}/update', 'HomeController@updatechat');

Route::get('/update', 'HomeController@updatechat');

Route::post('/chat//send', 'HomeController@rreturn');


Route::get('/gchat/{gchatkey}', 'HomeController@getgchat');
Route::post('/gchat/{gchatkey}/send', ['as' => 'gsend', 'uses' => 'HomeController@gsend']); 

Route::get('/gupdate', 'HomeController@updategchat');
Route::get('/gchat/{gchatkey}/gupdate', 'HomeController@updategchat');

