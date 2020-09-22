<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class RegisterController extends Controller
{


  
 

    public function register(Request $request)
    {
      $user_name = $request->input('user_name');
      $email = $request->input('email');
       $user_role = $request->input('user_role');
      $user_cnic = $request->input('user_cnic');
     
      $user_phone = $request->input('user_phone');
      $user_country = $request->input('user_country');
      $user_state = $request->input('user_state');
      $user_city = $request->input('user_city');
      $passw = $request->input('passw');
        // $validator = $request->validate([
        //     'name'      => 'required|min:1',
        //     'email'     => 'required',
        //     'password'  => 'required|min:6'
        //   ]);
        $Records = " INSERT INTO users 
        (`name` , email, `password`, user_role, user_cnic, user_phone, user_country, user_state, user_city,created_time ) 
        VALUES ('$user_name','$email','$passw','$user_role','$user_cnic','$user_phone','$user_country','$user_state','$user_city',CURRENT_TIMESTAMP)";
        DB::insert("$Records");

        return redirect('register')->with('msg','Record Inserted Successfully.');
    }




    


     public function user_role_list(Request $request)
     { 
         $role_query="select id, role_title from user_role";
       //$result =  DB::table('user_role')->get(); 
       $result =  DB::select($role_query);
       
       $country_query="select id, name from countries"; 
       $country =  DB::select($country_query);

       
       $state_query="select id, name from states"; 
       $state =  DB::select($state_query);
       
       $city_query="select id, name from cities";
       $city =  DB::select($city_query);

       return  view('register',  compact('result', 'country','state','city') );
     }

     public function login(Request $request)
     {
     $username = $request->input('username');
     $password = $request->input('password');

       $role_query="select id, `name`, user_role  from users where email='$username' and `password`='$password'";
          $log_result =  DB::select($role_query);
          if(count($log_result)==1){
            foreach ($log_result as $key ) {
            $u_id = $key->id;
            $u_name = $key->name;
            $user_role = $key->user_role;
            
            $request->session()->put('u_id',$u_id);
            $request->session()->put('user_name',$u_name);
            $request->session()->put('user_role',$user_role);
            return redirect('/');

       
            


            }
            }else{
            return redirect('login')->with('msg','Username or password invalid');
            }


      
    } 
    public function logout(Request $request){

      $request->session()->flush();
      return redirect('/login');
  
  
      }


      public function profile(Request $request)
      {
        if(session()->get('u_id')){
    
          $pro_u_id =  session()->get('u_id');
          $pro_user_role =  session()->get('user_role');
         $query_profile="select *  from users where id='$pro_u_id' and user_role='$pro_user_role'  ";
           $profile_result =  DB::select($query_profile);
    
    
           return view('profile', compact('profile_result'));
    
          }
      }
    
}
