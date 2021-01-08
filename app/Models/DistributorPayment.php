<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistributorPayment extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_no','distributor_id','paymentMethod','bank_name','branchName','depositorName','acc_No','cardLastDigits','transactionId','senderCNIC','senderCell','timeOfDeposit','amountPaid','receiptPics','status','depositorCNIC','receiverName','receiverCNIC'];    
  
    public function DistributorID()
    {
        return $this->belongsTo(User::class);
    }
}
