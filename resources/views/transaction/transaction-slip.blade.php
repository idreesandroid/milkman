@extends('layouts.master')
@section('content')
 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>MilkMan Dashboard</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/">Transaction</a></li>
                  <li class="breadcrumb-item active">Slip</li>
               </ul>
            </div>
         </div>
        <!-- /Page Header -->

<!-- Page Wrapper -->
<div class="row">
   <div class="col-lg-12">
      <div class="card">
      @if(isset($user->userAcc->userAccount))
<div class="card-body">             
<!-- table start here           -->
<div class="container mb-4">
               <div class="row">
                  <div class="col-12">
                     <div class="table-responsive">
                        <table class="table table-striped" id="tbl_bat_sel">
                           <thead>
                              <tr>
                                 <th>Account Number:</th>
                                 <th style="color:black;"><b>{{$user->userAcc->userAccount}}</b></th>
                                 <th>Name:</th>
                                 <th style="color:black;"><b>{{$user->name}}</b></th>
                                 <th>Balance:</th>
                                 <th style="color:black;"><b>{{$user->userAcc->balance}}</b></th>
                                 <th></th>
                              </tr>
                           </thead>
                          
                        </table>
                     </div>
                  </div>
               </div>
            </div> 
<!-- table end here           -->

      <!-- form start here           -->
 
<form method="post" id="transactionForm" action="{{ route('transaction.store') }}" enctype="multipart/form-data">
               @csrf 
<!-- radio start here           -->  

<input type="hidden"  name="userAccNo"  value="{{$user->userAcc->id}}" >
<input type="hidden"  name="user" value="{{$user->id}}">

<div class="col-md-12" >
   <ul class="inline-check">
<li>
<label >
   <input type="radio" name="paymentMethod" id="atmTransfer" value="atmTransfer" required onClick="paymentMethodes1()" >
   ATM Transfer</label>
</li>
<li>
<label >
   <input type="radio" name="paymentMethod" id="internetBanking" value="internetBanking" onClick="paymentMethodes1()" >
   Internet Banking</label>
</li>
<li>
<label >
   <input type="radio" name="paymentMethod" id="directDeposit" value="directDeposit" onClick="paymentMethodes1()" >
   Direct Deposit</label>
</li>
<li>
<label >
   <input type="radio" name="paymentMethod" id="cardForCheckout" value="cardForCheckout" onClick="paymentMethodes1()" >
  Swipe Card</label>
</li>
<li>
<label >
   <input type="radio" name="paymentMethod" id="easyPaisaTransfer" value="easyPaisaTransfer"  onClick="paymentMethodes1()">
   Easy Paisa</label>
</li>
<li>
<label >
   <input type="radio" name="paymentMethod" id="jazzCashTransfer" value="jazzCashTransfer" onClick="paymentMethodes1()" >
   Jazz Cash</label>
</li>
<li>
<label >
   <input type="radio" name="paymentMethod" id="uPaisa" value="uPaisa" onClick="paymentMethodes1()" >
   UPaisa</label>
</li>
<li>
<label >
<input type="radio" name="paymentMethod" id="cashAtOffice" value="cashAtOffice"  onClick="paymentMethod()">
Cash</label>
</li>
</ul>
</div>
<!-- radio end here-------------->
<div class="col-md-12" style="float: left;">
 <div class="col-md-6">
      <div  id="bankdepo" style="display:none">
         <div class="form-group">
            <label for="bankName">Bank Name:</label>
               <select class="form-control" name="bankName" id="bankName" autocomplete="off" >
                  <option value="">--Select Bank--</option>
                  @foreach ($bankLists as $bankList)
                  <option value="{{$bankList->bankName}}">{{ $bankList->bankName}}</option>
                  @endforeach                            
            </select>    
         </div>

         <div class="form-group">
            <label id="L_branchName">Branch Name:</label> 
            <input type="text"   class="form-control" name="branchName" id="branchName"  autocomplete="off" >
        </div>

         <div class="form-group">
            <label id="L_accTitle">Name:</label>  
            <input type="text"   class="form-control" name="accTitle"  id="accTitle"  autocomplete="off" >
         </div>
         <div class="form-group">
            <label id="L_accNo">Account No:</label>  
            <input type="text"   class="form-control" name="accNo"  id="accNo"  autocomplete="off" >
         </div>

         <div class="form-group">
            <label id="L_cardDigit">Last 4 digit of Card:</label> 
            <input type="text"   class="form-control" name="cardDigit" id="cardDigit" maxlength="4"  pattern="\d{4}"  autocomplete="off" >
         </div>
      </div>
</div>
            
<div class="col-md-6" style="float: left;">
      <div  id="microbank" style="display:none">
         <div class="form-group">
            <label>Transaction ID:</label>  
            <input type="text"  class="form-control" name="transactionId" id="transactionId"  autocomplete="off" >      
         </div>
         <div class="form-group">
            <label>Sender Cell:</label> 
            <input type="text"  class="form-control" name="senderCell" id="senderCell"  autocomplete="off" >     
         </div>
         <div class="form-group">
            <label>Sender CNIC:</label> 
            <input type="text"  class="form-control" name="senderCNIC" id="senderCNIC"  autocomplete="off" >
                  
         </div>
      </div>
