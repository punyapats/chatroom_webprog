<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\models\fchat;
use Illuminate\Support\Facades\Input;
use DB;
use Redirect;

class ChatController extends BaseController
{
    public function submit(){
    	DB::table('fchat')->insert(
		    ['text'=> Input::get('message')]
		);  
    	return Redirect::to('home');
   	}
}