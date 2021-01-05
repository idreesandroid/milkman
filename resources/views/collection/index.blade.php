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
            <div id="sortableKanbanBoards" class="col-md-12 kanban-views p-0">           
            @foreach($collections as $item)                   
               <div class="panel panel-primary kanban-col m-0">
                  <div class="panel-body slimScrollDiv">
                     <div id="TODO" class="kanban-centered">
                        <article class="kanban-entry grab" id="item1" draggable="true">
                           <div class="kanban-entry-inner">
                              <div class="kanban-label card <?php echo ($item->status == 'active') ? 'bg-gradient-success' : 'bg-gradient-danger'  ?> card-img-holder text-white h-100" data-toggle="modal" data-target="#leads-details">
                                 @if($item->collector_id == 0)
                                    <img src="assets/img/circle.png" class="card-img-absolute" alt="circle-image">
                                 @else
                                    <img src="UserProfile/<?php echo $item->filenames; ?>" class="card-img-absolute" alt="collector-image">
                                 @endif

                                 <h2 data-toggle="modal" data-target="#leads">{{$item->title}}</h2>                                
                                 <ul class="list-unstyled">
                                    @foreach($item->vendors as $subitem) 
                                       <li>{{$subitem->name}}</li>
                                    @endforeach
                                 </ul>
                              </div>
                           </div>
                           <div>
                              <a href="#" id="" class='btn btn-outline-primary assignCollector' data-toggle="modal" data-target="#assignCollectorModel">Assign Collector</a>
                              <a href="#" onclick="editCollection(this)" class='btn btn-outline-success editCollection' data-toggle="modal" data-target="#editCollectionModel">Edit<input type="hidden" class="editCollectionId" value="{{$item->id}}"></a>
                              <a href="#" onclick="deleteCollection(this)"; class='btn btn-outline-danger'>Delete <input type="hidden" class="deleteCollectionId" value="{{$item->id}}"></a>
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
                        <div class="col-md-4">
                           <label class="col-form-label">Title <span class="text-danger">*</span></label>
                           <input class="form-control" type="text" placeholder="Add Collection Ttile" name="prefix" id='title'>
                        </div>
                        <div class="col-md-8">
                           <label for="selectedVendorsInEditModel" class="col-form-label col-md-1">Vendors</label>                           
                              <select class="form-control" id="selectedVendorsInEditModel" name="vendorsIds[]" multiple="multiple">                       
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
                              <input type="text" min="0"  class="form-control" id="MapData" readonly name="vendors_location" value="{{$location}}">
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
                              <input type="button" class="form-control btn btn-danger"  value="Clear Map" id="clear_shapes">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">                        
                              <input type="button" id="restore" class="form-control btn btn-primary"  value="Restore Map">
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

<!--Collection Area Information Edit Model-->
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
                        <div class="col-md-4">
                           <label class="col-form-label">Title <span class="text-danger">*</span></label>
                           <input class="form-control" type="text" placeholder="Add Collection Ttile" name="prefix" id='title'>
                        </div>
                        <div class="col-md-8">
                           <label for="selectedVendorsInAddModel" class="col-form-label col-md-1">Vendors</label>                           
                              <select class="form-control" id="selectedVendorsInAddModel" name="vendorsIds[]" multiple="multiple">                       
                                 @foreach($vendors as $vendor)
                                 <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                 @endforeach
                              </select>                           
                        </div>
                     </div>    
                     <div class="map" id="editCollectionMap"></div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">                        
                              <input type="text" min="0"  class="form-control" id="MapData" readonly name="vendors_location" value="{{$location}}">
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
                              <input type="button" class="form-control btn btn-danger"  value="Clear Map" id="clear_shapes">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">                        
                              <input type="button" id="restore" class="form-control btn btn-primary"  value="Restore Map">
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


<!--Collection Area Information Edit Model-->
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
                                       <th>Location</th>                                      
                                       <th class="text-right">Actions</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td class="checkBox">
                                          <label class="container-checkbox">
                                             <input type="radio" name="selectedCollector">
                                             <span class="checkmark"></span>
                                          </label>
                                       </td>
                                       <td>
                                          <a href="#" class="avatar"><img alt="" src="assets/img/profiles/avatar-11.jpg"></a>
                                          <a href="#" data-toggle="modal" data-target="#system-user">Wilmer Deluna</a>
                                       </td>                                       
                                       <td>
                                          875455453
                                       </td>
                                       <td>wilmer@gmail.com </td>
                                       <td><span class="badge badge-gradient-success">Sample_data</span></td>
                                              
                                       <td class="text-center">
                                          <a href="" class="btn btn-outline-success">Assign</a>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="checkBox">
                                          <label class="container-checkbox">
                                             <input type="radio" name="selectedCollector">
                                             <span class="checkmark"></span>
                                          </label>
                                       </td>
                                       <td>
                                          <a href="#" class="avatar"><img alt="" src="assets/img/profiles/avatar-11.jpg"></a>
                                          <a href="#" data-toggle="modal" data-target="#system-user">Wilmer Deluna</a>
                                       </td>                                      
                                       <td>
                                          875455453
                                       </td>
                                       <td>wilmer@gmail.com </td>
                                       <td><span class="badge badge-gradient-success">Sample_data</span></td>
                                              
                                          <td class="text-center">
                                          <a href="" class="btn btn-outline-success">Assign</a>
                                       </td>
                                    </tr>                                  
                                    
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

function deleteCollection(elem){
   var collectionId = elem.childNodes[1].attributes['value'].value;      
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

function editCollection(elem){
   var collectionId = elem.childNodes[1].attributes['value'].value;      
   jQuery.ajax({
      url: "{{ route('edit.collection') }}",
      type: "POST",
      data: {
            id: collectionId,
            '_token' : "{{ csrf_token() }}"
            },
      success: function(){
         jQuery('#editCollectionModel').modal('show');
      }
   });       
}
  
  


   $(document).ready(function() { 

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


       initializeMap('addCollectionMap');
       initializeMap('editCollectionMap');
      $("#saveColectionArea").on('click',function(){

         var title = $("#title").val();        
         if(!title.length){
            $("#title").focus();
            alert('Please insert the title');            
            return false;
         }  
         var vendors = [];
         vendors = $("#selectedVendors").val();
         if(!vendors.length){
            $(".select2-selection").focus();
            alert('Please select the vendors');
            return false;
         }

         var MapData = $("#MapData").val();
         if(!MapData.length){
            $("#save_raw_map").focus();
            alert('Please draw Collection Area and then click on Add Map button');
            return false;
         }
        
         var json_data = {
               'title' : title,
               'vendorsIds' : vendors,
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
                  $("#selectedVendors").val("");
                  $("#MapData").val("");
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
     
   }); 
</script> 
@endsection

