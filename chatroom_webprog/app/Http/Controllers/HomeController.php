<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $friendlist = DB::table('flist')->where('user'=$id)
        return view('home',compact('friendlist'));
    }

    // public function getfriendlist($id){
    //     // $friendlist = DB::select('SELECT * FROM flist WHERE user='.$id);
    //     $friendlist = DB::table('flist')->where('user'=$id)

    //     return  response()->compact($friendlist);
    // }


    public function send()
    {
        return back();
    }
}
