@extends('layouts.master')
@section('content')
 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>Collection Point</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/DashBoard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Points List</li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->
<!-- Page Wrapper -->
<div class="row">
   <div class="col-sm-12">
      <div class="card mb-0">
         <div class="card-body">
            @can('Create-Product')
            <div class="form-group mb-0 row">
               <div class="col-md-4">
                  <div class="input-group-append">
                     <a href="/collectionPoint/create" class="active"> <button class="btn btn-primary" type="button">Add Collection Point</button></a>
                  </div>
               </div>
            </div>
            @endcan
            
            <div class="table-responsive">
               <table class="datatable table table-stripped mb-0 datatables">
                  <thead>
                     <tr>
 
                        <th>Name</th>
                        <th>Address</th>
                        <th>Collection Manager</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($collectionPoints as $collectionPoint)
                     <tr>
                        
                        <td>{{$collectionPoint->pointName}}</td>
                        <td>{{$collectionPoint->pointAddress}}</td>
                        <td >
                        @if(!isset($collectionPoint->collectionPointId))<button type="button" id="point_{{$collectionPoint->id}}" onclick="getCId({{$collectionPoint->id}})" class="btn btn-primary" data-toggle="modal" data-target="#findManager">Assign</button> @endif
                        </td>

                        <td>
                           <a href="{{ route('edit.collectionPoint', $collectionPoint->id)}}" class="btn btn-primary">Edit</a>
                           <form action="{{ route('delete.collectionPoint', $collectionPoint->id)}}" method="post" style="display: inline-block">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                           </form>
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
<div id="findManager" class="modal fade" role="dialog">
               <div class="modal-dialog" id="batch-info">
                  <!-- Modal content-->
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <div class="modal-body">
                           <form method="post" action="{{ route('assignManager.Point') }}">
                           @csrf
                              <div class="form-group row">
                                 <label for="manager_id" class="col-form-label col-md-2">Manager Name</label>
                                    <div class="col-md-6">
                                       <select class="form-control" name="manager_id"  id="manager_id">                           
                                       </select>
                                    </div>
                              </div>

                              <input type="hidden" id="pId" name="pId" value="">

                              <button type="submit" name="action" class=" btn btn-lg btn-info " >Select</button>
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
   function getCId(id)
      {
      pointId =id;
      $("#pId").val(id);
      $.ajax({
         url: '/get/collection-managers',
         type: "GET",
         success:function(data) { 
            //console.log(data);
                              $("#manager_id").empty();
                              $.each(data, function(key, value){
                              $("#manager_id").append("<option value='"+value.user_id +"'>"+value.name+"</option>");
                                                               }                              
                                    )
                                 }                                           
            });   
      }

      
</script>
