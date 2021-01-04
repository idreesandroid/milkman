<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Invoice;
use App\Models\Role;
use App\Models\holdBatch;

class DistributorPaymentController extends Controller
{
     public function receipt($id)
     { //return $id;
    $invoice = Invoice::where('id', $id)->with('buyer')->first();
    //$invoice_no= $invoice->buyer->name; 
  
    $carts = Cart::where('invoice_id', $id)->get();
        // echo "<pre>";
        // print_r($carts);
        // exit;
    return view('payment/receipt', compact('carts','invoice'));

    }
}
