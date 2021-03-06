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

        $grouplist = DB::table('glist')->where('user',$id)->get();
        return view('home',compact('friendlist','fname','chat','fchatkey','grouplist'));
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
            $temp = $userid.'a'.$fid;
            DB::table('flist')->insert(
                array('user' => $userid, 'friend' => $fid, 'fchatkey' => $temp)
            );
            DB::table('flist')->insert(
                array('user' => $fid, 'friend' => $userid, 'fchatkey' => $temp)
            );                
        }else {
            $temp = $fid.'a'.$userid;
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

        $grouplist = DB::table('glist')->where('user',$id)->get();

        return view('home',compact('friendlist','chat','fname','fchatkey','grouplist'));
        // return view('home',compact('friendlist'),compact('chat'),compact('fname'));
        // return $chat;
    }

    public function getgchat($gchatkey)
    {
        $chat = DB::table('gchat')->where('gchatkey',$gchatkey)->get();

        $id = Auth::user()->id;

        $friendlist = DB::table('flist')->where('user',$id)->join('users','flist.friend','=','users.id')->select('users.name','flist.fchatkey','flist.friend')->get();

        $gname = DB::table('glist')->where('gchatkey',$gchatkey)->select('groupname')->first();

        $grouplist = DB::table('glist')->where('user',$id)->get();

        // return $gname;
        return view('ghome',compact('friendlist','chat','gchatkey','gname','grouplist'));
        
    }

    public function creategroup(){
        $gname = Input::get('gname');
        $userid = Auth::user()->id;
        $checklist = Input::get('checklist');
        $checklist = $checklist['checklist'];
        $gchatkey = $userid.'a';
        
        $checklistlength = count($checklist);
        for($i=0;$i<$checklistlength;$i++){
            $gchatkey = $gchatkey.$checklist[$i].'a';
        }
        DB::table('glist')->insert(
                array('groupname' => $gname, 'user' => $userid,'gchatkey'=>$gchatkey)
        );
        for($i=0;$i<$checklistlength;$i++){
            DB::table('glist')->insert(
                array('groupname' => $gname, 'user' => $checklist[$i],'gchatkey'=>$gchatkey)
            );

        }

         // return $checklist;
    }

    public function send($fchatkey)
    {
        $name = Auth::user()->name;
        DB::table('fchat')->insert(
            ['text'=> $name.' - '.Input::get('message'),'fchatkey'=> $fchatkey]
        );  

        $chat = DB::table('fchat')->where('fchatkey', $fchatkey)->get();

        // return view('home',compact('chat','fchatkey'));
        return back();
    }


     public function updatechat()
    {
        $fchatkey = Input::get('fchatkey');
        $chat = DB::table('fchat')->where('fchatkey',$fchatkey)->get();

        return $chat;
    }


    public function rreturn()
    {
        return back();
    }

    public function updategchat()
    {
        $gchatkey = Input::get('gchatkey');
        $chat = DB::table('gchat')->where('gchatkey',$gchatkey)->get();

        return $chat;
    }


    public function gsend($gchatkey){

        $name = Auth::user()->name;
        DB::table('gchat')->insert(
            ['text'=> $name.' - '.Input::get('message'),'gchatkey'=> $gchatkey]
        );  

        $chat = DB::table('gchat')->where('gchatkey', $gchatkey)->get();

        // return view('home',compact('chat','fchatkey'));
        return back();

    }
}
