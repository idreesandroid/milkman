<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistributorPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distributor_payments', function (Blueprint $table) {
            $table->increments('id')->unsigned();

            $table->integer('invoice_no')->unsigned();
            $table->foreign('invoice_no')->references('id')->on('invoices');

            $table->integer('distributor_id')->unsigned();
            $table->foreign('distributor_id')->references('id')->on('invoices');
            
            
            
            $table->enum('paymentMethod',['atmTransfer','cardForCheckout','cashAtOffice','directDeposit','internetBanking','easyPaisaTransfer','jazzCashTransfer','uPaisa']);
           
            $table->integer('bank_id')->unsigned();
            $table->string('branchName');
            $table->string('depositorName');
            $table->string('acc_No');
            $table->string('cardLastDigits');
            

            $table->string('transactionId');
            $table->string('senderCNIC');
            $table->string('senderCell');
            
            $table->dateTimeTz('timeOfDeposit');
            $table->integer('amountPaid');
            $table->string('receiptPics');

            $table->enum('status',['verified','Not verified']);

            $table->integer('verified_by')->unsigned();
            $table->foreign('verified_by')->references('id')->on('invoices');

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
        Schema::dropIfExists('distributor_payments');
    }
}
