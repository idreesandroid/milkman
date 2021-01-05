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
                  <li class="breadcrumb-item"><a href="/">Payment</a></li>
                  <li class="breadcrumb-item active">Receipt</li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->
<!-- Page Wrapper -->
<div class="row">
   <div class="col-lg-12">
      <div class="card">
      
     
         <div class="card-body">
            <!-- <form method="post">
               @csrf -->
            <div class="container mb-4">
               <div class="row">
                  <div class="col-12">
                     <div class="table-responsive">
                        <table class="table table-striped" id="tbl_bat_sel">
                           <thead>
                              <tr>
                                 <th>Invoice Number:</th>
                                 <th style="color:black;"><b>{{$invoice->invoice_number}}</b></th>
                                 <th>Name:</th>
                                 <th style="color:black;"><b>{{$invoice->buyer->name}}</b></th>
                                 <th>Invoice Date:</th>
                                 <th style="color:black;"><b>{{$invoice->buyer->created_at}}</b></th>
                                 <th></th>
                              </tr>
                              <tr>
                                 <th scope="col">Serial No</th>
                                 <th scope="col">Product</th>
                                 <th scope="col" >Price</th>
                                 <th scope="col" >Quantity</th>
                                 <th scope="col" >Sub Total</th>
                                 <th scope="col" >Delivery Date</th>
                               
                              </tr>
                           </thead>
                           <tbody>
                             
                              @foreach($carts as $index => $cart)
                              <tr>
                                 <td>{{$index+1}}</td>
                                 <td>{{$cart->product->product_name}}</td>
                                 <td>{{$cart->product_rate}}</td>
                                 <td>{{$cart->product_quantity}}</td>
                                 <td>{{$cart->sub_total}}</td>
                                 <td>{{$cart->delivery_due_date}}</td>
                                        
                              </tr>
                              @endforeach 
                              <tr>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td style="color:black;"><strong>Total</strong></td>
                                 <td style="color:black;"><strong>{{$invoice->total_amount}}</strong></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
      <!-- form start here           -->
  <!-- <before radio >--> 

          
  <!-- radio start here           --> 


      <div class="col-md-4">
      <ul class="inbound-block">
      <li> <div >
         <input type="radio" name="paymentMethod" id="atmTransfer" value="atmTransfer" onClick="paymentMethod()" >
         <label >ATM Transfer</label>
      </div></li>

      <li> <div >
         <input type="radio" name="paymentMethod" id="internetBanking" value="internetBanking" onClick="paymentMethod()" >
         <label >Internet Banking</label>
      </div></li>

      <li> <div >
         <input type="radio" name="paymentMethod" id="directDeposit" value="directDeposit" onClick="paymentMethod()" >
         <label>Direct Deposit</label>
      </div></li>

      <li> <div >
         <input type="radio" name="paymentMethod" id="cardForCheckout" value="cardForCheckout" onClick="paymentMethod()" >
         <label>Swipe Card</label>
      </div></li>
      </ul>

      <div class="row" id="bankdepo" style="display:none">
         <div class="form-group">
            <label id="L_bankName">Bank Name:</label> 
            <input type="text"   class="form-control" name="bankName" id="bankName"  autocomplete="off" >        
         </div>
         <div class="form-group">
            <label id="L_branchName">Branch Name:</label> 
            <input type="text"   class="form-control" name="branchName" id="branchName"  autocomplete="off" >
                  
         </div>
         <div class="form-group">
            <label id="L_accTitle">Account Title:</label>  
            <input type="text"   class="form-control" name="accTitle"  id="accTitle"  autocomplete="off" >
                  
         </div>
         <div class="form-group">
            <label id="L_cardDigit">Last 4 digit of Card:</label> 
            <input type="text"   class="form-control" name="cardDigit" id="cardDigit"  autocomplete="off" >
                  
         </div>
         </div>
         </div>
            
      <div class="col-md-4">
     
     
      <ul class="inbound-block">
      <li> <div >
         <input type="radio" name="paymentMethod" id="easyPaisaTransfer" value="easyPaisaTransfer"  onClick="paymentMethod()">
         <label>Easy Paisa</label>
      </div></li>

      <li> <div >
         <input type="radio" name="paymentMethod" id="jazzCashTransfer" value="jazzCashTransfer" onClick="paymentMethod()" >
         <label>Jazz Cash</label>
      </div></li>

      <li> <div >
         <input type="radio" name="paymentMethod" id="uPaisa" value="uPaisa" onClick="paymentMethod()" >
         <label>UPaisa</label>
      </div></li>
<br></br>
      
      </ul>
      <div class="row" id="microbank" style="display:none">
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
            
   <div class="col-md-4">
      <ul class="inbound-block">
      <li> <div >
         <input type="radio" name="paymentMethod" id="cashAtOffice" value="cashAtOffice"  onClick="paymentMethod()">
         <label>Cash</label>
      </div></li>
      <br></br><br></br>
      
      </ul>
      <div class="row" id="cash" style="display:none">
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
      <div class="col-md-6">
            <label>Transaction Time</label> 
            <input type="datetime-local" class="form-control" name="transactionTime"  id="transactionTime"   autocomplete="off" >
     
            <label>Amount</label> 
            <input type="number"  class="form-control" name="amount" min="1" id="amount" autocomplete="off" >
     
            <div class="form-group">
                  <label>Receipt Image</label>
                  <input type="file" class="form-control" name="filenames"    autocomplete="off" >
               </div>

      </div>
      <!-- form end here           -->




                  
               
               </div> 
            </div>
           
            <div class="col mb-2">
                     <div class="row">
                        <div class="col-sm-12  col-md-4">
                           <button class="btn btn-block btn-primary text-uppercase" type="button" id="checkout_btn" >Pay</button>
                        </div>
                     </div>
                  </div>
      <style>
      .inbound-block{list-style-type:none; padding-left:0;}
      .inbound-block li{ padding-left:0;}
      </style>


      </div>
   </div>
</div>
<!-- /page Wrapper -->

<script>
  function paymentMethod()
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

@endsection