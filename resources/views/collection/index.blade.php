@extends('layouts.master')
@section('content')
<!-- Page Header -->
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
      <div class="col text-right">
         <ul class="list-inline-item pl-0">
            <li class="list-inline-item">
               <button class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" id="add-task" data-toggle="modal" data-target="#addCollectionModel">Add Collection Area</button>
            </li>
         </ul>
      </div>
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
                                    <img src="UserProfile/<?php echo $item->filenames; ?>" class="cb-image" alt="collector-image">
                                 @endif

                                 <h2 data-toggle="modal" data-target="#leads">{{$item->title}}</h2>                                
                                 <ul class="list-unstyled">
                                    @foreach($item->vendors as $subitem) 
                                       <li>{{$subitem->name}}</li>
                                    @endforeach
                                 </ul>                                
                              </div>
                           </div>
                           <div class="midle-div">
                              <a href="#" class='btn btn-outline-primary assignCollector' data-toggle="modal" data-target="#assignCollectorModel" onclick="setCollectionId(<?php echo $item->id; ?>,<?php echo $item->collector_id; ?>)">Assign Collector</a>
                              <a href="#" onclick="editCollection(<?php echo $item->id; ?>)" class='btn btn-outline-success editCollection' data-toggle="modal" data-target="#editCollectionModel">Edit<input type="hidden" class="editCollectionId" value="{{$item->id}}">
                              </a>
                              <a href="#" onclick="deleteCollection(<?php echo $item->id; ?>)"; class='btn btn-outline-danger'>Delete <input type="hidden" class="deleteCollectionId" value="{{$item->id}}"></a>
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

<!--Collection Area Information Add Model-->
<div class="modal right fade" id="addCollectionModel" role="dialog" aria-modal="true">
   <div class="modal-dialog" role="document">
      <button type="button" class="close md-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title text-center">Add Collection Area</h4>
            <button type="button" class="close xs-close" data-dismiss="modal">×</button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-12">
                  <form>
                     <h4>Collection Area Information</h4>
                     <div class="form-group row">
                        <div class="col-md-3">
                           <label class="col-form-label">Title <span class="text-danger">*</span></label>
                           <input class="form-control" type="text" placeholder="Add Collection Ttile" name="prefix" id='title'>
                        </div>
                        <div class="col-md-3">
                           <label class="col-form-label">Status <span class="text-danger">*</span></label>
                           <select class="form-control" id="addStatus" name="addStatus">
                                 <option value="">Select Status</option>
                                 <option value="active">Active</option>
                                 <option value="inactive">Inactive</option>
                              </select> 
                        </div>
                        <div class="col-md-6">
                           <label for="selectedVendorsInAddModel" class="col-form-label col-md-1">Vendors</label>                           
                              <select class="form-control" id="selectedVendorsInAddModel" name="vendorsIds[]" multiple="multiple">                       
                                 @foreach($vendors as $vendor)
                                 <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                 @endforeach
                              </select>                           
                        </div>
                     </div>    
                     <div class="map" id="addCollectionMap"></div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">                        
                              <input type="text" min="0"  class="form-control" id="add_MapData" name="vendors_location" value="{{$location}}" readonly>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-2">
                           <div class="form-group">                        
                              <input type="button"  class="form-control btn btn-info"  value="Add Map" id="save_raw_map">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">                        
                              <input type="button" class="form-control btn btn-danger"  value="Clear Map" id="add_clear_shapes">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">                        
                              <input type="button" id="add_restore" class="form-control btn btn-primary"  value="Restore Map">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">                        
                              <input type="button" class="form-control btn btn-primary"  value="Save Collection Area" id="saveColectionArea">
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- modal-content -->
   </div>
   <!-- modal-dialog -->
</div>
<!-- modal -->


<!--Collection Area Information-->

<div class="modal right fade" id="editCollectionModel" role="dialog" aria-modal="true">
   <div class="modal-dialog" role="document">
      <button type="button" class="close md-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title text-center">Update Collection Area</h4>
            <button type="button" class="close xs-close" data-dismiss="modal">×</button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-12">
                  <form>
                     <h4>Collection Area Information</h4>
                     <div class="form-group row">
                        <div class="col-md-3">
                           <label class="col-form-label">Title <span class="text-danger">*</span></label>
                           <input class="form-control" type="text" placeholder="Add Collection Ttile" name="prefix" id='edit_title'>
                           <input type="hidden" id="collector_id">
                           <input type="hidden" id="collection_id">
                        </div>
                        <div class="col-md-3">
                           <label class="col-form-label">Status <span class="text-danger">*</span></label>
                           <select class="form-control" id="editStatus" name="editStatus">
                                 <option value="">Select Status</option>
                                 <option value="active">Active</option>
                                 <option value="inactive">Inactive</option>
                              </select> 
                        </div>
                        <div class="col-md-6">
                           <label for="selectedVendorsInEditModel" class="col-form-label col-md-1">Vendors</label>                           
                              <select class="form-control" id="selectedVendorsInEditModel" name="vendorsIds[]" multiple="multiple">                       
                                 @foreach($vendors as $vendor)
                                 <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                 @endforeach
                              </select>                           
                        </div>
                     </div>    
                     <div class="map" id="updateCollectionMap"></div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">                        
                              <input type="text" min="0"  class="form-control" id="update_MapData" readonly name="vendors_location" value="{{$location}}">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-2">
                           <div class="form-group">                        
                              <input type="button"  class="form-control btn btn-info"  value="Add Map" id="update_raw_map">
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">                        
                              <input type="button" class="form-control btn btn-danger"  value="Clear Map" id="edit_clear_shapes">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">                        
                              <input type="button" id="edit_restore" class="form-control btn btn-primary"  value="Restore Map">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">                        
                              <input type="button" class="form-control btn btn-primary"  value="Update Collection Area" id="updateColectionArea">
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- modal-content -->
   </div>
   <!-- modal-dialog -->
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




