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
        
        if($PM == "atmTransfer" || $PM == "cardForCheckout" )
        {
        $payment->bank_name = $request->bankName;
        $payment->depositorName = $request->accTitle;
        $payment->cardLastDigits = $request->cardDigit;
        $payment->acc_No = $request->accNo;
        }
        else if($PM == "internetBanking")
        {
        $payment->bank_name = $request->bankName;
        $payment->depositorName = $request->accTitle;
        $payment->acc_No = $request->accNo;
        } 
        else if($PM =="directDeposit")
        {
        $payment->bank_name = $request->bankName;
        $payment->depositorName = $request->accTitle;
        $payment->branchName = $request->branchName;
        } 
        else if($PM == "easyPaisaTransfer" || $PM == "jazzCashTransfer" || $PM == "uPaisa" )
        {
        $payment->transactionId = $request->transactionId;
        $payment->senderCell = $request->senderCell;
        $payment->senderCNIC = $request->senderCNIC;
        } 
        else if($PM == "cashAtOffice")
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
       
        $payment->save();
        return redirect('payment/List');
     
        // echo "<pre>";
        // print_r($payment);
        // exit;
    }     
        
       
        

   return "not ok";
   }


public function PaymentList()
{
    $invoices = DistributorPayment::all();
    return view('payment/index', compact('invoices'));
}

public function verifyTransaction(Request $request , $inv_no)
{
    
    //  echo "<pre>";
    //     print_r($request->all());
    //     exit;
    switch ($request->input('action'))
    {

        case '1':
            DB::update("UPDATE distributor_payments SET `status` = 'verified'  WHERE id	 = '$inv_no'"); 
        break;

        case '2':
            DB::update("UPDATE distributor_payments SET `status` = 'verification failed'  WHERE id	 = '$inv_no'");    
        break;
       
        

        // DB::update("UPDATE distributor_payments SET flag = 'Payment_Pending'  WHERE invoice_number	 = '$inv_no'");    
        // $invoices = Invoice::where('flag','Payment_Pending')->with('buyer')->get();
        
    }
    $vid = Auth::id();
      
        DB::update("UPDATE distributor_payments SET `verifiedBy` = '$vid'  WHERE id	 = '$inv_no'");    
        
        return redirect('payment/List');
}


}
