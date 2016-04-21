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
        return view('home');
    }

    public function getfriendlist(){
        $friendlist = DB::select('SELECT med_id, med_name  FROM medicine');
        $meds = array();

        foreach($medicines as $medicine ) {
            $med_info = [
                'med_id' => $medicine->med_id,
                'med_name' => $medicine->med_name];
            array_push($meds, $med_info);
        }

        return  response()->json(['medicine_list' => $meds ]);
    }
}
