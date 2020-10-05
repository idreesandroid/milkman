<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cart;
use App\User;
use App\Product;
use App\ProductStock;
use App\Invoice;

class SaleController extends Controller
{
    public function index()
    {   
       $saleViews = Cart::with('product','bill_invoice','buyer','batch')->get();
       return view('Cart/index', compact('saleViews'));
    }


    //create view-------------------------

    public function create() 
    {       
        $products= Product::select('product_name','id')->get();
        $product_stocks=ProductStock::select('batch_name','id')->get();
        $invoices = Invoice::select('buyer_id','id')->get();     
        return view('Cart/create',compact('products','product_stocks','invoices'));
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

$product_stocks->save();
return redirect('ProductStock/index');

}



// invoice---------------------------------------------------------
  
    public function pendingInvoice()
    {   
       $invoices = Invoice::where('flag','=',0)->with('buyer_invoice')->get();
       return view('Cart/pendingInvoice', compact('invoices'));
    }


    public function generateInvoice() 
    {
        $buyers= User::select('name','id')->get();
        return view('Cart/generateInvoice',compact('buyers')); 
    }

    public function invoiceStore(Request $request)
    {
    $this->validate($request,[      
        'buyer_id'=> 'required',
                
         ]);
    
    $buyer = new Invoice();    
    $buyer->buyer_id = $request->buyer_id ;
    $buyer->save();
    return redirect('Product/index');
    
    }

//only pending invoice delete
public function deleteInvoice($id)
{
 $invoices = Invoice::findorfail($id);
 $invoices->delete();
 return redirect('Cart/pendingInvoice');
}
    
}
