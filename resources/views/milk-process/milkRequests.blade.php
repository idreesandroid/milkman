@extends('layouts.master')
@section('content')
 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>Milk Bank</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/DashBoard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Milk Request List</li>
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
 
                        <th>Milk Bank Name</th>
                        <th>Milk Request Code</th>
                        <th>Milk Quantity</th>
                        <th>Request Status</th>
                        <th>Requested By</th>
                        <th>Granted By</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($milkRequests as $milkRequest)
                     <tr>
                        <td>{{$milkRequest->bankName}}</td>
                        <td>{{$milkRequest->alotment_code}}</td>
                        <td>{{$milkRequest->milkQuantity}}</td>      
                        <td>{{$milkRequest->milkRequestStatus}}</td>
                        <td>{{$milkRequest->processManager}}</td>
                        <td>{{$milkRequest->bankMangerName}}</td>
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



