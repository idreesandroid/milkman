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
         <li class="breadcrumb-item active">Sale Invoices</li>
      </ul>
   </div>
</div>
<!-- /Page Header -->
<div class="page-header  mb-0 ">
   <div class="row">
      <div class="col">
         <h3>Invoice</h3>
      </div>
      
      <div class="col text-right">
         <ul class="list-inline-item pl-0">
            <li class="list-inline-item">
               @can('Generate-Invoice')
               <a  href="{{url('/cart/create')}}"class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded">New Invoice</a>
               @endcan
               <a  href="{{url('/cart/reserveInvoice')}}"class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded">Reserve Stock</a>
               <a  href="{{url('/cart/onHoldInvoice')}}"class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded">On Hold Invoice</a>
            </li>
         </ul>
      </div>
      
   </div>
</div>
<!-- Page Wrapper -->
<div class="row">
   <div class="col-sm-12">
      <div class="card mb-0">
         <div class="card-body">
            <div class="table-responsive">
               <table class="datatable table table-stripped mb-0 datatables" id="InvoiceListing">
                  <thead>
                     <tr>
                        <th>Buyer Name</th>
                        <th>Invoice No</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($invoices as $invoice)
                     <tr>
                        <td>{{$invoice->buyer->name}}</td>
                        <td>{{$invoice->invoice_number}}</td>
                        <td>{{number_format($invoice->total_amount)}} Rs</td>
                        <td>{{$invoice->flag}}</td>
                        <td>{{timeFormat($invoice->created_at)['date']}}</td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   $(document).ready( function () {
      $('#InvoiceListing').DataTable();
   });
</script>

<!-- /Page Wrapper -->
@endsection

