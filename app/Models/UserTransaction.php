<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTransaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    protected $fillable = ['userAcc_id','distributor_id','paymentMethod','bank_name','branchName','depositorName','acc_No','cardLastDigits','transactionId','senderCell','timeOfDeposit','amountPaid','receiptPics','status','depositorCNIC','receiverName','receiverCNIC'];    
  

    public function transactionBelongsTo()
    {
        return $this->hasOne(UserAccount::class,'id','userAcc_id');
    }

   
    public function transactionBy()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
