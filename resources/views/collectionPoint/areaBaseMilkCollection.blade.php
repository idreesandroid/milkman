@extends('layouts.master')
@section('content')
 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>Milk Collection</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/DashBoard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Area Base Collection</li>
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
                        <th>Area</th>
                        <th>Collector</th>
                        <th>Collected Quantity</th>
                        <th>Date</th>
                        <th>Shift</th>
                        <th>Fat</th>
                        <th>Ash</th>
                        <th>Proteins</th>
                        <th>Lactose</th>
                        <th>Average Purity</th>
                        <th>Screen Shot</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($milkCollections as $milkCollection)
                     <tr>
                        <td>{{$milkCollection->title}}</td>
                        <td>{{$milkCollection->name}}</td>
                        <td>{{$milkCollection->milkCollected}}Ltr</td>
                        <td>{{timeFormat($milkCollection->created_at)['date']}}</td>
                        <td>{{$milkCollection->collectionShift}}</td>
                        <td>{{$milkCollection->averageFat}}</td>
                        <td>{{$milkCollection->averageAsh}}</td>
                        <td>{{$milkCollection->averageProteins}}</td>
                        <td>{{$milkCollection->averageLactose}}</td>
                        <td>{{$milkCollection->averageSolids}}</td>
                        <td><img class="avatar" src="{{asset('/milkQuality_img/'.$milkCollection->averageQuality_SS)}}"></td> 
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
               <div class="modal-dialog" id="find-asset">
                  <!-- Modal content-->
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <div class="modal-body">
                        <div class="table-responsive">
                           <form method="post" action="{{ route('assignManager.Point') }}">
                              @csrf 
                              <input type="hidden" id="pId" name="pId" value="">
                              <table class="datatable table table-stripped mb-0 find_manager" id="find_manager">
                                 <thead>
                                    <tr>
                                       <th>Select Any</th>
                                       <th>Name</th>
                                       <th >Collection Point</th>
                                       <th>Manager Phone</th>
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
         url: '/get/collection-managers/'+id,
         type: "GET",
         success:function(response) { 
            //console.log(data);
                              console.log(response);

                                    var len = 0;
                                    $('#find_manager tbody').empty();     
                                    if(response.length > 0){
                                    len = response.length;
                                    for(var i=0; i<len; i++){
                                                          var manager_id = response[i].user_id;
                                                          var manager_name = response[i].name;                
                                                          var point_name = response[i].pointName;
                                                          var user_phone = response[i].user_phone;  
                                                         
                                                          var tr_str = "<tr>" +
                                                          "<td >"+"<input type='radio' value='"+manager_id+"' name='manager_id' id='manager_id"+manager_id+"'/>"+" </td>"+
                                                         "<td>" + manager_name + "</td>" +
                                                         "<td >" + point_name + "</td>" +    
                                                         "<td >" + user_phone  + "</td>" +                                                                         
                                                         "</tr>";
                                                         $("#find_manager tbody").append(tr_str);
                                                         if(point_name != null)
                                                         {
                                                            $("#manager_id"+manager_id).attr("checked", true);
                                                         }
                                                            }
                                                          }
                                                          else
                                                             {
                                                                var tr_str = "<tr>" +
                                                                "<td align='center' colspan='4'>No record found.</td>" +
                                                                "</tr>";
                                                                $("#find_manager tbody").append(tr_str);
                                                            }
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
