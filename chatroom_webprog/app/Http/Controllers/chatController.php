<?php
namespace App\Http\Controllers;

class chatController extends Controller {


	public function get_index(){
		return view('chat.index');
	}
}