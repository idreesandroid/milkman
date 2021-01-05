<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductStock;
class ProductStockController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {  
       // $product_stock = User::with('productStocks')->get();
      // return $product_stock;

       $product_stocks = ProductStock::with('product','Manager')->get();
       //return $product_stocks;
        // $word=$product_stocks->AddBy->name;
        // echo "<pre>";
        // print_r($product_stock);
        // exit;
       return view('product-stock/index', compact('product_stocks'));
    }

        //create view-------------------------

    public function create() 
    {       
        $products= Product::select('product_name','id')->get();
        return view('product-stock/create',compact('products'));
    }

    //create-------------------------

    public function store(Request $request)
    {
        $this->validate($request,[      
            'product_id'=> 'required',
            'manufactured_date'=>'required|date',
            'expire_date'=>'required|date|after_or_equal:manufactured_date',
            'manufactured_quantity'=>'required'        
         ]);

         $mid = Auth::id();

        $product_codes = Product::where('id',$request->product_id)->select('product_nick','id')->first();
        $product_code =$product_codes->product_nick;

        $product_stocks = new ProductStock();

        $product_stocks->product_id = $request->product_id;        
        $product_stocks->batch_name = $product_code.'#'.date('Y-m-d').time();
        $product_stocks->manufactured_date = $request->manufactured_date;
        $product_stocks->expire_date = $request->expire_date;
        $product_stocks->manufactured_quantity = $request->manufactured_quantity;
        $product_stocks->stockInBatch = $request->manufactured_quantity;

        $product_stocks->user_id  =$mid; //it should be come from session
       // $product_stocks->users()->associate($mid);

        $product_stocks->save();

        //$product_stocks->users($mid);
        return redirect('product-stock/index');
    }

    public function edit($id)
    {
        $product_stocks = ProductStock::findOrFail($id);
        $products= Product::select('product_name','id')->get();
        return view('product-stock/edit', compact('product_stocks','products'));
    }


    public function update(Request $request, $id)
    {

        $updatedata = $request->validate([
            'product_id'=> 'required',
            'batch_name'=>'required',
            'manufactured_date'=>'required',
            'expire_date'=>'required',
            'manufactured_quantity'=>'required'
       
        ]);
        ProductStock::whereid($id)->update($updatedata);
        return redirect('product-stock/index');
    }

    public function deleteProductStock($id)
    {
        $product_stocks = ProductStock::findOrFail($id);
        $product_stocks->delete();
        return redirect('product-stock/index');
    }
}
