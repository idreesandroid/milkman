@extends('layouts.master')
@section('content')
 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>Invoice</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/DashBoard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Detail</li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->
<!-- Page Wrapper -->
<div class="row">
   <div class="col-lg-12">
      <div class="card">
      
     
<div class="card-body">
          
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
                                 <th style="color:black;"><b> {{timeFormat($invoice->created_at)['time']}}<br>{{timeFormat($invoice->created_at)['date']}}</b></th>
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
                                 <td>{{number_format($cart->product_rate)}} Rs</td>
                                 <td>{{$cart->product_quantity}}</td>
                                 <td>{{number_format($cart->sub_total)}} Rs</td>
                                 <td>{{timeFormat($cart->delivery_due_date)['date']}}</td>
                                        
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
               </div>
            </div>   
      <!-- form start here           -->
  <!-- <before radio >--> 
        


@endsection