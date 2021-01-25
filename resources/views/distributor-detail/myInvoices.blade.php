

@extends('layouts.master')
@section('content')
 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>Invoices</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/DashBoard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Invoice List</li>
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
                     <th>Serial No</th>
                        <th>Invoice Number</th>
                        <th>status</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Detail</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($invoices as $index => $invoice)
                     <tr>
                     <td>{{$index+1}}</td>
                        <td>{{$invoice->invoice_number}}</td>
                        <td>{{$invoice->flag}}</td>
                        <td>{{$invoice->total_amount}}</td>
                        <td>{{timeFormat($invoice->created_at)['date']}}</td>
                        <td><a href="{{ route('invoice.Detail', $invoice->id)}}" class="btn btn-primary">Detail</a></td>
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

