@extends('layouts.master')
@section('content')
<!-- Page Header -->
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
                        <div class="col-md-4">
                           <label class="col-form-label">Title <span class="text-danger">*</span></label>
                           <input class="form-control" type="text" placeholder="Add Collection Ttile" id='edit_title' value="{{$collection[0]['title']}}">
                           <input type="hidden" id="collector_id" value="{{$collection[0]['collector_id']}}">
                           <input type="hidden" id="collection_id" value="{{$collection[0]['id']}}">
                        </div>
                        <div class="col-md-4">
                           <label class="col-form-label">Status <span class="text-danger">*</span></label>
                           <select class="form-control" id="editStatus">
                                 <option value="active" <?php echo ($collection[0]['status'] == 'active') ? 'selected':''; ?>>Active</option>
                                 <option value="inactive" <?php echo ($collection[0]['status'] == 'inactive') ? 'selected':''; ?>>Inactive</option>
                              </select> 
                        </div>
                        <div class="col-md-4">
                           <label class="col-form-label">Marker and Label Color<span class="text-danger">*</span></label>
                           <select class="form-control" id="label_marker_color">
                                 <option value="green" <?php echo ($collection[0]['label_marker_color'] == 'green') ? 'selected':''; ?>>Green</option>
                                 <option value="orange" <?php echo ($collection[0]['label_marker_color'] == 'orange') ? 'selected':''; ?>>Orange</option>
                                 <option value="pink" <?php echo ($collection[0]['label_marker_color'] == 'pink') ? 'selected':''; ?>>Pink</option>
                                 <option value="lightBlue" <?php echo ($collection[0]['label_marker_color'] == 'lightBlue') ? 'selected':''; ?>>Light Blue</option>
                                 <option value="yellow" <?php echo ($collection[0]['label_marker_color'] == 'yellow') ? 'selected':''; ?>>Yellow</option>
                                 <option value="red" <?php echo ($collection[0]['label_marker_color'] == 'red') ? 'selected':''; ?>>Red</option>
                              </select> 
                        </div>                        
                     </div>    
                     <div class="map" id="updateCollectionMap"></div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">                        
                              <input type="text" class="form-control" id="update_MapData" readonly name="vendors_location" value="{{$location}}">
                              <input type="hidden" id="allMarkers">
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
<?php

$infoWindowDetail = [];

foreach ($vendors as $key => $value) {
   $temp = [];
   array_push($temp, $value['name']);
   array_push($temp, $value['latitude']);
   array_push($temp, $value['longitude']);
   array_push($temp, $value['label_marker_color']);
   array_push($infoWindowDetail, $temp);
}
 ?>
<script type="text/javascript">
   
$(document).ready(function() { 
   var infoWindowDetail = <?php echo json_encode($infoWindowDetail); ?>
   
   initializeMap('updateCollectionMap','edit_clear_shapes','update_raw_map','edit_restore','update_MapData',infoWindowDetail,infoWindowDetail[0][1],infoWindowDetail[0][2]);

   $( "#edit_restore" ).trigger( "click" );

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

      var label_marker_color = $("#label_marker_color").val();
      if(!label_marker_color.length){
         $("#label_marker_color").focus();
         alert('Please select the label marker color');
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
            'status' : editStatus,
            'label_marker_color' : label_marker_color,
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
               Swal.fire('Collection Area Updated','You clicked the button!','success').then((result) => {
                  if(result.isConfirmed) {
                     window.location.href = "{{route('index.collection')}}";
                  }
               });
            }
          },
         error: function(){
            swal.fire("Error Collectoin Update!", "Error in Update Collection Area error", "error").then((result) => {
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