<?php

namespace App\Http\Controllers;
use DB;

use Illuminate\Http\Request;

class Custcontroller extends Controller
{
    //
    public function home(){
      return view('index');
    }
    public function selectaccount(){
      return view('accounts');
    }
    public function transfer(){
      return view('transfer');
    }
    public function view_cust(){
      $cust = DB::select('select * from customer');
      return response()->json(["customers" => $cust]);
      //  return response()->json(["status" => 1,"message"=>"Marked task as done"]);
    }
    public function transaction(Request $request){
      date_default_timezone_set("Asia/Kolkata");
      DB::insert("insert into transactions(sender_id,receiver_id,amount,t_date,t_time) values(".$request->sender_id.",".$request->receiver_id.",".$request->amount.","."'".date("Y/m/d")."'".","."'".date("h:i:sa")."'".")");
      DB::update("update customer set current_balance=current_balance-".$request->amount." where c_id=". $request->sender_id);
      DB::update("update customer set current_balance=current_balance+".$request->amount." where c_id=". $request->receiver_id);
       return response()->json(["status" => 1,"message"=>"Marked task as done","date"=>date("Y/m/d"),"time"=>date("h:i:sa")]);
    }
}
