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
        
        return view('Product/create');  

    }

//create-------------------------


public function store(Request $request)
{
$this->validate($request,[      
    'product_name'=> 'required',
    'product_size'=>'required',
    'product_price'=>'required',
    
     ]);


$products = new Product();

$products->product_name = $request->product_name;        
$products->product_size = $request->product_size;
$products->product_price = $request->product_price;


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
$products = Product::findorfail($id);
return view('Product/edit', compact('products'));
}


public function update(Request $request, $id)
{

$updatedata = $request->validate([

    'product_name'=> 'required',
    'product_size'=>'required',
    'product_price'=>'required',
   
]);
Product::whereid($id)->update($updatedata);
return redirect('Product/index');

}
}
