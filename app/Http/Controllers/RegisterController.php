<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
class RegisterController extends Controller
{
    public function register(Request $request)
    {

      
     
     
      $user_name = $request->input('user_name');
      $email = $request->input('email');
      $user_role = $request->input('user_role');
      $user_cnic = $request->input('user_cnic');
      $user_phone = $request->input('user_phone');
      $user_state = $request->input('user_state');
      $user_city = $request->input('user_city');
      $user_address = $request->input('user_address');
      $passw = $request->input('passw');
        // $validator = $request->validate([
        //     'name'      => 'required|min:1',
        //     'email'     => 'required',
        //     'password'  => 'required|min:6'
        //   ]);
        $Records = " INSERT INTO users 
        (`name` , email, `password`, user_role, user_cnic, user_phone,  user_state, user_city,user_address,created_time ) 
        VALUES ('$user_name','$email','$passw','$user_role','$user_cnic','$user_phone','$user_state','$user_city','$user_address',CURRENT_TIMESTAMP)";
        DB::insert("$Records");

        return redirect('register')->with('msg','Record Inserted Successfully.');
    }




     public function user_role_list(Request $request)
     {
       
         $role_query="select id, role_title from user_role";
       //$result =  DB::table('user_role')->get(); 
       $result =  DB::select($role_query);   

       
       $state_query="select id, name from states"; 
       $state =  DB::select($state_query);
       
       $city_query="select id, name from cities";
       $city =  DB::select($city_query);

       return  view('register',  compact('result','state','city') );
     }

     public function userList()
     {
         
        $users = User::all();    
        return view('user/userList', compact('users'));
       
 
     }

     public function edit($id)
{
    $users = User::findOrFail($id);
    $user_roles= User_Role::select('role_title','id')->get();
   return view('user/edit', compact('users','user_roles'));
}


public function update(Request $request, $id)
{

$updatedata = $request->validate([

    'name'=> 'required',
    'email'=>'required',
    'password'=>'required',
    // 'user_role'=>'required',
    'user_cnic'=>'required',
    'user_phone'=>'required',
    // 'user_state'=>'required',
    // 'user_city'=>'required',
    'user_address'=>'required',
   
]);
User::whereid($id)->update($updatedata);
return redirect('user/userList');

}

}
