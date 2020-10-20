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
    $invoices = Invoice::where('flag','!=',0)->with('buyer_invoice')->get();              
    return view('Cart/index', compact('invoices'));
}

// invoice---------------------------------------------------------
public function pendingInvoice()
{   
    $invoices = Invoice::where('flag','=',0)->with('buyer_invoice')->get();
    return view('Cart/pendingInvoice', compact('invoices'));
}

public function generateInvoice() 
{
    $products = Product::all();
    $buyers = User::whereHas('user_role', function($query) { $query->where('roles.id', 6); })->get();
    return view('Cart/generateInvoice',compact('buyers','products')); 
}

public function SaveInvoice(Request $request)
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
'product_quantity'=>'required',
        ]);        
$buyer = new Invoice();    
$buyer->buyer_id = $request->buyer_id ;
$buyer->invoice_number = invoiceNumber();
$buyer->total_amount=0;
$buyer->flag=1;
$buyer->save();
$product_quantity = $request['product_quantity'];

foreach($product_quantity as $index => $product_qty)
{
$product_cart = new Cart();
$product_cart->buyer_id = $buyer->buyer_id;
$product_cart->invoice_id = $buyer->id;      
$product_cart->product_id = $index;
$product_cart->batch_id = 2;
$product_cart->seller_id = session()->get('u_id');
$prod_rates = Product::where('id',$product_cart->product_id)->select('product_price','id')->first();
$price =$prod_rates->product_price;
$product_cart->product_quantity =  $product_qty;
$product_cart->product_rate=$price;
$product_cart->sub_total = $product_cart->product_quantity*$product_cart->product_rate;
$product_cart->cart_flag=0;

$buyer->total_amount=$buyer->total_amount+$product_cart->sub_total;
$buyer->save();
$product_cart->save();
}   

switch ($request->input('action'))
{
    case 'save':
        $buyer->flag=0;
        $buyer->save();  
        return redirect('Cart/pendingInvoice');
    break;
}
    return redirect('Cart/index');
}

public function batchSelection()
{   
   $product_stocks = ProductStock::where('product_id', 1 )->where('stockInBatch','!=',0)->with('product')->get();
   echo "<pre>";
   print_r($product_stocks);
   exit;
   //return view('ProductStock/index', compact('product_stocks'));
}

// public function editInvoice($id)
// {
//     $invoices = Invoices::findOrFail($id);
//     $products= Product::select('product_name','id')->get();
//     $buyers = User::whereHas('user_role', function($query) { $query->where('roles.id', 6); })->get();
//    return view('Cart/edit', compact('product_stocks','products','invoices'));
// }
// public function update(Request $request, $id)
// {
// $updatedata = $request->validate([
//     'buyer_id'=> 'required',
//     'product_quantity'=>'required',
// ]);
// ProductStock::whereid($id)->update($updatedata);
// return redirect('ProductStock/index');
// }



//only pending invoice delete
public function deleteInvoice($id)
{
 $invoices = Invoice::findOrFail($id);
 $invoices->delete();
 return redirect('Cart/pendingInvoice');
}
    
}
