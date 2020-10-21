<?php

namespace App\Http\Controllers;
use App\Helpers;
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



    $get_req = "SELECT a.id, b.`name` , b.id as u_id, b.user_cnic, b.user_phone, b.user_address, vendor_id, claim_amount, 
mark_to_role, mark_from_role, entry_date_time, flag  FROM payment_request a
INNER JOIN users b ON a.vendor_id=b.id
where flag=1";
$payment_requset_list =   DB::select($get_req);





    return view('payment', compact('userList','payment_requset_list') ); 

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
          $hierarchy_role = session()->get('hierarchy_role');
 
          $hierarchy_role = session()->get('hierarchy_role');
          $next_hierarchy = next_hierarchy($hierarchy_role);
          $previous_hierarchy = previous_hierarchy($hierarchy_role);
    
          $next_role_id = $next_hierarchy;
 
  $request_data = array(         
    'vendor_id'   => "$entry_by",
    'claim_amount'   => "$claim_amount", 
    'mark_to_role'   => "$next_role_id",
    'mark_from_role'   => "$hierarchy_role" 
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
    values ('$request_id','Please process my payment. Thanks','$next_role_id','$hierarchy_role','$entry_by') ";
 DB::insert($ins_request_detail);
 return redirect('/profile');


 
}






    }


    

    public function payment_request_load(Request $request)
    { 
     $hierarchy_role = session()->get('hierarchy_role');
 
$get_req = "SELECT a.id, b.`name`, b.user_cnic, b.user_phone, b.user_address, vendor_id, claim_amount, 
mark_to_role, mark_from_role, entry_date_time,
flag 
FROM payment_request a
INNER JOIN users b ON a.vendor_id=b.id
WHERE mark_to_role='$hierarchy_role' and flag=0 ";

//return $get_req;

$payment_requset_list =   DB::select($get_req);
return view('payment_request',compact('payment_requset_list'));
       

    }

    public function payment_request_detail($id)
    { 
     $hierarchy_role = session()->get('hierarchy_role');

$get_req_d = "SELECT a.id, b.`name`, b.user_cnic, b.user_phone, b.user_address, vendor_id, claim_amount, 
mark_to_role, mark_from_role, entry_date_time,
flag 
FROM payment_request a
INNER JOIN users b ON a.vendor_id=b.id
WHERE mark_to_role='$hierarchy_role' and flag=0 and a.id='$id' ";
$payment_request_detail =   DB::select($get_req_d);
 $get_comments = "SELECT a.id, b.name, request_id, commnet_text, 
 mark_to_role, mark_from_role, 
 (SELECT role_title from roles where role_id= a.mark_to_role )mark_to_role_title,
 (SELECT role_title from roles where role_id= a.mark_from_role )mark_from_role_title,
 entry_by, entry_date

FROM payment_request_comment a
INNER JOIN users b on a.entry_by=b.id
  where request_id='$id'";
$get_comments_list =   DB::select($get_comments);

//return next_hierarchy($hierarchy_role)."|".previous_hierarchy($hierarchy_role);

 

return view('payment_request_detail',compact('payment_request_detail','get_comments_list'));
       

    }


    
    public function payment_next_back(Request $request){

      $submit_next_back = $request->input('submit_next_back');
      $request_id = $request->input('request_id');
      $commnet_text = $request->input('commnet_text');
      $entry_by = session()->get('u_id');
      $hierarchy_role = session()->get('hierarchy_role');
     $next_hierarchy = next_hierarchy($hierarchy_role);
     $previous_hierarchy = previous_hierarchy($hierarchy_role);

      if($submit_next_back == 'Back'){

        $ins_request_detail = "INSERT INTO payment_request_comment 
        (request_id, commnet_text, mark_to_role, mark_from_role,entry_by )
        values ('$request_id','$commnet_text','$previous_hierarchy','$hierarchy_role','$entry_by') ";
        $move_sucess = DB::insert($ins_request_detail);
        $update_header_payment = "update payment_request  set mark_to_role='$previous_hierarchy', mark_from_role='$hierarchy_role'
  where id ='$request_id' ";

      }
      if($submit_next_back == 'Next'){
        if( $hierarchy_role == 1){
          $next_hierarchy = $hierarchy_role;
        }

        $ins_request_detail = "INSERT INTO payment_request_comment 
        (request_id, commnet_text, mark_to_role, mark_from_role,entry_by )
        values ('$request_id','$commnet_text','$next_hierarchy','$hierarchy_role','$entry_by') ";
        $move_sucess =  DB::insert($ins_request_detail);
       if( $hierarchy_role == 1){
           $update_header_payment = "UPDATE  payment_request  set flag=1, mark_to_role='$next_hierarchy', mark_from_role='$hierarchy_role'
        where id ='$request_id' ";
        
       }else{
        $update_header_payment = "UPDATE  payment_request  set mark_to_role='$next_hierarchy', mark_from_role='$hierarchy_role'
        where id ='$request_id' ";
       }
     
      }
if($move_sucess){
 // return $update_header_payment;
   DB::update($update_header_payment);
  return redirect('payment_request');
}else{
  return redirect('payment_request_detail/'.$request_id);
}
      

 


    }

}
