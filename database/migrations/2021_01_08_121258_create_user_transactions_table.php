<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_transactions', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->integer('userAcc_id')->unsigned();
            $table->foreign('userAcc_id')->references('id')->on('user_accounts')->onUpdate('cascade')->onDelete('cascade');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            
            
            
            $table->enum('paymentMethod',['atmTransfer','cardForCheckout','cashAtOffice','directDeposit','internetBanking','easyPaisaTransfer','jazzCashTransfer','uPaisa']);
           
            $table->string('bank_name')->nullable()->default("null");
            $table->string('branchName')->nullable()->default("Nill");
            $table->string('depositorName')->nullable()->default("Nill");
            $table->string('acc_No')->nullable()->default("Nill");
            $table->string('cardLastDigits')->nullable()->default("Nill");
            

            $table->string('transactionId')->nullable()->default("Nill");
            $table->string('senderCell')->nullable()->default("Nill");
            
            $table->dateTimeTz('timeOfDeposit');
            $table->integer('amountPaid');
            $table->string('receiptPics');
            $table->integer('verifiedBy')->default(0);

            $table->string('depositorCNIC')->nullable()->default("Nill");
            $table->string('receiverName')->nullable()->default("Nill");
            $table->string('receiverCNIC')->nullable()->default("Nill");
            

            $table->enum('status',['verified','Not verified','verification failed'])->default("Not verified");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_transactions');
    }
}
