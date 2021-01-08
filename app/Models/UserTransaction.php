<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTransaction extends Model
{
    use HasFactory;
    protected $fillable = ['userAcc_id','distributor_id','paymentMethod','bank_name','branchName','depositorName','acc_No','cardLastDigits','transactionId','senderCell','timeOfDeposit','amountPaid','receiptPics','status','depositorCNIC','receiverName','receiverCNIC'];    
  

    public function transactionBelongsTo()
    {
        return $this->belongsTo(UserAccount::class);
    }

   
    public function transactionBy()
    {
        return $this->belongsTo(User::class);
    }
}
