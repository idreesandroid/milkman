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
                        <th>Assets</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($collectionPoints as $collectionPoint)
                     <tr>
                        
                        <td>{{$collectionPoint->pointName}}</td>
                        <td>{{$collectionPoint->pointAddress}}</td>
                        <td>@if(!isset($collectionPoint->collectionPointId))<button type="button" id="point_{{$collectionPoint->id}}" onclick="getCId({{$collectionPoint->id}})" class="btn btn-primary" data-toggle="modal" data-target="#findManager">Assign</button>@endif</td>
                        <td><button type="button" id="asset_{{$collectionPoint->id}}" onclick="getAssetId({{$collectionPoint->id}})" class="btn btn-primary" data-toggle="modal" data-target="#findAsset">Allot Asset</button></td>
                       
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


<!-- model -->
<div id="findAsset" class="modal fade" role="dialog">
               <div class="modal-dialog" id="find-asset">
                  <!-- Modal content-->
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <div class="modal-body">
                        <div class="table-responsive">
                           <form method="post" action="{{ route('setAssetList') }}">
                              @csrf 
                              <input type="hidden" id="pointId" name="pointId" value="">
                              <table class="datatable table table-stripped mb-0 asset_fetch" id="asset_fetch">
                                 <thead>
                                    <tr>
                                       <th><input type="checkBox" ></th>
                                       <th>Asset Type</th>
                                       <th >Asset Name</th>
                                       <th>Asset Capacity</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                              </table>
                              <button type="submit" class=" form-control btn btn-sm- btn-info" >Add</button>
                           </form>
                        </div>
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


<script type="text/javascript">
   function getAssetId(id)
      {
      pointId =id;
      
      $("#pointId").val(id);
      $.ajax({
         url: '/get/asset-list/'+id,
         type: "GET",
         success:function(response) { 

            console.log(response);

                                    var len = 0;
                                    $('#asset_fetch tbody').empty();     
                                    if(response.length > 0){
                                    len = response.length;
                                    for(var i=0; i<len; i++){
                                                          var asset_Id = response[i].id;
                                                          var asset_Type = response[i].typeName;                
                                                          var asset_Name = response[i].assetName;
                                                          var asset_Cap = response[i].assetCapacity;  
                                                          var asset_Unit = response[i].assetUnit;
                                                          var asset_point = response[i].assignedPoint;
   
                                                          var tr_str = "<tr>" +
                                                          "<td >"+"<input type='checkbox' class='form-control' value='"+asset_Id+"' name='select_asset[]' id='select_asset_"+asset_Id+"'/>"+" </td>"+
                                                         "<td>" + asset_Type + "</td>" +
                                                         "<td >" + asset_Name + "</td>" +    
                                                         "<td >" + asset_Cap +" "+ asset_Unit + "</td>" +                                                                         
                                                         "</tr>";
                                                         $("#asset_fetch tbody").append(tr_str);
                                                       
                                                         if(asset_point != null)
                                                         {
                                                            $("#select_asset_"+asset_Id).attr("checked", true);
                                                         }
                                                            }
                                                          }
                                                          else
                                                             {
                                                                var tr_str = "<tr>" +
                                                                "<td align='center' colspan='4'>No record found.</td>" +
                                                                "</tr>";
                                                                $("#asset_fetch tbody").append(tr_str);
                                                            }
                                 }                                           
            });   
      }

      
</script>
