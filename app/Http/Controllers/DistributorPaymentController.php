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
use App\Models\bankList;
use App\Models\DistributorPayment;
class DistributorPaymentController extends Controller
{
     public function receipt($id)
     { //return $id;
    $invoice = Invoice::where('id', $id)->with('buyer')->first();
    //$invoice_no= $invoice->buyer->name; 
    $bankLists = bankList::select('id','bankName')->get();
    $carts = Cart::where('invoice_id', $id)->get();
        // echo "<pre>";
        // print_r($bankList);
        // exit;
    return view('payment/receipt', compact('carts','invoice','bankLists'));
    }

    public function paymentAgainstReceipt(Request $request)
    { 
        $this->validate($request,[      
            'img_receipt' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',    
         ]);   


        if($request->has('paymentMethod'))
    {
        $payment = new DistributorPayment();
        $PM = $request->paymentMethod;

        $payment->paymentMethod = $PM;
        
        if($PM = "atmTransfer" || "cardForCheckout" )
        {
        $payment->bank_name = $request->bankName;
        $payment->depositorName = $request->accTitle;
        $payment->cardLastDigits = $request->cardDigit;
        }
        else if($PM = "internetBanking")
        {
        $payment->bank_name = $request->bankName;
        $payment->depositorName = $request->accTitle;
        $payment->acc_No = $request->accNo;
        } 
        else if($PM = "directDeposit")
        {
        $payment->bank_name = $request->bankName;
        $payment->depositorName = $request->accTitle;
        $payment->branchName = $request->branchName;
        } 
        else if($PM = "easyPaisaTransfer" || "jazzCashTransfer" || "uPaisa" )
        {
        $payment->transactionId = $request->transactionId;
        $payment->senderCell = $request->senderCell;
        $payment->senderCNIC = $request->senderCNIC;
        } 
        else if($PM = "cashAtOffice")
        {
        $payment->depositorName = $request->depositedBy;
        $payment->depositorCNIC = $request->depositorCNIC;
        $payment->receiverName = $request->receivedBy;
        $payment->receiverCNIC = $request->receiverCNIC; 
        } 

        $payment->invoice_no = $request->invNo;
        $payment->distributor_id = $request->buyerName;

        $payment->amountPaid = $request->amount;
        $payment->timeOfDeposit = $request->transactionTime;

        $imageName = time().'.'.$request->img_receipt->extension();    
        $request->img_receipt->move(public_path('receipt_img'), $imageName);
        $payment->receiptPics = $imageName;
       // return $payment;
        $payment->save();
        return "ok";
        // echo "<pre>";
        // print_r($payment);
        // exit;
    }     
        
       
        

   return "ok";
   }
}
