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
       $saleViews = Cart::with('product','bill_invoice','buyer','batch')->get();
       return view('Cart/index', compact('saleViews'));
    }


    //create view-------------------------

    public function create() 
    {       
        $products= Product::select('product_name','id')->get();
        $product_stocks=ProductStock::select('batch_name','id')->get();
        $invoices = Invoice::where('flag','=',0)->select('invoice_number','id')->get();     
        return view('Cart/create',compact('products','product_stocks','invoices'));
    }

//create-------------------------
public function store(Request $request)
{
$this->validate($request,[  
    'invoice_id'=> 'required',
    // 'buyer_id'=> 'required',    
    'product_id'=> 'required',
    //seller
    'batch_id'=>'required',
    'product_quantity'=>'required',
    //product rate
     ]);

$product_rates = Product::where('id',$request->product_id)->select('product_price','id')->first();
$price =$product_rates->product_price;

$buyers_name=Invoice::where('id',$request->invoice_id)->select('buyer_id','id')->first();
$buyer =$buyers_name->buyer_id;

$product_cart = new Cart();

$product_cart->invoice_id = $request->invoice_id;        
$product_cart->buyer_id = $buyer;
$product_cart->product_id = $request->product_id;
$product_cart->seller_id = session()->get('u_id');
$product_cart->batch_id = $request->batch_id;
$product_cart->product_quantity = $request->product_quantity;
$product_cart->product_rate=$price;
$product_cart->save();

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

    $buyers = User::whereHas('user_role', function($query) { $query->where('roles.id', 6); })->get();

    // echo $buyers;
    // exit;

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
//'#'.time().str_pad($buyer->id + 1, 8, "0", STR_PAD_LEFT) ;
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
