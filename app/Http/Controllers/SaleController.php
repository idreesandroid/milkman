<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cart;
use App\User;
use App\Product;
use App\ProductStock;
use App\Invoice;
use App\Role;

class SaleController extends Controller
{
    public function index()
    {   
       $saleViews = Cart::with('product','buyer','batch','cart_invoice')->get();
              
       return view('Cart/index', compact('saleViews'));
    }


    public function saleRecord()
    {   
    //    $saleRecords = Invoice::with('product','buyer','batch','cart_invoice')->get();
              
    //    return view('Cart/index', compact('saleViews'));
    }

    //create view-------------------------

    public function create() 
    {       
        $products= Product::select('product_name','id')->get();
        $product_stocks=ProductStock::select('batch_name','id')->get();
        $invoices = Invoice::where('flag','=',0)->select('buyer_id','id')->get(); 
       // return   $invoices;

       return view('Cart/create',compact('products','product_stocks','invoices'));
    }


    public function invoiceAjax($id)
    {
        $invoices =Invoice::where("buyer_id",$id)->select('invoice_number','id')->get();
        //return   $invoices;     
        return json_encode($invoices);
    }

    public function batchIdAjax($id)
    {
        $product_stocks =ProductStock::where("product_id",$id)->select('batch_name','id')->get();
       // return   $product_stocks;     
       return json_encode($product_stocks);
    }


//create-------------------------
public function store(Request $request)
{
$this->validate($request,[  
    'buyer_id'=> 'required', 
    'invoice_id'=> 'required',       
    'product_id'=> 'required',   
    'batch_id'=>'required',
    'product_quantity'=>'required',
    //product rate
     ]);

$product_rates = Product::where('id',$request->product_id)->select('product_price','id')->first();
$price =$product_rates->product_price;

$product_cart = new Cart();

$product_cart->buyer_id = $request->buyer_id;
$product_cart->invoice_id = $request->invoice_id;      
$product_cart->product_id = $request->product_id;
$product_cart->batch_id = $request->batch_id;
$product_cart->seller_id = session()->get('u_id');
$product_cart->product_quantity = $request->product_quantity;
$product_cart->product_rate=$price;
$product_cart->sub_total = $request->product_quantity*$product_cart->product_rate;
$product_cart->save();

$invoice_bills= Invoice::where('id', $request->invoice_id)->select('total_amount')->get();
$invoice_bill=$invoice_bills->total_amount;
echo $invoice_bills;
 exit;


//Invoice::where('invoice_number', $request->invoice_id)->update(['total_amount' =>  ]);

// $total_bill=Invoice::where('invoice_id',$request->invoice_id)->update($updatedata);
// return redirect('VendorDetail/index');

 

//return redirect('Cart/index');

}

// invoice---------------------------------------------------------

public function pendingInvoice()
{   
    $invoices = Invoice::where('flag','=',0)->with('buyer_invoice')->get();
    return view('Cart/pendingInvoice', compact('invoices'));
}


public function generateInvoice() 
{
    $buyers = User::whereHas('user_role', function($query) { $query->where('roles.id', 6); })->get();
    return view('Cart/generateInvoice',compact('buyers')); 
}

public function invoiceStore(Request $request)
{
    function invoiceNumber()
    {
        $latest = Invoice::latest()->first();

        if (! $latest) {
            return '000001';
        }

        $string = preg_replace("/[^0-9\.]/", '', $latest->invoice_number);

        return  sprintf('%06d', $string+1);
    }

$this->validate($request,[      
    'buyer_id'=> 'required',            
        ]);

$buyer = new Invoice();    
$buyer->buyer_id = $request->buyer_id ;
$buyer->invoice_number = invoiceNumber();
$buyer->save();
return redirect('Cart/create');

}

//only pending invoice delete
public function deleteInvoice($id)
{
 $invoices = Invoice::findOrFail($id);
 $invoices->delete();
 return redirect('Cart/pendingInvoice');
}
    
}
