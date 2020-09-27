<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VendorDetail;
use App\User;
use App\Vendor_Route;
use Illuminate\Support\Facades\DB;
class VendorDetailController extends Controller
{
    public function index()
    {       

$vendors_details = "SELECT a.id as user_id , `name`, role_title , decided_milkQuantity, decided_milkQuantity, route_name
from users a 
INNER JOIN user_role b  on a.user_role=b.id  and a.user_role=3
INNER JOIN vendor_details c on a.id=c.vendor_id 
INNER JOIN vendor__routes d on d.id=c.route_id 
 where user_role=3";
 $vendor_details = DB::select($vendors_details);
 return view('VendorDetail/index', compact('vendor_details'));      
    }

    //create view-------------------------

    public function create() 
    {       
        $vendor_details= User::where('user_role','3')->select('name','id')->get();



        $vendor_routes= Vendor_Route::select('route_name','id')->get();

        return view('VendorDetail/create',compact('vendor_details','vendor_routes'));
    }

//create-------------------------


public function store(Request $request)
{
$this->validate($request,[      
    'vendor_id'=> 'required',
    'decided_milkQuantity'=>'required',
    'decided_rate'=>'required', 
    'route_id'=>'required',  
     ]);

$vendor_details = new VendorDetail();

$vendor_details->vendor_id = $request->vendor_id;        
$vendor_details->decided_milkQuantity = $request->decided_milkQuantity;
$vendor_details->decided_rate = $request->decided_rate;
$vendor_details->route_id = $request->route_id;

$vendor_details->save();
return redirect('VendorDetail/index');

}

public function edit($id)
{
    $vendor_details = VendorDetail::findOrFail($id);

    $vendor_lists= User::where('user_role','vendor')->select('name','id')->get();
    $vendor_routes= Vendor_Route::select('route_name','id')->get();
   return view('VendorDetail/edit', compact('product_stocks','products','vendor_lists'));
}


public function update(Request $request, $id)
{

$updatedata = $request->validate([

    'vendor_id'=> 'required',
    'decided_milkQuantity'=>'required',
    'decided_rate'=>'required',
    'route_id'=>'required',
    
   
]);
VendorDetail::whereid($id)->update($updatedata);
return redirect('VendorDetail/index');

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
    

    $vendors_GL = "SELECT  vendor_id, `name`, sum(received_qty)received_qty , sum(received_qty*rate)amounts 
    FROM collection_task_child a
    INNER JOIN users b on a.vendor_id=b.id 
    where  user_role=3 and ".implode(' and ',$where)."
    GROUP BY vendor_id, `name`";
     $vendor_GL_details = DB::select($vendors_GL);

     $get_vend="select DISTINCT vendor_id, `name` from  collection_task_child a 
     inner join users b on a.vendor_id=b.id and user_role=3";
     $get_vendors = DB::select($get_vend);

   return view('vendorLedger', compact('vendor_GL_details','get_vendors'));
}


}
 