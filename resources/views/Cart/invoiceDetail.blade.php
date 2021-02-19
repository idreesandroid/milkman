

@extends('layouts.master')
@section('content')
<!-- Page Header -->
<div class="crms-title row bg-white mb-4">
   <div class="col">
      <h3 class="page-title">
         <span class="page-title-icon bg-gradient-primary text-white mr-2">
         <i class="la la-table"></i>
         </span> <span>Order Detail</span>
      </h3>
   </div>
   <div class="col text-right">
      <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
         <li class="breadcrumb-item"><a href="/DashBoard">Dashboard</a></li>
         <li class="breadcrumb-item active">Order Detail</li>
      </ul>
   </div>
</div>
<!-- /Page Header -->
<!-- Page Wrapper -->
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card due-dates">
   <div class="card-body">
      <div class="row">
         <div class="col">
            <span>Name:</span>
            <p><b>{{$invoice->buyer->name}}</b></p>
         </div>
         <div class="col">
            <span>Invoice Number:</span>
            <p><b>{{$invoice->invoice_number}}</b></p>
         </div>
         <div class="col">
            <span>Invoice Date & Time:</span>
            <p><b>{{timeFormat($invoice->created_at)['date']}} {{timeFormat($invoice->created_at)['time']}}</b></p>
         </div>
         <div class="col">
            <span>Total Amount:</span>
            <p><b>{{number_format($invoice->total_amount,2)}}</b></p>
         </div>
         <div class="col">
            <span>Status</span>
            <p><b>{{$invoice->flag}}</b></p>
         </div>
      </div>
   </div>
</div>
<div class="card-body">
<div class="container mb-4">
   <div class="row">
      <div class="col-12">
         <div class="table-responsive">
            <table class="table table-striped" id="invoiceDetial">
               <thead>
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
                     <td>{{number_format($cart->product_rate,2)}} Rs</td>
                     <td>{{$cart->product_quantity}}</td>
                     <td>{{number_format($cart->sub_total,2)}} Rs</td>
                     <td>{{timeFormat($cart->delivery_due_date)['date']}}</td>
                  </tr>
                  @endforeach                  
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<!-- form start here           -->
<!-- <before radio >--> 
<script type="text/javascript">
   $(document).ready(function() {  
      $("#invoiceDetial").DataTable();
   });
</script>
@endsection

