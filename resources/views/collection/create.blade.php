@extends('layouts.master')
@section('content')
<!-- Page Header -->
<div class="crms-title row bg-white mb-4">
   <div class="col  p-0">
      <div></div>
      <h3 class="page-title">
         <span class="page-title-icon bg-gradient-primary text-white mr-2">
         <i class="la la-table"></i>
         </span>Create Collection Area
      </h3>
   </div>
   <div class="col p-0 text-right">
      <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
         <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
         <li class="breadcrumb-item active">Create Collection Area</li>
      </ul>
   </div>
</div>
<div class="row m-0">
   <div class="col-md-12 grid-margin">
      <div class="row">
               <div class="col-md-12">
                  <form>
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
                                 <option data-vendor-id="{{$vendor->id}}" value="{{$vendor->id}}">{{$vendor->name}}</option>
                                 @endforeach
                              </select>                           
                        </div>
                     </div>    
                     <div class="map" id="addCollectionMap"></div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">                        
                              <input type="text" class="form-control" id="add_MapData" name="vendors_location" value="{{$location}}" readonly>
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
<script type="text/javascript">
   
 $(document).ready(function() { 
 $("#selectedVendorsInAddModel").select2( {
      placeholder: "Search for a Vendors",
   }).on('change', function(e) {
      var vendorID = $("#selectedVendorsInAddModel").val();
      //alert(vendorID);
      $.ajax({
         url : "{{ route('getvendorlatlng.collection') }}",
         type: "POST",
         data: {
            '_token' : "{{ csrf_token() }}",
            'vendor_id' : vendorID
         },
         success: function(response, status){
            console.log(response);
         },
         error: function(response, status){
            console.log(response);
         }

      });
         
    });
   initializeMap('addCollectionMap','add_clear_shapes','save_raw_map','add_restore','add_MapData');

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
                  Swal.fire('Collection Area created', 'You clicked the button!','success').then((result) => {
                     if(result.isConfirmed) {
                        location.reload(true);
                     }
                  });
               }
             },
            error: function(){
               swal.fire("Error Completion Task!", "Error in Create Collection Area error", "error").then((result) => {
                  if(result.isConfirmed) {
                     location.reload(true);
                  }
               });
            }
         });

      });
      
   });
</script>
@endsection