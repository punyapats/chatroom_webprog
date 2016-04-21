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
    public function getchat($fchatkey)
    {
        $chat = DB::table('fchat')->where('fchatkey',$fchatkey)->get();

        $id = Auth::user()->id;
        // $friendlist = DB::table('flist')->where('user',$id)->get();
        $friendlist = DB::table('flist')->where('user',$id)->join('users','flist.friend','=','users.id')->select('users.name')->get();

        $fname = DB::table('flist')->where('user',$id)->where('fchatkey',$fchatkey)->first();

        return view('home',compact('friendlist'),compact('chat'),compact('fname'));
    }



    // public function addfriend(){
    //     $friend = DB::select('SELECT email, id  FROM user');
    //     $meds = array();

    //     foreach($medicines as $medicine ) {
    //         $med_info = [
    //             'med_id' => $medicine->med_id,
    //             'med_name' => $medicine->med_name];
    //         array_push($meds, $med_info);
    //     }

    //     return  response()->json(['medicine_list' => $meds ]);
    // }
    // public function getfriendlist($id){
        // $friendlist = DB::select('SELECT * FROM flist WHERE user='.$id);
        // $friendlist = DB::table('flist')->where('user'= $id);

        // return  response()->compact($friendlist);
    // }

    public function send()
    {
        return back();
    }
}
