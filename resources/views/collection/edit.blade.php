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
         </span>Update Collection Area
      </h3>
   </div>
   <div class="col p-0 text-right">
      <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
         <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
         <li class="breadcrumb-item active">Update Collection Area Information</li>
      </ul>
   </div>
</div>
<div class="row m-0">
   <div class="col-md-12 grid-margin">
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
                              <input type="text" class="form-control" id="update_MapData" readonly name="vendors_location" value="{{$location}}">
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
<script type="text/javascript">
 var locations = <?php echo json_encode($locations) ?>

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
   initializeMap('updateCollectionMap','edit_clear_shapes','update_raw_map','edit_restore','update_MapData',locations,'30.437318444167968','69.24038656005861');

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
               Swal.fire('Collection Area Updated','You clicked the button!','success').then((result) => {
                  if(result.isConfirmed) {
                     location.reload(true);
                  }
               });
            }
          },
         error: function(){
            swal.fire("Error Completion Task!", "Error in Update Collection Area error", "error").then((result) => {
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