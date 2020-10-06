<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductStock;
class ProductStockController extends Controller
{
    public function index()
    {   
       $product_stocks = ProductStock::with('product')->get();
       return view('ProductStock/index', compact('product_stocks'));
    }

    //create view-------------------------

    public function create() 
    {       
        $products= Product::select('product_name','id')->get();
        return view('ProductStock/create',compact('products'));
    }

//create-------------------------


public function store(Request $request)
{
$this->validate($request,[      
    'product_id'=> 'required',
    'batch_name'=>'required',
    'manufactured_date'=>'required',
    'expire_date'=>'required',
    'manufactured_quantity'=>'required',
    
     ]);

$product_stocks = new ProductStock();

$product_stocks->product_id = $request->product_id;        
$product_stocks->batch_name = $request->batch_name;
$product_stocks->manufactured_date = $request->manufactured_date;
$product_stocks->expire_date = $request->expire_date;
$product_stocks->manufactured_quantity = $request->manufactured_quantity;
$product_stocks->manager_id =session()->get('u_id');
$product_stocks->save();
return redirect('ProductStock/index');

}


// public function show($id)
// {
 //
// }


public function edit($id)
{
    $product_stocks = ProductStock::findOrFail($id);
    $products= Product::select('product_name','id')->get();
   return view('ProductStock/edit', compact('product_stocks','products'));
}


public function update(Request $request, $id)
{

$updatedata = $request->validate([

    'product_id'=> 'required',
    'batch_name'=>'required',
    'manufactured_date'=>'required',
    'expire_date'=>'required',
    'manufactured_quantity'=>'required',
   
]);
ProductStock::whereid($id)->update($updatedata);
return redirect('ProductStock/index');

}

public function deleteProductStock($id)
{
 $product_stocks = ProductStock::findOrFail($id);
 $product_stocks->delete();
 return redirect('ProductStock/index');
}
}
