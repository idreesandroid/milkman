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
            $table->foreign('distributor_id')->references('id')->on('users');
            
            
            
            $table->enum('paymentMethod',['atmTransfer','cardForCheckout','cashAtOffice','directDeposit','internetBanking','easyPaisaTransfer','jazzCashTransfer','uPaisa']);
           
            $table->string('bank_name')->nullable()->default("null");
            $table->string('branchName')->nullable()->default("Nill");
            $table->string('depositorName')->nullable()->default("Nill");
            $table->string('acc_No')->nullable()->default("Nill");
            $table->string('cardLastDigits')->nullable()->default("Nill");
            

            $table->string('transactionId')->nullable()->default("Nill");
            $table->string('senderCNIC')->nullable()->default("Nill");
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
        Schema::dropIfExists('distributor_payments');
    }
}
