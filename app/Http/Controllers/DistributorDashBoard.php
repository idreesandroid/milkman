<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Invoice;
use App\Models\ProductStock;
use Illuminate\Http\Request;

class DistributorDashBoard extends Controller
{
    public function myOrders()
    {
        $mid = Auth::id();

        $invoices = Invoice::where('buyer_id' , $mid)->where('flag' , 'Payment_Pending')->get();
        return view('distributor-dashboard/paymentPending', compact('invoices'));
       // return $invoices;
       //return view('role/index', compact('roles'));
    }
}
