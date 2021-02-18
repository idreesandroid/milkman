@extends('layouts.master')
@section('content')
<!-- Page Header -->
<?php

$locations = [];

foreach ($vendors as $key => $value) {
   $loc = [];
   array_push($loc, $value['name']);
   array_push($loc, $value['latitude']);
   array_push($loc, $value['longitude']);
   array_push($locations, $loc);
}
?>
<div style="display: none" id="showInfoWindow">
    <table class="map1">
        <tr>
            <td><a>Name:</a></td>
            <td id='name'></td>
        </tr>
        <tr>
            <td><a>Latitude:</a></td>
            <td id='latitude'></td>
        </tr>
        <tr>
            <td><b>longitude:</b></td>
            <td id='longitude'></td>
        </tr>
    </table>
</div>
<div class="crms-title row bg-white mb-4">
   <div class="col  p-0">
      <div></div>
      <h3 class="page-title">
         <span class="page-title-icon bg-gradient-primary text-white mr-2">
         <i class="la la-table"></i>
         </span>Collection Management
      </h3>
   </div>
   <div class="col p-0 text-right">
      <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
         <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
         <li class="breadcrumb-item active">Collection Management</li>
      </ul>
   </div>
</div>
<div class="page-header  mb-0 ">
   <div class="row">
      <div class="col">
         <h3>Collection Management</h3>
      </div>
      @can('Create-Collection-Area')
      <div class="col text-right">
         <ul class="list-inline-item pl-0">
            <li class="list-inline-item">
               <a  href="{{url('collection/create')}}"class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded">Create Collection Area</a>
            </li>
         </ul>
      </div>
      @endcan
   </div>
</div>
<!-- /Page Header -->
<div class="row m-0">
   <div class="col-md-12 grid-margin stretch-card kanban">
      <div class="">
         <div class="card-body p-0 row">
            <div id="sortableKanbanBoards" class="col-md-12 p-0">           
            @foreach($collections as $item)                   
               <div class="panel panel-primary m-0" id="kanban-single-col">
                  <div class="panel-body slimScrollDiv">
                     <div id="TODO" class="kanban-centered">
                        <article class="kanban-entry grab" id="item1" draggable="true">
                           <div class="kanban-entry-inner">
                              <div class="kanban-label card <?php echo ($item->status == 'active') ? 'bg-gradient-success' : 'bg-gradient-danger'  ?> card-img-holder text-white h-100" data-toggle="modal" data-target="#leads-details">
                                 @if($item->collector_id == 0)
                                    <img src="UserProfile/placeholder.jpg" class="cb-image" alt="circle-image">
                                 @else
                                    <a href="{{ route('profile.user', $item->collector_id)}}"><img src="UserProfile/<?php echo $item->filenames; ?>" class="cb-image" alt="collector-image"></a>
                                 @endif
                                 <ul class="collector_detial">
                                       <li><a href="{{ route('profile.user', $item->collector_id)}}">{{$item->name}}</a></li>
                                       <li>{{$item->user_phone}}</li>
                                 </ul>
                                <h5> Area Morning Capacity: {{calculateAreaMCapacity($item->id)}}</h5>
                              
                                <h5>  Area Evening Capacity: {{calculateAreaECapacity($item->id)}}</h5>

                                 <h2>{{$item->title}}</h2>                                
                                 <ul class="list-unstyled">
                                    @foreach($item->vendors as $subitem) 
                                       <li><a href="{{ route('profile.user', $subitem->id)}}">{{$subitem->name}}</a></li>
                                    @endforeach
                                 </ul>                                
                              </div>
                           </div>
                           <div class="midle-div">
                             @can('Assign-Collection-Area')
                              <!-- <a href="#" class='btn btn-outline-primary assignCollector' data-toggle="modal" data-target="#assignCollectorModel" onclick="setCollectionId(<?php echo $item->id; ?>,<?php echo $item->collector_id; ?>)">Assign Collector</a> -->
                             @endcan

                             <!-- Asim work on Task as--------------------------------------------------------------- -->
                             <br>
                             @if($item->AFM == 0)
                              <a href="#" id="assignCollectorM_{{$item->id}}" class='btn btn-outline-primary' data-toggle="modal" data-target="#collectorSelection" onclick="findCollectors({{$item->id}},'Morning')">Assign Collector For Morning</a>
                             @endif
                            
                             @if($item->AFM == 1)
                              <a href="#" id="ReassignCollectorM_{{$item->id}}" class='btn btn-outline-primary' data-toggle="modal" data-target="#collectorReSelection" onclick="ReAssignCollectors({{$item->id}},'Morning')">Reassign Collector For Morning</a>
                             @endif
                     
                             @if($item->AFE == 0)
                              <a href="#" id="assignCollectorE_{{$item->id}}" class='btn btn-outline-primary' data-toggle="modal" data-target="#collectorSelection" onclick="findCollectors({{$item->id}},'Evening')">Assign Collector For Evening</a>
                             @endif

                           
                             @if($item->AFE == 1)
                              <a href="#" id="ReassignCollectorE_{{$item->id}}" class='btn btn-outline-primary' data-toggle="modal" data-target="#collectorReSelection" onclick="ReAssignCollectors({{$item->id}},'Evening')">ReAssign Collector For Evening</a>
                             @endif
                              <br>

                            
                            <!-- Asim work on Task as--------------------------------------------------------------- -->

                             @can('Edit-Collection-Area')
                              <a href="{{route('edit.collection',$item->id)}}" class='btn btn-outline-success editCollection' >Edit</a>
                              @endcan
                              @can('Delete-Collection-Area')
                              <a href="#" onclick="deleteCollection(<?php echo $item->id; ?>)"; class='btn btn-outline-danger'>Delete <input type="hidden" class="deleteCollectionId" value="{{$item->id}}"></a>
                              @endcan
                           </div>
                        </article>
                     </div>
                  </div>
               </div>
            @endforeach
            </div>
         </div>
      </div>
   </div>
