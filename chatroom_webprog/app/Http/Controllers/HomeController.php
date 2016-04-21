<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use DB;

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
        $friendlist = DB::table('flist')->where('user',$id)->join('users','flist.friend','=','users.id')->select('users.name')->get();

        // return view('home',compact('friendlist'));
        return view('home',compact('friendlist'))
            ->with('id',$id);
    }

    public function addfriend(){
        $userid = Input::get('userid');
        $femail = Input::get('femail');
        $friend = DB::table('users')->where('email', $femail);
        $fid = $friend -> id ;
        if(exist($friend)){
            return;
        }
        if(intval($userid)<intval($fid)){
            $temp = $userid.'#'.$fid;
            DB::table('flist')->insert(
                array('user' => $userid, 'friend' => $fid, 'fchatkey' => $temp)
            );
            DB::table('flist')->insert(
                array('user' => $fid, 'friend' => $userid, 'fchatkey' => $temp)
            );

                
        }else {
            if(intval($userid)<intval($fid)){
            $temp = $fid.'#'.$userid;
            DB::table('flist')->insert(
                array('user' => $fid, 'friend' => $userid, 'fchatkey' => $temp)
                );
            }
            DB::table('flist')->insert(
                array('user' => $userid, 'friend' => $fid, 'fchatkey' => $temp)
                );
            }
    }

    public function send()
    {
        return back();
    }
}
