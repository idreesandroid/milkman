<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductStock;
class ProductController extends Controller
{

    public function index()
    {        
       $products = Product::all();    
       return view('Product/index', compact('products'));
    }

    //create view-------------------------
    public function create() 
    {
        $units = ['ml','ltr','gm','kg'];
        return view('Product/create',compact('units'));  
    }

//create-------------------------


public function store(Request $request)
{
    
$this->validate($request,[      
    'product_name'=> 'required',
    'product_nick'=>'required',
    'product_size'=>'required',
    'product_price'=>'required',
    'product_description'=>'required',
    'unit'=>'required',
    'ctn_value'=>'required',
    'filenames' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    
     ]);
     

$products = new Product();

$products->product_name = $request->product_name." ".$request->product_size.$request->unit    ;        
$products->product_nick = $request->product_nick;
$products->product_size = $request->product_size;
$products->product_price = $request->product_price;
$products->product_description = $request->product_description;
$products->unit = $request->unit;
$products->ctn_value = $request->ctn_value;

$imageName = time().'.'.$request->filenames->extension();    
$request->filenames->move(public_path('product_img'), $imageName);
$products->filenames = $imageName;

$products->save();

//dd($visitor);

return redirect('Product/index');

}

public function edit($id)
{
    $units = ['ml','ltr','gm','kg'];
$products = Product::findOrFail($id);
return view('Product/edit', compact('products','units'));
}


public function update(Request $request, $id)
{

$updatedata = $request->validate([

    'product_name'=> 'required',
    'product_nick'=>'required',
    'product_size'=>'required',
    'product_price'=>'required',
    'product_description'=>'required',
    'unit'=>'required',
    'ctn_value'=>'required',
   
]);
Product::whereid($id)->update($updatedata);
return redirect('Product/index');

}

public function deleteProduct($id)
{
 $products = Product::findOrFail($id);
 $products->delete();
 return redirect('Product/index');
}
}
