

@extends('layouts.master')
@section('content')
 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>Orders List</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/DashBoard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Orders List</li>
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
               <table class="datatable table table-stripped mb-0 datatables" id="distributorInvoices">
                  <thead>
                     <tr>                     
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
                        <td>{{$invoice->invoice_number}}</td>
                        <td>{{$invoice->flag}}</td>
                        <td>{{number_format($invoice->total_amount,2)}}</td>
                        <td>{{timeFormat($invoice->created_at)['date']}}</td>
                        <td>
                           <a href="{{ route('invoice.Edit', base64_encode($invoice->id))}}" class="btn btn-outline-success">Edit</a>
                           <a href="{{ route('invoice.Detail', $invoice->id)}}" class="btn btn-outline-info">Detail</a>
                           <a href="#" onclick="deleteOrder(<?php echo $invoice->id; ?>);" class="btn btn-outline-danger">Delete</a>
                        </td>
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
<script type="text/javascript">
   function deleteOrder(invoiceID){
      swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this Order!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                jQuery.ajax({
                    url: "{{ route('destroy.order') }}",
                    type: "POST",
                    data: {
                        id: invoiceID,
                        '_token' : "{{ csrf_token() }}"
                    },
                    success: function () {
                        swal.fire("Done!", "It was succesfully deleted!", "success").then((result) => {
                           if(result.isConfirmed) {
                              location.reload(true);
                           }
                        });
                    },
                    error: function () {
                        swal.fire("Error deleting!", "Please try again", "error").then((result) => {
                           if(result.isConfirmed) {
                              location.reload(true);
                           }
                        });
                    }
                });
            }
        });
   }
   $(document).ready(function() {  
      $("#distributorInvoices").DataTable({
  "columns": [
    { "width": "20%" },
    { "width": "20%" },
    { "width": "15%" },
    { "width": "20%" },
    { "width": "25%" }
  ]
});
   });
</script>

@endsection

