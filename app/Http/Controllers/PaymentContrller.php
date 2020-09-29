<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PaymentContrller extends Controller
{
    //
    public function userList(Request $request)
    { 
    $payments_g = "SELECT a.id , `name`,  role_title FROM `users`  a 
    INNER JOIN user_role b  ON a.user_role=b.id where a.user_role=3";
    $userList = DB::select($payments_g);
    return view('payment', compact('userList') ); 

    }

    public function payment_to(Request $request)
    {
       $user_id =  $request->input('user_id'); 
       $payment_detail =  $request->input('payment_detail'); 
       $amount =  $request->input('amount'); 
        


    $payment_ins = "Insert into payments (user_id, payment_detail, amount)
    values ('$user_id','$payment_detail','$amount')";
     DB::insert($payment_ins);
    return redirect('payment')->with('msg','successfully paid'); 

    }

}
