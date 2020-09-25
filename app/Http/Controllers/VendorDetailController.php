<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VendorDetail;
use App\User;
use App\Vendor_Route;

class VendorDetailController extends Controller
{
    public function index()
    {       
        $vendor_details = VendorDetail::with('vendor')->get();
        return view('VendorDetail/index', compact('vendor_details'));      
    }

    //create view-------------------------

    public function create() 
    {       
        $vendor_details= User::where('user_role','vendor')->select('name','id')->get();
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
}