<script type="text/javascript">


 $(document).ready(function() {   

      
   });

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
               swal.fire("Done!", "Collector Assigned Succesfully!", "success");
            }else{
               swal.fire("Error Assiging Collector!", "Collector can not be assign to an In Active Collection Area", "error");
            }
        },
        error: function () {
            jQuery('#assignCollectorModel').modal('hide');
            swal.fire("Error Assigning!", "Please try again", "error");
        }
   });
   
}

function editCollection(collectionId){        
   jQuery.ajax({
      url: "{{ route('edit.collection') }}",
      type: "POST",
      data: {
            id: collectionId,            
            '_token' : "{{ csrf_token() }}"
            },
      success: function(response, status){
         jQuery('#editCollectionModel').modal('show');         

            $("#edit_title").val(response[0].title);
            $("#collection_id").val();
            $("#collection_id").val(response[0].id);
            $("#collector_id").val();
            $("#collector_id").val(response[0].collector_id);

            $("#update_MapData").val("");
            $("#update_MapData").val(response[0].vendors_location);
            if(response[0].status == 'active'){            
               $("#editStatus option[value='inactive']").removeAttr("selected");
               $("#editStatus option[value='active']").attr("selected","selected");
            }else{
               $("#editStatus option[value='active']").removeAttr("selected");
               $("#editStatus option[value='inactive']").attr("selected","selected");            
            }
               var selectedItems = [];

            response.forEach(addSelected);

            function addSelected(item, index){
               selectedItems.push(item.vendor_id); 
            }           
         $("#selectedVendorsInEditModel").val(selectedItems).trigger("change");
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
                     swal.fire("Done!", "It was succesfully deleted!", "success");
                 },
                 error: function () {
                     swal.fire("Error deleting!", "Please try again", "error");
                 }
             });
         }
     });
}
  
  


   $(document).ready(function() { 


      $("#saveColectionArea").on('click',function(){

         var title = $("#title").val();        
         if(!title.length){
            $("#title").focus();
            alert('Please insert the title');            
            return false;
         }  
         var vendors = [];
         vendors = $("#selectedVendorsInAddModel").val();
         if(!vendors.length){
            $(".select2-selection").focus();
            alert('Please select the vendors');
            return false;
         }

         var addStatus = $("#addStatus").val();
         if(!addStatus.length){
            $("#addStatus").focus();
            alert('Please select the status');
            return false;
         }

         var MapData = $("#add_MapData").val();
         if(!MapData.length){
            $("#save_raw_map").focus();
            alert('Please draw Collection Area and then click on Add Map button');
            return false;
         }
        
         var json_data = {
               'title' : title,
               'vendorsIds' : vendors,
               'status' : addStatus,
               'vendors_location' : MapData,
               '_token' : "{{ csrf_token() }}"
            };  
         $.ajax({
            url : "{{ route('store.collection') }}",
            type: "POST",
            data: json_data,           
            success : function(data) {              
               if(data){
                  $("#title").val("");
                  $("#selectedVendorsInAddModel").val("");
                  $("#add_MapData").val("");
                  $("#addStatus").val("");
                  $("#addCollectionModel .close").click();
                  Swal.fire(
                    'Collection Area created',
                    'You clicked the button!',
                    'success'
                  )
               }
             },
             error : function(request,error)
             {
               console.log("Request: "+JSON.stringify(request));
             }
         });

      });


      $("#updateColectionArea").on('click',function(){

         var title = $("#edit_title").val();        
         if(!title.length){
            $("#edit_title").focus();
            alert('Please insert the title');            
            return false;
         }  
         var vendors = [];
         vendors = $("#selectedVendorsInEditModel").val();
         if(!vendors.length){
            $(".select2-selection").focus();
            alert('Please select the vendors');
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

         var collector_id = $("#collector_id").val();        
         var collection_id = $("#collection_id").val();        
        
         var json_data = {
               'id' : collection_id,
               'title' : title,
               'vendorsIds' : vendors,
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
                  Swal.fire(
                    'Collection Area Updated',
                    'You clicked the button!',
                    'success'
                  )
               }
             },
             error : function(request,error)
             {
               console.log("Request: "+JSON.stringify(request));
             }
         });

      }); 

      initializeMap('addCollectionMap','add_clear_shapes','save_raw_map','add_restore','add_MapData');
      initializeMap('updateCollectionMap','edit_clear_shapes','update_raw_map','edit_restore','update_MapData');

      $('#assignCollectorModel').on('hidden.bs.modal', function () {
        $("#assignCollectorModel input[type=radio]").prop("checked", false);
      });

      $("#selectedVendorsInAddModel").select2( {
         placeholder: "Search for a Vendors",
         width: '100%',
        dropdownParent: $("#addCollectionModel")
        });

      $("#selectedVendorsInEditModel").select2( {
         placeholder: "Search for a Vendors",
         width: '100%',
        dropdownParent: $("#editCollectionModel")
        });      
   }); 
</script> 
@endsection

