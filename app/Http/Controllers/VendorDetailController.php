<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\State;
use App\Models\City;
use App\Models\bankDetail;
use App\Models\vendorDetail;
use App\Models\UserAccount;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class VendorDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {       
        $vendorDetails = User::whereHas('roles', function($query) { 
            $query->where('roles.id', 6);
             })->with('vendorDetail')->get(); 
            
             
        // echo "<pre>";
        // print_r($vendorDetails);
        // exit;
             
        return view('vendor-detail/index', compact('vendorDetails'));

    }
    //create view-----------------------------------------------

    public function create() 
    {      
        return view('vendor-detail/create');
    }

    //create--------------------------------------------------------

    public function store(Request $request)
    {
        if($request->has('bankDetails')){

            $this->validate($request,[        
                'name'      => 'required|min:1',
                'email'     => 'required|unique:users',
                'password'  => 'required|min:1',
                'user_cnic' => 'required|min:13|unique:users',
                'user_phone'=> 'required|min:11|unique:users',
                'state'  => 'required',
                'city'  => 'required',
                'user_address'  => 'required|min:1',

                'filenames' => 'required',
                'filenames.*' => 'mimes:jpg,png,jpeg,gif',   

                'bank_name'=> 'required|min:1',
                'branch_name'=>'required|min:1',
                'branch_code'=>'required|min:1', 
                'acc_no'=>'required|min:1|unique:bank_details',
                'acc_title'=>'required|min:1|unique:bank_details',

                'decided_milkQuantity'=>'required|min:0|numeric',
                'decided_rate'=>'required|min:1|numeric', 
                'morning_decided_milkQuantity'=>'required|min:0|numeric',
                'morningTime'=>'required', 
                'evening_decided_milkQuantity'=>'required|min:0|numeric',
                'eveningTime'=>'required', 
               


                'map_detail' => 'required'
           
                ]);

                $vendor_register = new User();
                $vendor_register->name = $request->name;        
                $vendor_register->email = $request->email;
                $vendor_register->password = Hash::make($request->password);
                $vendor_register->user_cnic = $request->user_cnic;
                $vendor_register->user_phone = $request->user_phone;
                $vendor_register->state = $request->state;
                $vendor_register->city = $request->city;
                $vendor_register->user_address = $request->user_address;

                if($request->hasfile('filenames')) {
       
                    $name =  time().'.'.$request->file('filenames')->extension();
                    $request->file('filenames')->move(public_path().'/UserProfile/', $name);  
                    $data = $name; 
            }          
                $vendor_register->filenames=$data;
                $vendor_register->save();
                $vendor_register->roles()->attach(Role::where('id',6)->first());

                $vendor_details = new vendorDetail();
                $vendor_details->user_id = $vendor_register->id;        
                $mapdata = json_decode($request->map_detail);
                $vendor_details->latitude = $mapdata[0]->geometry[0];
                $vendor_details->longitude = $mapdata[0]->geometry[1];
                $vendor_details->decided_milkQuantity = $request->decided_milkQuantity;
                $vendor_details->decided_rate = $request->decided_rate; 
                
                $vendor_details->morning_decided_milkQuantity = $request->morning_decided_milkQuantity;
                $vendor_details->evening_decided_milkQuantity = $request->evening_decided_milkQuantity;
                $vendor_details->morningTime = $request->morningTime;
                $vendor_details->eveningTime = $request->eveningTime;

               
                $vendor_details->save();

                $bankDetails = new bankDetail();
                $bankDetails->user_id = $vendor_register->id;        
                $bankDetails->bank_name = $request->bank_name;
                $bankDetails->branch_name = $request->branch_name;
                $bankDetails->branch_code = $request->branch_code;
                $bankDetails->acc_no = $request->acc_no;
                $bankDetails->acc_title = $request->acc_title;
                $bankDetails->save();

        }
        else
        
        {
            $this->validate($request,[        
                'name'      => 'required|min:1',
                'email'     => 'required|unique:users',
                'password'  => 'required|min:1',
                'user_cnic' => 'required|min:13|unique:users',
                'user_phone'=> 'required|min:11|unique:users',
                'state'  => 'required',
                'city'  => 'required',
                'user_address'  => 'required|min:1',   
                
                'filenames' => 'required',
                'filenames.*' => 'mimes:jpg,png,jpeg,gif',   

                'decided_milkQuantity'=>'required|min:0|numeric',
                'decided_rate'=>'required|min:1|numeric', 
                'morning_decided_milkQuantity'=>'required|min:0|numeric',
                'morningTime'=>'required', 
                'evening_decided_milkQuantity'=>'required|min:0|numeric',
                'eveningTime'=>'required', 

                'map_detail' => 'required'
               
           
                ]);

                $vendor_register = new User();
                $vendor_register->name = $request->name;        
                $vendor_register->email = $request->email;
                $vendor_register->password = Hash::make($request->password);
                $vendor_register->user_cnic = $request->user_cnic;
                $vendor_register->user_phone = $request->user_phone;
                $vendor_register->state = $request->state;
                $vendor_register->city = $request->city;
                $vendor_register->user_address = $request->user_address;

                
                if($request->hasfile('filenames')) {
       
                    $name =  time().'.'.$request->file('filenames')->extension();
                    $request->file('filenames')->move(public_path().'/UserProfile/', $name);  
                    $data = $name; 
            }          
                $vendor_register->filenames=$data;
                
                $vendor_register->save();
                $vendor_register->roles()->attach(Role::where('id',6)->first());

                $vendor_details = new vendorDetail();
                $mapdata = json_decode($request->map_detail);
                $vendor_details->latitude = $mapdata[0]->geometry[0];
                $vendor_details->longitude = $mapdata[0]->geometry[1];
                $vendor_details->user_id = $vendor_register->id;        
                $vendor_details->decided_milkQuantity = $request->decided_milkQuantity;
                $vendor_details->decided_rate = $request->decided_rate;               
   
                $vendor_details->morning_decided_milkQuantity = $request->morning_decided_milkQuantity;
                $vendor_details->evening_decided_milkQuantity = $request->evening_decided_milkQuantity;
                $vendor_details->morningTime = $request->morningTime;
                $vendor_details->eveningTime = $request->eveningTime;

            $vendor_details->save();        
        }

        $vendor_acc = new UserAccount();
        $vendor_acc->user_id = $vendor_register->id;
        $vendor_acc->role_id =6;
        $vendor_acc->userAccount = generateAccNumber();
        $vendor_acc->balance =0;
        $vendor_acc->save();

        return redirect('vendor-detail/index');
    }


    public function agreementUpdate(Request $request, $id)
    {
        // echo "<pre>";
        // print_r($request->all());
        // exit;

        $updatedata = $request->validate([ 

       

            'decided_milkQuantity'=>'required|min:0|numeric',
            'morning_decided_milkQuantity'=>'required|min:0|numeric',
            'evening_decided_milkQuantity'=>'required|min:0|numeric',
            'decided_rate'=>'required|min:1|numeric', 
            'morningTime'=>'required',
            'eveningTime'=>'required', 
            
        ]);
        vendorDetail::where('user_id', $id)->update($updatedata);
        return redirect()->route('profile.user', [$id]);
    }

    public function bankDetailsUpdate(Request $request, $id)
    {
        $updatedata = $request->validate([
                'bank_name'=> 'required|min:1',
                'branch_name'=>'required|min:1',
                'branch_code'=>'required|min:1', 
                'acc_no'=>'required|min:1',
                'acc_title'=>'required|min:1',


        ]);
        bankDetail::where('user_id', $id)->update($updatedata);
        return redirect()->route('profile.user', [$id]);
    }


    public function vendorDashboard()
    {
        // $Did = Auth::id();

        // $distributorBalance = UserAccount::where('user_id' , $Did)->select('balance')->first();

        // $transaction = UserTransaction::where('user_id' , $Did)->count();
    //  echo "<pre>";
    //  print_r($transaction);
    //  exit;
    return view('vendor.distributor');

    }
}
 