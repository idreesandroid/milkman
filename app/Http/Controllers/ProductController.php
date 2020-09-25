<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
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
    'product_size'=>'required',
    'product_price'=>'required',
    'unit'=>'required',
    
     ]);


$products = new Product();

$products->product_name = $request->product_name." ".$request->product_size    ;        
$products->product_size = $request->product_size;
$products->product_price = $request->product_price;
$products->unit = $request->unit;


$products->save();

//dd($visitor);

return redirect('Product/index');

}


// public function show($id)
// {
// //
// }


public function edit($id)
{
    $units = ['ml','ltr','gm','kg'];
$products = Product::findorfail($id);
return view('Product/edit', compact('products','units'));
}


public function update(Request $request, $id)
{

$updatedata = $request->validate([

    'product_name'=> 'required',
    'product_size'=>'required',
    'product_price'=>'required',
    'unit'=>'required',
   
]);
Product::whereid($id)->update($updatedata);
return redirect('Product/index');

}
}
