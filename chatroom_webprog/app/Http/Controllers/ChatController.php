<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use DB;
use Redirect;

class ChatController extends BaseController
{
    public function submit(){

    	$fchatkey='3@5';
    	DB::table('fchat')->insert(
		    ['text'=> Input::get('message'),'fchatkey'=> $fchatkey]
		);  

		$chathistory = DB::table('fchat')->where('fchatkey', $fchatkey);

    	return Redirect::to('home')->with('chathistory', $chathistory);
   	}
}