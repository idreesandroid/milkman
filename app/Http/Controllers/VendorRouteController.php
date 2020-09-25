<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor_Route;
class VendorRouteController extends Controller
{
    public function index()
    {       
       $vendor_routes = Vendor_Route::all();    
       return view('VendorRoute/index', compact('vendor_routes'));
    }

    //create view-------------------------

    public function create() 
    {       
        return view('VendorRoute/create');
    }

//create-------------------------


public function store(Request $request)
{
$this->validate($request,[      
    'route_name'=> 'required',  
    'route_description'=> 'required',  
     ]);


$vendor_routes = new Vendor_Route();      
$vendor_routes->route_name = $request->route_name;
$vendor_routes->route_description = $request->route_description;
$vendor_routes->save();
return redirect('VendorRoute/index');

}

public function edit($id)
{
   
$vendor_routes = Vendor_Route::findorfail($id);
return view('VendorRoute/edit', compact('vendor_routes'));
}


public function update(Request $request, $id)
{

$updatedata = $request->validate([

    'route_name'=> 'required',
    'route_description'=> 'required',
   
   
]);
Vendor_Route::whereid($id)->update($updatedata);
return redirect('VendorRoute/index');
}
}
