<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Invoice;
use App\Models\Role;
use App\Models\holdBatch;

class SaleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {   
        $invoices = Invoice::where('flag','Sold')->with('buyer')->get();            
        return view('Cart/index', compact('invoices'));
    }

    // invoice---------------------------------------------------------
    public function reserveInvoice()
    {   
        $invoices = Invoice::where('flag','Reserve')->with('buyer')->get();
        return view('cart/reserveInvoice', compact('invoices'));
    }

    public function reserveStatus($inv_no)
    {   
        DB::update("UPDATE invoices SET flag = 'Reserve'  WHERE id = '$inv_no'");    
        $invoices = Invoice::where('flag','Reserve')->with('buyer')->get();
        return view('cart/reserveInvoice', compact('invoices'));
    }

    public function SoldStatus($inv_no)
    {   
        DB::update("UPDATE invoices SET flag = 'Sold'  WHERE id = '$inv_no'");    
        $invoices = Invoice::where('flag','Sold')->with('buyer')->get();
        return view('cart/reserveInvoice', compact('invoices'));
    }

    public function onHoldInvoice()
    {   
        $invoices = Invoice::where('flag','On_Hold')->with('buyer')->get();
        return view('cart/onHoldInvoice', compact('invoices'));
    }

    public function generateInvoice() 
    {
        $products_rs = "SELECT id, product_name, product_price, ctn_value, filenames,
        (SELECT IFNULL(SUM(stockInBatch),0) FROM product_stocks WHERE stockInBatch>0 and product_id=a.id)stockInBatch
        FROM products a";    
        $products = DB::select($products_rs);

        $buyers = User::whereHas('roles', function($query) { $query->where('roles.id',3); })->get();
        return view('cart/create',compact('buyers','products')); 
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

        $mid = Auth::id();

        $this->validate($request,[      
        'buyer_id'=> 'required',
        'product_quantity'=>'required',
        'delivery_date'=>'required',
                ]);        
        $invoice = new Invoice();    
        $invoice->buyer_id = $request->buyer_id ;
        $invoice->seller_id=$mid ;
        $invoice->invoice_number = invoiceNumber();
        $invoice->total_amount=0;
        $invoice->flag='in_process';
        $invoice->save();
        $product_quantity = $request['product_quantity'];
        $delivery_date = $request['delivery_date'];

        foreach($product_quantity as $index => $product_qty)
        {
            if($product_qty != null && $product_qty != 0)
            {
                $product_cart = new Cart();
               
                $product_cart->invoice_id = $invoice->id;      
                $product_cart->product_id = $index;
                $product_cart->delivery_due_date = $delivery_date[$index];
            
                $prod_rates = Product::where('id',$product_cart->product_id)->select('product_price','id')->first();
                $price =$prod_rates->product_price;

                $product_cart->product_quantity =  $product_qty;
                $product_cart->product_rate=$price;
                $product_cart->sub_total = $product_cart->product_quantity*$product_cart->product_rate;
                $product_cart->cart_flag="In_Process";

                $invoice->total_amount = $invoice->total_amount+$product_cart->sub_total;
                $invoice->save();
                $product_cart->save();
            }
        }   

        switch ($request->input('action'))
        {
            case 'on_hold':
                $invoice->flag='On_Hold';
                $invoice->save();  
                return redirect('cart/onHoldInvoice');
            break;
            
        }

        $carts = Cart::where('invoice_id', $invoice->id)->where('cart_flag','=','In_Process')->select('id','invoice_id','product_id','product_quantity','product_rate','sub_total','delivery_due_date')->with('product','batch')->get();
        $invoice_objs = Invoice::where('invoice_number', $invoice->invoice_number )->select('invoice_number','buyer_id','total_amount')->with('buyer')->first();
        $buyer_name= $invoice_objs->buyer->name;
        $invoice_no= $invoice_objs->invoice_number;
        $total_amount= $invoice_objs->total_amount; 

        return view('cart/selectbatch',compact('carts','buyer_name','invoice_no','total_amount'));
    }


    //ajax to get batch in model
    public function batchSelection($id)
    {   
       $product_stocks = ProductStock::where('product_id', $id )->where('stockInBatch','<>',0)->select('id','batch_name','stockInBatch','manufactured_date','expire_date')->get();
       return json_encode( $product_stocks );   
    }

    public function SaveBatch(Request $request , $inv)
    {        
        $status= $request->get('name');
        $cart_num = $inv;   

        foreach($status as $index => $select_quantity)
        {
            $values = explode("_",$select_quantity['index']);
            $value = end($values);

            if($select_quantity != null && $select_quantity != 0)
            {
                $hold_batch = new holdBatch();    
                $hold_batch->batch_id = $value;     
                $hold_batch->select_qty = $select_quantity['sq'];
                $hold_batch->cart_id=$cart_num;
                $hold_batch->hb_flag=0;
                $hold_batch->save();
                
                DB::update("UPDATE product_stocks SET stockInBatch = stockInBatch-$hold_batch->select_qty  WHERE id = '$hold_batch->batch_id'");        
            }
        }
        return response()->json(['success'=>'Got Simple Ajax Request.']);
    }

    //only pending invoice delete
    public function deleteInvoice($id)
    {
        $invoices = Invoice::findOrFail($id);
        $invoices->delete();
        return redirect('cart/pendingInvoice');
    }        
}
