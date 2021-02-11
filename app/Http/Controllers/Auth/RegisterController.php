<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;

use App\Models\Role;
use App\Models\Distributor;
use App\Models\State;
use App\Models\City;
use App\Models\vendorDetail;
use App\Models\User;

use App\Models\collectionPointManager;

use App\Models\Invoice;
use App\Models\UserTransaction;


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
    $roles = Role::where('id', '!=',  '6')->where('id', '!=',  '3')->where('id', '!=',  '5')->select('name','id')->orderBy('id', 'ASC')->get();
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
        'Confirm'=> 'required_with:password|same:password',
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


    if($request->hasfile('filenames'))
    {
      $name =  time().'.'.$request->file('filenames')->extension();
      $request->file('filenames')->move(public_path().'/UserProfile/', $name);  
      $data = $name; 
    }          
    $user->filenames=$data;
    $user->save();
  
    $role=$request->role_id;
    $user->assignRole(Role::where('id', $role)->first());
    if($role == 2)
    {
      $collectionManager = new collectionPointManager();
      $collectionManager->user_id = $user->id;
      $collectionManager->managerStatus = 'inActive';
      $collectionManager->save();
    }


    return redirect('/DashBoard');
  }


  public function allUserList()
  {
    $users = User::whereHas('roles', function($query) { $query->where('roles.id','!=', 6)->where('roles.id','!=', 5)->where('roles.id','!=', 3); })->with('roles')->get();

    $vendors = User::whereHas('roles', function($query) { $query->where('roles.id','=', 6); })->with('roles')->get();

    $collectors = User::whereHas('roles', function($query) { $query->where('roles.id','=', 5); })->with('roles')->get();

    $distributors = User::whereHas('roles', function($query) { $query->where('roles.id','=', 3); })->with('roles')->get();

    return view('user/userList', compact('users','vendors','collectors','distributors'));      
  }

  public function profile($id)
  {
    $users = User::with('roles','vendorDetail','bankDetail','distributorCompany','userAcc','userAsset')->findOrFail($id);

    $collectorAssets = $users->userAsset; 

    $user_roles= Role::select('name','id')->get();

    if($users->roles[0]['name'] == 'Vendor'){

      $vendors = User::select('users.id','users.name','vendor_details.longitude','vendor_details.latitude')
                  ->join('role_user', 'role_user.user_id', '=', 'users.id')
                  ->join('vendor_details','vendor_details.user_id','=','users.id')
                  ->where('users.id', '=', $id)
                  ->get();
      $location = '[';
      foreach ($vendors as $value) {
          $location .='{"type":"MARKER","id":null,"geometry":['.trim($value->latitude).','.trim($value->longitude).']},';
      }
      $location .= ']';
      
      $location = str_replace("},]","}]",$location);

      return view('user/profile', compact('users','user_roles','location')); 
    }elseif($users->roles[0]['name'] == 'Distributor'){
      $alotedArea = Distributor::select('alotedArea')->where('user_id','=',$id)->first();

      $location = $alotedArea['alotedArea'];
      //echo $id;
      $orderHistory = Invoice::select('invoices.*','users.name')
                      ->join('users','users.id','=','invoices.seller_id')
                      ->where('buyer_id',$id)->get();
      $UserTransaction = UserTransaction::select('*')->where('user_id',$id)->get();

      return view('user/profile', compact('users','user_roles','location','orderHistory','UserTransaction')); 
    }

    return view('user/profile', compact('users','user_roles','collectorAssets')); 
  }

  public function update(Request $request, $id)
  {
    $updatedata = $request->validate([

      'name'      => 'required|min:3',
      'user_cnic' => 'required|min:15',
      'user_phone'=> 'required|min:12',
      'user_address'  => 'required|min:3',
      'email' => 'required',
    ]);
   
    User::whereid($id)->update(array(
      'name' => $request->name,
      'user_cnic' => $request->user_cnic,
      'user_phone' => $request->user_phone,
      'user_address' => $request->user_address,
      'email' => $request->email,
    ));
    return redirect()->route('profile.user', [$id]);
  }

  public function personalProfile()
  {
    $uid = Auth::id();
    $users = User::with('roles','vendorDetail','bankDetail','distributorCompany')->findOrFail($uid);
    //dd($users->roles[0]['name']);
    if($users->roles[0]['name'] == 'Distributor'){

      $orderHistory = Invoice::select('invoices.*','users.name')
                      ->join('users','users.id','=','invoices.seller_id')
                      ->where('buyer_id',$uid)->get();

      $UserTransaction = UserTransaction::select('*')->where('user_id',$uid)->get();

      return view('user/profile', compact('users','orderHistory','UserTransaction')); 
    }
      return view('user/profile', compact('users')); 
  }
  
  public function updatePersonalProfile(Request $request)
  {
    $updatedata = $request->validate([

      'oldPassword'      => 'required',
      'newPassword' => 'required',
      'confirmPassword'=> 'required_with:newPassword|same:newPassword',
      
    ]);
   $pw= auth()->user()->password;
   $uid = Auth::id();

   if(Hash::check($request->oldPassword, $pw))
      {
        User::whereid($uid)->update(array(
        'password' => Hash::make($request->newPassword), 
      ));
      Auth::logout();
      return redirect('/login');
      }
      else
      { 
       return redirect()->route('personal.profile.user')->with('status', 'wrong password!'); 
      }
  }

  public function returnDashBoard()
  {
    $roleArray= auth()->user()->roles()->pluck('roles.id')->toArray();
          
    if(in_array(1, $roleArray))
    { 
      return redirect()->route('admin.DashBoard');
    }
    elseif(in_array(3, $roleArray))
    {
      return redirect()->route('distributor.DashBoard');
    }
    elseif(in_array(5, $roleArray))
    {
      return redirect()->route('collector.DashBoard');
    }
    elseif(in_array(6, $roleArray))
    {
      return redirect()->route('vendor.DashBoard');
    }
    elseif(in_array(2, $roleArray))
    {
      return redirect()->route('generate.morning.task');
    }
    else
    {
      Auth::logout();
      return redirect()->route('login');
    }
  }

  public function searchOrder(Request $request){
    $Invoice = Invoice::select('invoices.*','users.name as saler')
                        ->whereBetween('invoices.created_at', array($request->fromDate, $request->toDate))
                        ->leftJoin('users','users.id','=','invoices.seller_id')
                        ->get();
    return json_decode($Invoice);
  }


  
}