</div>                     


<!--Collector Assiging-->
<div class="modal right fade" id="assignCollectorModel" role="dialog" aria-modal="true">
   <div class="modal-dialog" role="document">
      <button type="button" class="close md-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title text-center">Assign Collector</h4>
            <button type="button" class="close xs-close" data-dismiss="modal">×</button>
         </div>
         <div class="modal-body">
         <div class="row">
                  <div class="col-md-12">
                     <div class="card mb-0">
                        <div class="card-body">
                           <div class="table-responsive">
                              <table class="table table-striped table-nowrap custom-table mb-0 datatable">
                                 <thead>
                                    <tr>                                  
                                       <th></th>
                                       <th>Full Name</th>                                      
                                       <th>Phone</th>
                                       <th>Email</th>
                                       <th>Address</th>                                      
                                       <th class="text-right">Actions</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 <input type="hidden" id="collectionId">
                                 @foreach($collectors as $collector)
                                    <tr>
                                       <td class="checkBox">
                                          <label class="container-checkbox">
                                             <input type="radio" name="selectedCollector" id="collectionId_{{$collector->id}}">
                                             <span class="checkmark"></span>
                                          </label>
                                       </td>
                                       <td>
                                          <a href="#" class="avatar"><img alt="" src="{{asset('/UserProfile/'.$collector->filenames)}}"></a>
                                          <a href="#" data-toggle="modal" data-target="#system-user">{{$collector->name}}</a>
                                       </td>                                       
                                       <td>{{$collector->user_phone}}</td>
                                       <td>{{$collector->email}}</td>
                                       <td><span class="badge badge-gradient-success">{{$collector->city}}, {{$collector->state}}</span></td>
                                              
                                       <td class="text-center">
                                          <a href="" onclick="AssignCollectorToACollectionArea(<?php echo $collector->id; ?>)" class="btn btn-outline-success">Assign</a>
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
         </div>
      </div>
      <!-- modal-content -->
   </div>
   <!-- modal-dialog -->
</div>
<!-- modal -->

<!--Asim Make model for Assign Collector For Task Selection---->

<div id="collectorSelection" class="modal fade" role="dialog">
               <div class="modal-dialog" id="batch-info">
                  <!-- Modal content-->
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <div class="modal-body">
                        <div class="table-responsive">
                           <form method="post" action="{{route('select.Collector')}}">
                              @csrf 
                              <input type="hidden" name="cArea" id="area"/>
                              <input type="hidden" name="cShift" id="shift"/>

                              <table class="datatable table table-stripped mb-0 fetch_Collector" id="fetch_Collector">
                                 <thead>
                                    <tr>
                                       <th>Select</th>
                                       <th>Name</th>
                                       <th>Phone</th>
                                       <th>Capacity</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                              </table>
                              <button type="submit" class=" form-control btn btn-primary btn-info btn-lg " >Assign</button>
                           </form>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>

<!--End Asim Make model for AssignTask Selection---->


<!--Asim Make model for ReAssign Collector For Task Selection---->

<div id="collectorReSelection" class="modal fade" role="dialog">
               <div class="modal-dialog" id="batch-info">
                  <!-- Modal content-->
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <div class="modal-body">
                        <div class="table-responsive">
                           <form method="post" action="{{route('reselect.Collector')}}">
                              @csrf 
                              <input type="hidden" name="reArea" id="rearea"/>
                              <input type="hidden" name="reShift" id="reshift"/>

                              <table class="datatable table table-stripped mb-0 fetch_Collector" id="Refetch_Collector">
                                 <thead>
                                    <tr>
                                       <th>Select</th>
                                       <th>Name</th>
                                       <th>Phone</th>
                                       <th>Capacity</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                              </table>
                              <button type="submit" class=" form-control btn btn-primary btn-info btn-lg " >Assign</button>
                           </form>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>

