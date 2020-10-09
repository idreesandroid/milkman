<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PaymentController extends Controller
{
    //
    public function userList(Request $request)
    { 
   $payments_g = "SELECT b.id , `name` FROM `users` b 
    INNER JOIN role_user c ON c.`user_id`=b.id WHERE c.`role_id`=5";
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



    public function payment_request(Request $request)
    { 

        $claim_amount =  $request->input('claim_amount'); 
          $entry_by = session()->get('u_id');

$chk_role_num = "SELECT a.id, c.`role_id` ,c.`role_title` 
FROM users a
INNER JOIN role_user b ON b.user_id=a.id
INNER JOIN `roles` c ON c.id=b.`role_id`
WHERE a.id = '$entry_by'";
   $chk_role_num_records = DB::select($chk_role_num);

 if(collect($chk_role_num_records)->first()) {
    $result_current_role = json_decode(json_encode($chk_role_num_records[0]), true);
    $current_role_id = $result_current_role['role_id'];

$next_role = "SELECT MAX(role_id)next_role_id FROM roles WHERE role_id < $current_role_id ";
$next_role_rs = DB::select($next_role);

if(collect($next_role_rs)->first()) {
    $next_role_result = json_decode(json_encode($next_role_rs[0]), true);
    $next_role_id = $next_role_result['next_role_id'];
}
       
  }

 

  $request_data = array(         
    'vendor_id'   => "$entry_by",
    'claim_amount'   => "$claim_amount", 
    'mark_to_role'   => "$next_role_id",
    'mark_from_role'   => "$current_role_id" 
    );
    
    
  $request_id =  DB::table('payment_request')->insertGetId($request_data);

  /*
$ins_request = "INSERT INTO payment_request 
(vendor_id, claim_amount, mark_to_role, mark_from_role)
values ('$vendor_id','$claim_amount','$next_role_id','$current_role_id') ";
$ins_request_record = DB::insert($ins_request);
*/

if($request_id>0 ){

    $ins_request_detail = "INSERT INTO payment_request_comment 
    (request_id, commnet_text, mark_to_role, mark_from_role,entry_by )
    values ('$request_id','Please process my payment. Thanks','$next_role_id','$current_role_id','$entry_by') ";
 DB::insert($ins_request_detail);
 return redirect('/profile');


 
}






    }

}
