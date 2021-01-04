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
     
     
      <div class="col-md-4">
      <ul class="inbound-block">
      <li> <div >
         <input type="radio" name="paymentMethod" value="atmTransfer"  >
         <label>ATM Transfer</label>
      </div></li>

      <li> <div >
         <input type="radio" name="paymentMethod" value="internetBanking"  >
         <label>Internet Banking</label>
      </div></li>

      <li> <div >
         <input type="radio" name="paymentMethod" value="directDeposit"  >
         <label>Direct Deposit</label>
      </div></li>

      <li> <div >
         <input type="radio" name="paymentMethod" value="cardForCheckout"  >
         <label>Swipe Card</label>
      </div></li>
      </ul>
         <div class="form-group">
            <label>Bank Name:</label>  ___________________________
         </div>
         <div class="form-group">
            <label>Branch Name:</label>  __________________________
         </div>
         <div class="form-group">
            <label>Account Title:</label>  _________________________
         </div>

         <div class="form-group">


            <label>Last 4 digit of Card:</label>  ____________________
         </div>
      </div>
            
      <div class="col-md-4">
      <ul class="inbound-block">
      <li> <div >
         <input type="radio" name="paymentMethod" value="easyPaisaTransfer"  >
         <label>Easy Paisa</label>
      </div></li>

      <li> <div >
         <input type="radio" name="paymentMethod" value="jazzCashTransfer"  >
         <label>Jazz Cash</label>
      </div></li>

      <li> <div >
         <input type="radio" name="paymentMethod" value="uPaisa"  >
         <label>UPaisa</label>
      </div></li>
<br></br>
      
      </ul>
         <div class="form-group">
            <label>Transaction ID:</label>  _______________________
         </div>
         <div class="form-group">
            <label>Sender Cell:</label>  __________________________
         </div>
         <div class="form-group">
            <label>Sender CNIC:</label>  __________________________
         </div>
      </div>
            
      <div class="col-md-4">
      <ul class="inbound-block">
      <li> <div >
         <input type="radio" name="paymentMethod" value="cashAtOffice"  >
         <label>Cash</label>
      </div></li>
      <br></br><br></br>
      
      </ul>
         <div class="form-group">
            <label>Depositor's CNIC:</label>  ___________________________
         </div>
         <div class="form-group">
            <label>Deposited By :</label>  _______________________
         </div>
         <div class="form-group">
            <label>Receivers CNIC:</label>  ___________________________
         </div>
         <div class="form-group">
            <label>Received By :</label>  _______________________
         </div>
         
      </div>
      <!-- form end here           -->
                  <div class="col mb-2">
                     <div class="row">
                        <div class="col-sm-12  col-md-4">
                           <button class="btn btn-block btn-primary text-uppercase" type="button" id="checkout_btn" >Print</button>
                        </div>
                     </div>
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
@endsection