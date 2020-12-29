

@extends('layouts.master')
@section('content')
<style>
#add_lead #mapIn{
   height: 400px;
}
.select2-selection:focus, #title:focus, #MapData:focus{
    border-color:red;
}
</style>

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
               <button class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" id="add-task" data-toggle="modal" data-target="#add_lead">Add Collection Area</button>
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
            @foreach($allVendors as $col => $val)                   
               <div class="panel panel-primary kanban-col m-0">
                  <div class="panel-body slimScrollDiv">
                     <div id="TODO" class="kanban-centered">
                        <article class="kanban-entry grab" id="item1" draggable="true">
                           <div class="kanban-entry-inner">
                              <div class="kanban-label card bg-gradient-danger card-img-holder text-white h-100" data-toggle="modal" data-target="#leads-details">
                                 <img src="assets/img/circle.png" class="card-img-absolute" alt="circle-image">
                                 <h2 data-toggle="modal" data-target="#leads">Anne Lynch</h2>
                                 <ul class="list-unstyled">
                                    <li>VB of Sales</li>
                                    <li>Howwe-Blanda LLC</li>
                                 </ul>
                              </div>
                           </div>
                        </article>
                     </div>
                  </div>
               </div>
            @endforeach
               <div class="panel panel-primary kanban-col mr-0">
                  <div class="panel-body slimScrollDiv">
                     <div id="DOING" class="kanban-centered">
                        <article class="kanban-entry grab" id="item5" draggable="true">
                           <div class="kanban-entry-inner">
                              <div class="kanban-label card bg-gradient-warning card-img-holder text-white h-100" data-toggle="modal" data-target="#leads-details">
                                 <img src="assets/img/circle.png" class="card-img-absolute" alt="circle-image">
                                 <h2 data-toggle="modal" data-target="#leads">Douglas Baker</h2>
                                 <ul class="list-unstyled">
                                    <li>Finance Director</li>
                                    <li>Ebert and Sons</li>
                                 </ul>
                              </div>
                           </div>
                        </article>
                     </div>
                  </div>
               </div>
               <div class="panel panel-primary kanban-col mr-0">
                  <div class="panel-body slimScrollDiv">
                     <div id="DONE" class="kanban-centered">
                        <article class="kanban-entry grab" id="item5" draggable="true">
                           <div class="kanban-entry-inner">
                              <div class="kanban-label card bg-gradient-info card-img-holder text-white h-100" data-toggle="modal" data-target="#leads-details">
                                 <img src="assets/img/circle.png" class="card-img-absolute" alt="circle-image">
                                 <h2 data-toggle="modal" data-target="#leads">Douglas Baker</h2>
                                 <ul class="list-unstyled">
                                    <li>Finance Director</li>
                                    <li>Ebert and Sons</li>
                                 </ul>
                              </div>
                           </div>
                        </article>
                     </div>
                  </div>
               </div>
               <div class="panel panel-primary kanban-col mr-0">
                  <div class="panel-body slimScrollDiv">
                     <div id="closed" class="kanban-centered">
                        <article class="kanban-entry grab" id="item6" draggable="true">
                           <div class="kanban-entry-inner">
                              <div class="kanban-label card bg-gradient-success card-img-holder text-white h-100" data-toggle="modal" data-target="#leads-details">
                                 <img src="assets/img/circle.png" class="card-img-absolute" alt="circle-image">
                                 <h2 data-toggle="modal" data-target="#leads">Douglas Baker</h2>
                                 <ul class="list-unstyled">
                                    <li>Finance Director</li>
                                    <li>Ebert and Sons</li>
                                 </ul>
                              </div>
                           </div>
                        </article>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>                     
<!--Collection Area Information-->
<div class="modal right fade" id="add_lead" role="dialog" aria-modal="true">
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
                           <label for="selectedVendors" class="col-form-label col-md-1">Vendors</label>                           
                              <select class="form-control" id="selectedVendors" name="vendorsIds[]" multiple="multiple">                       
                                 @foreach($vendors as $vendor)
                                 <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                 @endforeach
                              </select>                           
                        </div>
                     </div>    
                     <div class="map" id="mapIn"></div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">                        
                              <input type="text" min="0"  class="form-control" id="MapData" readonly name="vendors_location">
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
<script>   
   $(document).ready(function() { 
      $("#selectedVendors").select2( {
         placeholder: "Search for a Vendors",
         width: '100%',
        dropdownParent: $("#add_lead")
        });     
       initializeMap();
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

         var json_data = {'title' : title, 'vendorsIds' : vendors, 'vendors_location': MapData, "_token": "{{ csrf_token() }}"};        

         $.ajax({
            url : "{{ route('store.collection') }}",
            type: "POST",
            data: json_data,           
            success : function(data) {              
               if(data){
                  $("#title").val("");
                  $("#selectedVendors").val("");
                  $("#MapData").val("");
                  $("#add_lead .close").click();
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

