<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Role;
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
      $user_address = $request->input('user_address');

        $validator = $request->validate([
            'name'      => 'required|min:3',
            'email'     => 'required|unique:users',
            'password'  => 'required|min:6',
            'user_cnic' => 'required|min:13|unique:users|numeric',
            'user_phone'=> 'required|min:11|unique:users|numeric',
            'user_state'  => 'required',
            'user_city'  => 'required',
            'user_address'  => 'required|min:10',
          ]);


        $Records = " INSERT INTO users 

        (`name` , email, `password`, user_role, user_cnic, user_phone,  state_id, city_id,user_address,created_time) 
        VALUES ('$user_name','$email','$passw','$user_role','$user_cnic','$user_phone','$user_state','$user_city','$user_address',CURRENT_TIMESTAMP)";
        DB::insert("$Records");

 



        return redirect('register')->with('msg','Record Inserted Successfully.');
    }

     public function user_role_list(Request $request)
     {
       
      $roles = Roles::select('role_title','id')->get();
      $states = States::select('state_name','id')->get();
      $Cities = Cities::select('city_name','id')->get();

      return  view('register',  compact('roles','states','Cities') );

     }


     public function login(Request $request)
     {
     $username = $request->input('username');
     $password = $request->input('password');

      $role_query="select a.id, `name`, user_role , role_title from users a
      inner JOIN roles b on a.user_role=b.id where ( user_phone='$username'  OR   user_cnic='$username' )  and `password`='$password'";
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
        users.id,
        users.`name`,
        users.email,
        user_role.role_title,
        users.user_cnic,
        users.user_phone,
        users.user_city,
        users.user_state,
        users.user_role,
        users.user_address
        FROM
        users
        INNER JOIN user_role ON users.user_role = user_role.id
        order by user_role.role_title";   
        
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
         $query_profile="select *  from users where id='$pro_u_id' and user_role='$pro_user_role'  ";
           $profile_result =  DB::select($query_profile);
    
    
           return view('profile', compact('profile_result'));
    
          }
      }

}
