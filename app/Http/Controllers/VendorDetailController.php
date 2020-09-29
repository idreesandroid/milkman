<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VendorDetail;
use App\User;
use App\Role;
use App\State;
use App\City;
use App\Vendor_Route;
use Illuminate\Support\Facades\DB;
class VendorDetailController extends Controller
{
    public function index()
    {       
        $vendorDetails = VendorDetail::with('vendor','vendor_route')->get();
      
        return view('VendorDetail/index', compact('vendorDetails'));


    }

    //create view-------------------------

    public function create() 
    {      
        //$vendor_details= User::where('user_role','3')->select('name','id')->get();

        $roles = Role::select('role_title','id')->get();
        $states = State::select('state_name','id')->get();
        $cities = City::select('city_name','id')->get();
        $vendor_routes= Vendor_Route::select('route_name','id')->get();
        return view('VendorDetail/create',compact('vendor_routes','roles','states','cities'));
    }

//create-------------------------


public function store(Request $request)
{  

     

$this->validate($request,[      
    
     'name'=> 'required',
     'email'=>'required',
     'password'=>'required', 
     'user_cnic'=>'required',  
     'user_phone'=> 'required',
     'user_state'=>'required',
     'user_city'=>'required', 
     'user_address'=>'required',
    //  'role_title'=> 'required',
    
    // 'vendor_id'=> 'required',
     'decided_milkQuantity'=>'required',
     'decided_rate'=>'required', 
     'vendor_location'=>'required',
     'route_id'=>'required',  

     'bank_name'=> 'required',
     'branch_name'=>'required',
     'branch_code'=>'required', 
     'acc_no'=>'required',
     'acc_title'=>'required',  

     ]);



$vendor_register = new User();
$vendor_register->name = $request->name;        
$vendor_register->email = $request->email;
$vendor_register->password = $request->password;
$vendor_register->user_cnic = $request->user_cnic;
$vendor_register->user_phone = $request->user_phone;
$vendor_register->user_state = $request->user_state;
$vendor_register->user_city = $request->user_city;
$vendor_register->user_address = $request->user_address;
// $vendor_register->role_title = $request->role_title;
$vendor_register->save();
$vendor_register->user_role()->attach(Role::where('id', 3)->first());


//$get_vendorId= User::where('user_cnic',$vendor_register->user_cnic)->select('id')->first();

$get_vendorId = User::where('user_cnic',$vendor_register->user_cnic)->first();
$v_id = $get_vendorId->id;

$vendor_details = new VendorDetail();
$vendor_details->vendor_id = $v_id;        
$vendor_details->decided_milkQuantity = $request->decided_milkQuantity;
$vendor_details->decided_rate = $request->decided_rate;
$vendor_details->vendor_location = $request->vendor_location;
$vendor_details->route_id = $request->route_id;

$vendor_details->bank_name = $request->bank_name;        
$vendor_details->branch_name = $request->branch_name;
$vendor_details->branch_code = $request->branch_code;
$vendor_details->acc_no = $request->acc_no;
$vendor_details->acc_title = $request->acc_title;
$vendor_details->save();


return redirect('VendorDetail/index');

}

public function edit($id)
{
//     $vendor_details = VendorDetail::findOrFail($id);

//     $vendor_lists= User::where('user_role','vendor')->select('name','id')->get();
//     $vendor_routes= Vendor_Route::select('route_name','id')->get();
//    return view('VendorDetail/edit', compact('product_stocks','products','vendor_lists'));
}


public function update(Request $request, $id)
{

// $updatedata = $request->validate([

//     'vendor_id'=> 'required',
//     'decided_milkQuantity'=>'required',
//     'decided_rate'=>'required',
//     'route_id'=>'required',
    
   
// ]);
// VendorDetail::whereid($id)->update($updatedata);
// return redirect('VendorDetail/index');

}






public function get_vendors(Request $request)
{

    $get_vend="select DISTINCT vendor_id, `name` from  collection_task_child a 
    inner join users b on a.vendor_id=b.id and user_role=3";
    $get_vendors = DB::select($get_vend);
    return view('vendorLedger', compact('get_vendors'));


}
public function vendorLedger(Request $request)
{

    $vendor_id = $request->input('vendor_id');
    $user_cnic = $request->input('user_cnic');
    $date_from = $request->input('date_from');
    $date_to = $request->input('date_to');
 if(!empty($date_from)){
$where[] = " DATE_FORMAT(received_date_time, '%Y-%m-%d') >= '$date_from' ";
 } if(!empty($date_to)){
    $where[] = " DATE_FORMAT(received_date_time, '%Y-%m-%d') <= '$date_to' ";
     }
     if(!empty($vendor_id)){
        $where[] = " a.vendor_id = '$vendor_id' ";
         }
    
         if(!empty($user_cnic)){
            $where[] = " b.user_cnic = '$user_cnic' ";
             }
    $vendors_GL = "SELECT  vendor_id, `name`, user_cnic, user_phone,  sum(received_qty)received_qty , sum(received_qty*rate)amounts 
    FROM collection_task_child a
    INNER JOIN users b on a.vendor_id=b.id 
    where  user_role=3 and ".implode(' and ',$where)."
    GROUP BY vendor_id, `name`, user_cnic, user_phone";
     $vendor_GL_details = DB::select($vendors_GL);

     $get_vend="select DISTINCT vendor_id, `name` from  collection_task_child a 
     inner join users b on a.vendor_id=b.id and user_role=3";
     $get_vendors = DB::select($get_vend);

     $dates = [
        'date_from'  => $date_from,
        'date_to'  => $date_to,
    ];

   return view('vendorLedger', compact('vendor_GL_details','get_vendors'))->with($dates);
}


}
 