<!--End Asim Make model for ReAssignTask Selection---->

<!-- Asim work on Task as--------------------------------------------------------------- -->


<script type="text/javascript">
   function findCollectors(id , value)
   { 
      if(value == 'Morning')
      {
         $("#shift").val(value);
         $("#area").val(id);

         if(id != null)
         {

            $.ajax({
            url: '/assign/Area/'+value+'/'+id,
               type: "GET",
               dataType: "json",
               success:function(response)
                {
                  var len = 0;
                  $('#fetch_Collector tbody').empty();     
                  if(response.length > 0)
                  {
                     len = response.length;

                     for(var i=0; i<len; i++)
                     {  
                   var cid = response[i].id;                
                   var collector_name = response[i].name;
                   var collector_Phone = response[i].user_phone;  
                   var collector_Capacity = response[i].collectorCapacity;

                   //console.log(collector_Capacity);    

                   var tr_str = "<tr>" +
                   "<td >" + "<input type='radio' value='"+cid+"'  name='select_collector' id='select_collector"+cid+"'/>" + "</td>" +
                     "<td >" + collector_name + "</td>" +    
                     "<td >" + collector_Phone + "</td>" +   
                     "<td >" + collector_Capacity + "</td>" +       
                   "</tr>";
                   $("#fetch_Collector tbody").append(tr_str);
                     }   
                  }
                  else
                  {
                     alert("There is no collector Available");
                  }
                }                              
               });
         }
      }

      else if(value == 'Evening')
      { 
         $("#shift").val(value);
         $("#area").val(id);
         if(id != null)
         {
            $.ajax({
            url: '/assign/Area/'+value+'/'+id,
               type: "GET",
               dataType: "json",
               success:function(response) 
               {
                  var len = 0;
                  $('#fetch_Collector tbody').empty();     
                  if(response.length > 0)
                  {
                     len = response.length;
                     for(var i=0; i<len; i++)
                     {  
                   var cid = response[i].id;                
                   var collector_name = response[i].name;
                   var collector_Phone = response[i].user_phone;  
                   var collector_Capacity = response[i].collectorCapacity;

                   console.log(collector_Capacity);    

                   var tr_str = "<tr>" +
                     "<td >" + "<input type='radio' value='"+cid+"'  name='select_collector' id='select_collector"+cid+"'/>" + "</td>" +
                     "<td >" + collector_name + "</td>" +    
                     "<td >" + collector_Phone + "</td>" +   
                     "<td >" + collector_Capacity + "</td>" +             
                   "</tr>";
                   $("#fetch_Collector tbody").append(tr_str);
                     }   
                  }
                  else
                  {
                     alert("There is no collector Available");
                  }
                }
                                            
                  });
         }
      }      
   }
</script>


<script type="text/javascript">
   function ReAssignCollectors(id , value)
      { 
          if(value == 'Morning')
            {
             $("#reshift").val(value);
             $("#rearea").val(id);
               if(id != null)
                {
                 $.ajax({
                 url: '/assign/Area/'+value+'/'+id,
                 type: "GET",
                 dataType: "json",
                 success:function(response)
                 {
                  var len = 0;
                  $('#Refetch_Collector tbody').empty();     
                  if(response.length > 0)
                  {
                     len = response.length;
                     for(var i=0; i<len; i++)
                     {  
                   var cid = response[i].id;                
                   var collector_name = response[i].name;
                   var collector_Phone = response[i].user_phone;  
                   var collector_Capacity = response[i].collectorCapacity;

                   //console.log(collector_Capacity);    

                   var tr_str = "<tr>" +
                   "<td >" + "<input type='radio' value='"+cid+"'  name='reselect_collector' id='select_collector"+cid+"'/>" + "</td>" +
                     "<td >" + collector_name + "</td>" +    
                     "<td >" + collector_Phone + "</td>" +   
                     "<td >" + collector_Capacity + "</td>" +       
                   "</tr>";
                   $("#Refetch_Collector tbody").append(tr_str);
                     }   
                  }
                  else
                  {
                     alert("There is no collector Available");
                  }
                  }                              
                       });
                }
               }

      else if(value == 'Evening')
      { 
         $("#reshift").val(value);
         $("#rearea").val(id);
         if(id != null)
         {
            $.ajax({
            url: '/assign/Area/'+value+'/'+id,
               type: "GET",
               dataType: "json",
               success:function(response) 
               {
                  var len = 0;
                  $('#Refetch_Collector tbody').empty();     
                  if(response.length > 0)
                  {
                     len = response.length;
                     for(var i=0; i<len; i++)
                     {  
                   var cid = response[i].id;                
                   var collector_name = response[i].name;
                   var collector_Phone = response[i].user_phone;  
                   var collector_Capacity = response[i].collectorCapacity;

                   console.log(collector_Capacity);    

                   var tr_str = "<tr>" +
                     "<td >" + "<input type='radio' value='"+cid+"'  name='reselect_collector' id='select_collector"+cid+"'/>" + "</td>" +
                     "<td >" + collector_name + "</td>" +    
                     "<td >" + collector_Phone + "</td>" +   
                     "<td >" + collector_Capacity + "</td>" +             
                   "</tr>";
                   $("#Refetch_Collector tbody").append(tr_str);
                     }   
                  }
                  else
                  {
                     alert("There is no collector Available");
                  }
                }                                            
            });
         }
      }      
   }