</div>


<div class="col-md-6" style="float: left;">
   <div  id="cash" style="display:none">
      <div class="form-group">
         <label>Depositor's CNIC:</label> 
         <input type="text"  class="form-control" name="depositorCNIC"  id="depositorCNIC"   autocomplete="off" >
      </div>

      <div class="form-group">
         <label>Deposited By :</label> 
         <input type="text"  class="form-control" name="depositedBy"  id="depositedBy"   autocomplete="off" >
      </div>

      <div class="form-group">
         <label>Receivers CNIC:</label>
         <input type="text"  class="form-control" name="receiverCNIC"  id="receiverCNIC"   autocomplete="off" >
      </div>

      <div class="form-group">
         <label>Received By :</label> 
         <input type="text"  class="form-control" name="receivedBy"  id="receivedBy"    autocomplete="off" >       
      </div>
   </div>
</div>
</div>
<div class="col-md-6" style="float: left;">
      <label>Transaction Time</label> 
      <input type="datetime-local" class="form-control" name="transactionTime"  id="transactionTime" required  autocomplete="off" >

      <label>Amount</label> 
      <input type="number"  class="form-control" name="amount" min="1" id="amount" required autocomplete="off" >

      
      <label>Receipt Image</label>
         <input type="file" class="form-control" name="img_receipt"  required  autocomplete="off" >
</div>
                  
<div class="col mb-2" style="float: left;">
   <div class="row">
      <div class="col-sm-12  col-md-4">
         <button class="btn btn-block btn-primary text-uppercase" type="submit" id="checkout_btn" >Pay</button>
      </div>
   </div>
</div>
</form>
         <!-- form end here ----------->   

      </div>
      @elseif(!isset($user->userAcc->userAccount))
      <h1>You are not authorized for user Account</h1>
      @endif
      </div>
   </div>
</div>


<!-- /page Wrapper -->
<style>
ul.inline-check {
    padding-left: 0;
}
ul.inline-check li{list-style-type:none; display:inline-block;
float:left; min-width:25%;
}
ul.inline-check li input, ul.inline-check li label {
    cursor: pointer;
}

</style>
<script>
//   window.paymentMethod = 
  function paymentMethodes1()
   {
      if ($('#atmTransfer').is(":checked")||$('#cardForCheckout').is(":checked")) 
       {
         $('#bankdepo').show(); 
         $('#cash').hide();
         $('#microbank').hide();
         
          $('#bankName').show();   
          $("#bankName").attr("required", true);

          $('#accTitle').show();   
          $("#accTitle").attr("required", true);

          $('#L_accNo').show();
          $('#accNo').show();   
          $("#accNo").attr("required", true);

          $('#L_cardDigit').show();
          $('#cardDigit').show();   
          $("#cardDigit").attr("required", true);
         
          $('#branchName').hide();
          $('#L_branchName').hide();

          
       } 
      else if($('#internetBanking').is(":checked"))
        {
         $('#bankdepo').show(); 
         $('#cash').hide();
         $('#microbank').hide();

         $('#bankName').show();   
          $("#bankName").attr("required", true);
         
          $('#accTitle').show();   
          $("#accTitle").attr("required", true);
         
          $('#L_accNo').show();
          $('#accNo').show();   
          $("#accNo").attr("required", true);

          $('#branchName').hide();
          $('#L_branchName').hide();

          $('#cardDigit').hide();
          $('#L_cardDigit').hide();
      
        }  

        else if($('#directDeposit').is(":checked"))
        {

         $('#bankdepo').show(); 
         $('#cash').hide();
         $('#microbank').hide();

          $('#bankName').show();   
          $("#bankName").attr("required", true);
         
         
          $('#accTitle').show();   
          $("#accTitle").attr("required", true);
         
          $('#L_branchName').show();
          $('#branchName').show();   
          $("#branchName").attr("required", true);
          
          $('#accNo').hide();
          $('#L_accNo').hide();
      

          $('#cardDigit').hide();
          $('#L_cardDigit').hide(); 
      
        } 
 
        else if($('#jazzCashTransfer').is(":checked")||$('#easyPaisaTransfer').is(":checked")||$('#uPaisa').is(":checked"))
        {
         $('#microbank').show(); 
         $('#cash').hide();
         $('#bankdepo').hide();

          $("#transactionId").attr("required", true);           
          $("#senderCell").attr("required", true);  
          $("#senderCNIC").attr("required", true);
          
         
        } 

        else if ($('#cashAtOffice').is(":checked"))
        {
         $('#cash').show();
         $('#microbank').hide();
         $('#bankdepo').hide();

          $("#depositorCNIC").attr("required", true);
          $("#depositedBy").attr("required", true);
          $("#receiverCNIC").attr("required", true); 
          $("#receivedBy").attr("required", true);
         
         
        }  

        
   }

</script>

<script>
    $(document).ready(function () {
    $('#transactionForm').validate({ // initialize the plugin
        rules: {
         accTitle: {
            lettersonly: true
            },
         cardDigit: {
            integer: true,
            },
        }
    });
});
</script>

@endsection