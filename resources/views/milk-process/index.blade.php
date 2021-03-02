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
                        <td>@if($milkRequest->milkRequestStatus == 'Requested')
                        @can('Approve-Milk-Request')  <a href="{{ route('approve.request', $milkRequest->id)}}" class="btn btn-outline-success">Grant</a>@endcan
                        @can('Reject-Milk-Request')  <button type="button" id="request_{{$milkRequest->id}}" onclick="getRid({{$milkRequest->id}})" class="btn btn-outline-danger" data-toggle="modal" data-target="#requestOperation"> Reject </button>  @endcan           
                           @endif
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

<!-- model -->
            <div id="requestOperation" class="modal fade" role="dialog">
               <div class="modal-dialog" id="find-asset">
                  <!-- Modal content-->
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <div class="modal-body">
                           <form method="post" action="{{ route('reject.request') }}">
                              @csrf 
                            <input type="hidden" id="pId" name="pId" value="">
                            <div class="form-group row">
                                 <label for="rejectionReason" class="col-form-label col-md-6">Reason Of Rejection</label>
                                 <div class="col-md-12">
                                    <input type="text" class="form-control" name="rejectionReason" required="" autocomplete="off"></input>
                                 </div>
                              </div>

                              <button type="submit" class="btn btn-outline-danger" >Reject</button>
                           </form>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>
<!-- model -->



<!-- /Page Wrapper -->




@endsection
<script type="text/javascript">

var pointId ='';
   function getRid(id)
      {
     // alert("helo");
      pointId =id;
      $("#pId").val(id);
      } 
</script>


