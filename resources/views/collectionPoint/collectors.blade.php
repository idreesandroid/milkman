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
                  <li class="breadcrumb-item"><a href="/Dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Collector List</li>
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
                        <th>Image</th>
                        <th>Name</th>
                        <th>Morning</th>
                        <th>Evening</th>
                        <th>Capacity</th>
                        <th>Asset</th>
                        <th>Contact</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($collectorDetails as $collectorDetail)
                     <tr>
                        <td><img alt="" class="profile-img" src="{{asset('/UserProfile/'.$collectorDetail->filenames)}}"></td>
                        <td><a href="{{ route('profile.user', $collectorDetail->id)}}" title="View Profile" >{{$collectorDetail->name}}</a></td>
                        <td>{{$collectorDetail->collectorMorStatus}}</td>
                        <td>{{$collectorDetail->collectorEveStatus}}</td>
                        <td>{{$collectorDetail->collectorCapacity}}</td> 
                        <td>{{$collectorDetail->user_phone}}</td>
                        <td><button type="button" id="asset_{{$collectorDetail->user_id}}" onclick="getAssetId({{$collectorDetail->user_id}})" class="btn btn-primary" data-toggle="modal" data-target="#findAsset">Update Asset</button></td>  
                        <td>@if($collectorDetail->collectorMorStatus == 'Leave'||$collectorDetail->collectorEveStatus == 'Leave') <a href="{{ route('activate.collector', $collectorDetail->id)}}" class="btn btn-primary">Activate</a>@endif</td> 
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
                           <form method="post" action="{{ route('set.CollectorAsset') }}">
                              @csrf 
                              <input type="hidden" id="collectorId" name="collectorId" value="">
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


<script type="text/javascript">
   function getAssetId(id)
      {
      pointId =id;
      $("#collectorId").val(id);
      $.ajax({
         url: '/collection-point-get/asset-list/'+id,
         type: "GET",
         success:function(response) { 

            console.log(response);
                                    var len = 0;
                                    $('#asset_fetch tbody').empty();     
                                    if(response.length > 0){
                                    len = response.length;
                                    for(var i=0; i<len; i++){
                                                          var asset_Id   = response[i].id;
                                                          var asset_Type = response[i].typeName;                
                                                          var asset_Name = response[i].assetName;
                                                          var asset_Cap  = response[i].assetCapacity;  
                                                          var asset_Unit = response[i].assetUnit;
                                                          var uId        = response[i].user_id;
   
                                                          var tr_str = "<tr>" +
                                                          "<td >"+"<input type='checkbox' class='form-control' value='"+asset_Id+"' name='select_asset[]' id='select_asset_"+asset_Id+"'/>"+" </td>"+
                                                         "<td>" + asset_Type + "</td>" +
                                                         "<td >" + asset_Name + "</td>" +    
                                                         "<td >" + asset_Cap +" "+ asset_Unit + "</td>" +                                                                         
                                                         "</tr>";
                                                         $("#asset_fetch tbody").append(tr_str);

                                                         if(uId != null)
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
@endsection

