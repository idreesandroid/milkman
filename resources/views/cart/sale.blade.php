@extends('layouts.master')
@section('content')
 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
   <div class="col">
      <h3 class="page-title">
         <span class="page-title-icon bg-gradient-primary text-white mr-2">
         <i class="la la-table"></i>
         </span> <span>Sale</span>
      </h3>
   </div>
   <div class="col text-right">
      <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
         <li class="breadcrumb-item"><a href="/DashBoard">Dashboard</a></li>
         <li class="breadcrumb-item active">Write here?</li>
      </ul>
   </div>
</div>
<!-- /Page Header -->
<!-- Page Wrapper -->
<div class="row">
   <div class="col-sm-12">
      <div class="card mb-0">
         <div class="card-body">
            <div class="table-responsive">
               <table class="datatable table table-stripped mb-0 datatables">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Buyer Name</th>
                        <th>Invoice No</th>
                        <th>Product Name</th>
                        <th>Batch ID</th>
                        <th>Quantity</th>
                        <th>Product Rate</th>
                        <th>Sub Total</th>
                        <th>Seller Name</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($saleViews as $saleView)
                     <tr>
                        <td>{{$saleView->id}}</td>
                        <td>{{$saleView->buyer->name}}</td>
                        <td>{{$saleView->invoice_id}}</td>
                        <td>{{$saleView->product->product_name}}</td>
                        <td>{{$saleView->batch->batch_name}}</td>
                        <td>{{$saleView->product_quantity}}</td>
                        <td>{{$saleView->product->product_price}}</td>
                        <td>{{$saleView->sub_total}}</td>
                        <td>{{$saleView->buyer->name}}</td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- /Page Wrapper -->
@endsection

