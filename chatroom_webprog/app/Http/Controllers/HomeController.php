<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Input;
use Redirect;

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
        // $friendlist = DB::table('flist')->where('user',$id)->get();
        $friendlist = DB::table('flist')->where('user',$id)->join('users','flist.friend','=','users.id')->select('users.name','flist.fchatkey','flist.friend')->get();

        $fname='';
        // $fname=[$fname];
        $chat='';
        // $chat=[$chat];
        $fchatkey='';

        return view('home',compact('friendlist','fname','chat','fchatkey'));
        // return $fname;

    }

    public function addfriend(){
        $userid = Auth::id();
        $femail = Input::get('femail');
        $friend = DB::table('users')->where('email', $femail)->get();
        if($friend!=[]){
            $fid = $friend[0] -> id ;
        }else {
            return back();
        }
    
        if($userid<$fid){
            $temp = $userid.'@'.$fid;
            DB::table('flist')->insert(
                array('user' => $userid, 'friend' => $fid, 'fchatkey' => $temp)
            );
            DB::table('flist')->insert(
                array('user' => $fid, 'friend' => $userid, 'fchatkey' => $temp)
            );                
        }else {
            $temp = $fid.'@'.$userid;
            DB::table('flist')->insert(
                array('user' => $fid, 'friend' => $userid, 'fchatkey' => $temp)
                );
            DB::table('flist')->insert(
                array('user' => $userid, 'friend' => $fid, 'fchatkey' => $temp)
                );
        }
        return back();
    }

    public function getchat($fchatkey)
    {
        $chat = DB::table('fchat')->where('fchatkey',$fchatkey)->get();

        $id = Auth::user()->id;
        // $friendlist = DB::table('flist')->where('user',$id)->get();
        $friendlist = DB::table('flist')->where('user',$id)->join('users','flist.friend','=','users.id')->select('users.name','flist.fchatkey','flist.friend')->get();

        $fchat = DB::table('flist')->where('user',$id)->where('fchatkey',$fchatkey)->select('friend')->get();
        if($fchat!==[]){
            $fname = DB::table('users')->where('id',$fchat[0]->friend)->get();
        }


        return view('home',compact('friendlist','chat','fname','fchatkey'));
        // return view('home',compact('friendlist'),compact('chat'),compact('fname'));
        // return $chat;
    }

    public function creategroup(){

        

    }

    public function send($fchatkey)
    {
        DB::table('fchat')->insert(
            ['text'=> Input::get('message'),'fchatkey'=> $fchatkey]
        );  

        $chat = DB::table('fchat')->where('fchatkey', $fchatkey)->get();

        // return view('home',compact('chat','fchatkey'));
        return back();
    }
}
