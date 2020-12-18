<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;

use App\Models\Role;
use App\Models\State;
use App\Models\City;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */   

  public function showRegistrationForm()
  {
    $roles = Role::where('id', '!=',  '6')->where('id', '!=',  '3')->select('name','id')->orderBy('id', 'ASC')->get();
    return  view('auth.register',  compact('roles') );
  }

  public function register(Request $request)
  {
    //dd($request); die;
    $validator = $request->validate([
        'role_id' =>   'required',
        'name'      => 'required|min:3',
        'email'     => 'required|unique:users',
        'password'  => 'required|min:6',
        'user_cnic' => 'required|min:15|unique:users',
        'user_phone'=> 'required|min:12|unique:users',
        'state'  => 'required',
        'city'  => 'required',
        'user_address'  => 'required|min:3',
        'filenames' => 'required',
        'filenames.*' => 'mimes:jpg,png,jpeg,gif',        
      ]);

      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->user_cnic = $request->user_cnic;
      $user->user_phone = $request->user_phone;
      $user->state = $request->state;
      $user->city = $request->city;
      $user->user_address = $request->user_address;


      if($request->hasfile('filenames')) {
       
            $name =  time().'.'.$request->file('filenames')->extension();
            $request->file('filenames')->move(public_path().'/UserProfile/', $name);  
            $data = $name; 
    }          
      $user->filenames=$data;
      $user->save();
  
      $role=$request->role_id;
      $user->assignRole(Role::where('id', $role)->first());
    return redirect('/home');
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return \App\Models\User
   */


  public function allUserList()
  {
    $users = User::whereHas('roles', function($query) { $query->where('roles.id','!=', 1); })->with('roles')->get();
    return view('user/userList', compact('users'));      
  }

  public function profile($id)
    {
      $users = User::with('roles','vendorDetail','bankDetail','distributorCompany')->findOrFail($id);
    // $as =  $users->filenames;

    //  echo "<pre>";
    //  print_r($as);
    //  exit;
    $user_roles= Role::select('name','id')->get();
      return view('user/profile', compact('users','user_roles')); 
    }

  public function update(Request $request, $id)
  {
    $updatedata = $request->validate([

      'name'      => 'required|min:3',
      'user_cnic' => 'required|min:15',
      'user_phone'=> 'required|min:12',
      'user_address'  => 'required|min:3',
      'roleNames' => 'required',
       
    ]);
   
    User::whereid($id)->update(array(
      'name' => $request->name,
      'user_cnic' => $request->user_cnic,
      'user_phone' => $request->user_phone,
      'user_address' => $request->user_address,
      'email' => $request->email,
  ));
  DB::delete('delete from role_user where user_id = ?',[$id]);

  $rolesName = $request['roleNames'];
  foreach($rolesName as $roleName)
  {
  DB::insert('insert into role_user (role_id, user_id) values (?, ?)', [$roleName, $id]);
  }
  return redirect()->route('profile.user', [$id]);
  }



  

    

}