</script>
<!-- Asim work on Task as--------------------------------------------------------------- -->




<script type="text/javascript">
var locations = <?php echo json_encode($locations) ?>;

function setCollectionId(collectionId,collector_id){
   $("#collectionId").val(collectionId);
   if(collector_id != 0){
      $("#collectionId_"+collector_id).prop("checked", true);
   }else{
      $("#collectionId_"+collector_id).prop("checked", false);
   }
}
function AssignCollectorToACollectionArea(collectorID){
   event.preventDefault();
   var collectionId = $("#collectionId").val();   
   jQuery.ajax({
        url: "{{ route('assignCollector.collection') }}",
        type: "POST",
        data: {
            id: collectionId,
            collectorId : collectorID,
            '_token' : "{{ csrf_token() }}"
        },
        success: function (response, status) {
            jQuery('#assignCollectorModel').modal('hide');
            if(response){
               swal.fire("Done!", "Collector Assigned Succesfully!", "success").then((result) => {
                  if(result.isConfirmed) {
                     location.reload(true);
                  }
               });
            }else{
               swal.fire("Error Assiging Collector!", "Collector can not be assign to an In Active Collection Area", "error").then((result) => {
                  if(result.isConfirmed) {
                     location.reload(true);
                  }
               });
            }
        },
        error: function () {
            jQuery('#assignCollectorModel').modal('hide');
            swal.fire("Error Assigning!", "Please try again", "error").then((result) => {
               if(result.isConfirmed) {
                  location.reload(true);
               }
            });
        }
   });   
}


function deleteCollection(collectionId){
   swal.fire({
         title: 'Are you sure?',
         text: "You won't be able to revert this collection area!",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes, delete it!'
     }).then((result) => {
         if (result.isConfirmed) {
             jQuery.ajax({
                 url: "{{ route('destroy.collection') }}",
                 type: "POST",
                 data: {
                     id: collectionId,
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
 

      $("#updateColectionArea").on('click',function(){

         var title = $("#edit_title").val();        
         if(!title.length){
            $("#edit_title").focus();
            alert('Please insert the title');            
            return false;
         }  
        var editStatus = $("#editStatus").val();
         if(!editStatus.length){
            $("#editStatus").focus();
            alert('Please select the status');
            return false;
         }

         var MapData = $("#update_MapData").val();
         if(!MapData.length){
            $("#update_raw_map").focus();
            alert('Please draw Collection Area and then click on Add Map button');
            return false;
         }


         if (MapData.indexOf('MARKER') > -1)
         {
           alert("You can not add any additional MARKER on this map");
           return false;
         }

         var collector_id = $("#collector_id").val();        
         var collection_id = $("#collection_id").val();        
        
         var json_data = {
               'id' : collection_id,
               'title' : title,
               'status' : editStatus,
               'vendors_location' : MapData,
               'collector_id' : collector_id,
               '_token' : "{{ csrf_token() }}"
            };  
         $.ajax({
            url : "{{ route('update.collection') }}",
            type: "POST",
            data: json_data,           
            success : function(data) {              
               if(data){
                  $("#title").val("");
                  $("#selectedVendors").val("");
                  $("#MapData").val("");
                  $("#editCollectionModel .close").click();
                  Swal.fire('Collection Area Updated','You clicked the button!','success').then((result) => {
                     if(result.isConfirmed) {
                        location.reload(true);
                     }
                  });
               }
             },
            error: function(){
               swal.fire("Error Update Collection!", "Error in Update Collection Area error", "error").then((result) => {
                  if(result.isConfirmed) {
                     location.reload(true);
                  }
               });
            }
         });

      }); 


      $('#assignCollectorModel').on('hidden.bs.modal', function () {
        $("#assignCollectorModel input[type=radio]").prop("checked", false);
      });      


$(document).ready(function() { 
   $('#assignCollectorModel').on('hidden.bs.modal', function () {
      $("#assignCollectorModel input[type=radio]").prop("checked", false);
   });
}); 
</script> 


@endsection

