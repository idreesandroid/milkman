<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Role;
use App\State;
use App\City;
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
      $dasignation_id = $request->input('dasignation_id');
      
      $passw = $request->input('passw');
      $user_address = $request->input('user_address');

    $validator = $request->validate([
            'user_name'      => 'required|min:3',
            'email'     => 'required|unique:users',
            'passw'  => 'required|min:6',
            'user_cnic' => 'required|min:13|unique:users|numeric',
            'user_phone'=> 'required|min:11|unique:users|numeric',
            'user_state'  => 'required',
            'user_city'  => 'required',
            'user_address'  => 'required|min:10',
            'dasignation_id'  => 'required'
          ]);
       

/*
        $Records = " INSERT INTO users 
 
        (`name` , email, `password`, user_role, user_cnic, user_phone,  state_id, city_id,user_address,created_time) 
        VALUES ('$user_name','$email','$passw','$user_role','$user_cnic','$user_phone','$user_state','$user_city','$user_address',CURRENT_TIMESTAMP)";
 
        DB::insert("$Records");
*/
 
        $insert_user = array(
         
          'name'   => "$user_name",
          'email'   => "$email", 
          'password'   => "$passw",
          'user_cnic'   => "$user_cnic",
          'user_phone'   => "$user_phone",
          'state_id'   => "$user_state",
          'city_id'   => "$user_city",
          'user_address'   => "$user_address",
          'dasignation_id'   => "$dasignation_id" 

  
          );
          
          
        $user_id =  DB::table('users')->insertGetId($insert_user);
     

$enter_role = "insert into role_user (user_id, role_id) values ('$user_id','$user_role') ";
DB::insert("$enter_role");


 //return $enter_role;
 


        return redirect('register')->with('msg','Record Inserted Successfully.');
    }

     public function user_role_list(Request $request)
     {
       
      $roles = Role::where('id', '!=',  '25')->select('role_title','id')->get();
      $states = State::select('state_name','id')->get();
      $Cities = City::select('city_name','id')->get();

      $load_d = "SELECT  id,  designation_title FROM `designations` ORDER BY id ASC";
      $load_designation =  DB::select($load_d);
      


      return  view('register',  compact('roles','states','Cities','load_designation') );

     }


     public function login(Request $request)
     {
     $username = $request->input('username');
     $password = $request->input('password');

      $role_query=" 
      SELECT a.id,    a.name,c.id AS user_role,c.`role_title` 
FROM users a 
INNER JOIN role_user b ON b.user_id=a.id
INNER JOIN roles c ON c.id=b.`role_id`
 
WHERE    (a.`user_cnic`='$username' OR a.`user_phone`='$username') and a.`password`='$password' ";
          $log_result =  DB::select($role_query);
          if(count($log_result)==1){
            foreach ($log_result as $key ) {
            $u_id = $key->id;
            $u_name = $key->name;
            $user_role = $key->user_role;
            $role_title= $key->role_title;
            $request->session()->put('u_id',$u_id);
            $request->session()->put('user_name',$u_name);
            $request->session()->put('user_role',$user_role);
            $request->session()->put('role_title',$role_title);
           
            return redirect('/'); 
            }
            }else{
            return redirect('login')->with('msg','Username or password invalid');

       }
            }
   
    

       
            


     public function userList()
     {
         
        $users_que =  "SELECT 
        a.id, 
        a.name, 
        a.email, 
        c.`role_title`,
        a.user_cnic, 
        user_phone, 
        city_id , 
        state_id,
        c.id AS user_role,
        user_address
        FROM users a 
        INNER JOIN role_user b ON b.user_id=a.id
        INNER JOIN roles c ON c.id=b.`role_id`";   
        
        $users = DB::select($users_que);
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

  'name'      => 'required|min:3',
  'email'     => 'required|unique',
  'password'  => 'required|min:6',
  'user_cnic' => 'required|min:13|unique|numeric',
  'user_phone'=> 'required|min:11|unique|numeric',
  'state_id'  => 'required',
  'city_id'  => 'required',
  'user_address'  => 'required|min:10',
   
]);
User::whereid($id)->update($updatedata);
return redirect('user/userList');

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
          $query_profile="SELECT a.id, a.name, a.email, a.user_cnic, user_phone, user_address, state_id, city_id ,c.id AS user_role,c.`role_title`
         FROM users a 
         INNER JOIN role_user b ON b.user_id=a.id
         INNER JOIN roles c ON c.id=b.`role_id`
          
         WHERE a.id='$pro_u_id' and c.id='$pro_user_role'  ";
           $profile_result =  DB::select($query_profile);
    
    
           return view('profile', compact('profile_result'));
    
          }
      }

}
