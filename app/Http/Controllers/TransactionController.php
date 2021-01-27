<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\bankList;
use App\Models\UserAccount;
use App\Models\UserTransaction;
use App\Models\User;
use App\Models\Invoice;

class TransactionController extends Controller
{


    public function transactionList()
    {
        //$transactions = UserTransaction::with('transactionBy','transactionBelongsTo')->all();
        $transactions=DB::table('user_transactions')
        ->select('userAccount','name','user_transactions.id','paymentMethod','bank_name','branchName','depositorName','acc_No','cardLastDigits','transactionId','senderCell','timeOfDeposit','amountPaid','receiptPics','verifiedBy','depositorCNIC','receiverName','receiverCNIC','status')
        ->join('users','user_id','=','users.id')
        ->join('user_accounts','userAcc_id','=','user_accounts.id')
        ->get();
       
        return view('transaction/index', compact('transactions'));
    }

    public function transactionSlip()
    { 
   $uid = Auth::id();
   $user = User::whereHas('roles', function($query) {$query->whereIn('roles.id',[6,3]);})->where('id', $uid)->with('userAcc')->first(); 
        
   $bankLists = bankList::select('id','bankName')->get();
   return view('transaction/transaction-slip', compact('user','bankLists'));
   }

   public function transactionStore(Request $request)
   { 
       $this->validate($request,[      
           'img_receipt' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',    
        ]);   
       
    //    $DepDifference = $request->amount;
    //    $Invno =  $request->invNo;
    //    $findInv = Invoice::where('id' , $Invno)->first();
    //    $totalPayable = $findInv->total_amount;
    //    $pay=$totalPayable-$DepDifference;
    // echo "<pre>";
    // print_r($pay);
    // exit;

       if($request->has('paymentMethod'))
   {
       $transaction = new UserTransaction();
       $PM = $request->paymentMethod;

       $transaction->paymentMethod = $PM;
       
       if($PM == "atmTransfer" || $PM == "cardForCheckout" )
       {
       $transaction->bank_name = $request->bankName;
       $transaction->depositorName = $request->accTitle;
       $transaction->cardLastDigits = $request->cardDigit;
       $transaction->acc_No = $request->accNo;
       }
       else if($PM == "internetBanking")
       {
       $transaction->bank_name = $request->bankName;
       $transaction->depositorName = $request->accTitle;
       $transaction->acc_No = $request->accNo;
       } 
       else if($PM =="directDeposit")
       {
       $transaction->bank_name = $request->bankName;
       $transaction->depositorName = $request->accTitle;
       $transaction->branchName = $request->branchName;
       } 
       else if($PM == "easyPaisaTransfer" || $PM == "jazzCashTransfer" || $PM == "uPaisa" )
       {
       $transaction->transactionId = $request->transactionId;
       $transaction->senderCell = $request->senderCell;
       $transaction->depositorCNIC = $request->senderCNIC;
       } 
       else if($PM == "cashAtOffice")
       {
       $transaction->depositorName = $request->depositedBy;
       $transaction->depositorCNIC = $request->depositorCNIC;
       $transaction->receiverName = $request->receivedBy;
       $transaction->receiverCNIC = $request->receiverCNIC; 
       } 

       $transaction->userAcc_id = $request->userAccNo;
       $transaction->user_id = $request->user;
       $transaction->amountPaid = $request->amount;
       $transaction->timeOfDeposit = $request->transactionTime;

       $imageName = time().'.'.$request->img_receipt->extension();    
       $request->img_receipt->move(public_path('receipt_img'), $imageName);
       $transaction->receiptPics = $imageName;
   
    //    echo "<pre>";
    //    print_r($transaction);
    //    exit;
      
       $transaction->save();
       return redirect('my/transactions');
    
   }     

  return "ERR";
  }




public function verifyTransaction(Request $request , $tr_no)
{
    $finduser = UserTransaction::where('id' , $tr_no)->first();
    $user = $finduser->user_id;
    $amt = $finduser->amountPaid;

    $findAcc = UserAccount::where('user_id', $user )->first();
    $userBalance = $findAcc->balance; 

    $newBal=$userBalance+$amt;

    // echo "<pre>";
    // print_r($user);
    // exit;

    switch ($request->input('action'))
    {
        case '1':
            DB::update("UPDATE user_accounts SET balance = $newBal  WHERE user_id	 = '$user'");
            DB::update("UPDATE user_transactions SET `status` = 'verified'  WHERE id = '$tr_no'");

       
    
            
    // $findInvoices= Invoice::where('buyer_id', $user)->where('Remains', '>', 0)->get();
    
    // $findBalance = UserAccount::where('user_id', $user)->first();
    // $userNewBalance = $findBalance->balance; 
    

    // foreach($findInvoices as $invoices)
    // {
    //    $getremains=$invoices->Remains;

    // while($userNewBalance > 0)
    // {        
    //     $remaining = $getremains-$userNewBalance; //$remaining hold remaing invoice balance after -ve from new
    // if($remaining >= 0)
    // {

    // }

    // }
  
    
    // }
    // echo "<pre>";
    // print_r($getremains);
    // exit;

        break;

        case '2':
            DB::update("UPDATE user_transactions SET `status` = 'verification failed'  WHERE id	 = '$tr_no'");    
        break;
    }
        $vid = Auth::id();
        DB::update("UPDATE user_transactions SET `verifiedBy` = '$vid'  WHERE   id = '$tr_no'");            
      
        return redirect('transaction/List');
}


public function userTransaction()
{
    $uid = Auth::id();
    // $transactions = UserTransaction::where('user_id' , $uid)->with('transactionBy','transactionBelongsTo')->get();
    
    $transactions=DB::table('user_transactions')
    ->select('userAccount','name','user_transactions.id','paymentMethod','bank_name','branchName','depositorName','acc_No','cardLastDigits','transactionId','senderCell','timeOfDeposit','amountPaid','receiptPics','verifiedBy','depositorCNIC','receiverName','receiverCNIC','status')
    ->where('user_transactions.user_id', $uid)
    ->join('users','user_id','=','users.id')
    ->join('user_accounts','userAcc_id','=','user_accounts.id')
    ->get();
    
    // echo "<pre>";
    // print_r($transactions);
    // exit;
    return view('transaction/index', compact('transactions'));
}

}
