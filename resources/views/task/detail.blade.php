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
      <div class="">
         <div class="card-body p-0 row">
            <div class="table-responsive">
               <table class="table table-striped table-nowrap custom-table mb-0 datatable">
                  <thead>
                     <tr>
                        <th>Vendor</th>
                        <th>Collector</th>
                        <th>Lactometer</th>
                        <th>Amount</th>   
                        <th>Taste</th>   
                        <th>Shift</th>   
                        <th>Start</th>   
                        <th>End</th>   
                        <th>Status</th>   
                        <th style="text-align: center;">Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($tasks as $task)
                     <tr id="taskId_">
                        <td>
                           <a href="" class="text-decoration-none">{{$task->vendor_name}}</a>
                        </td>
                        <td>{{$task->collector_name}}</td>                        
                        <td>{{$task->lactometer_reading}}</td>                        
                        <td>{{$task->milk_amout}}</td>                        
                        <td>{{$task->milk_taste}}</td>                        
                        <td>{{$task->shift}}</td>                        
                        <td>{{$task->starttime}}</td>                        
                        <td>{{$task->endtime}}</td>                        
                        <td>{{$task->status}}</td>                        
                        <!-- <td><?php //echo date('d/m/Y h:i A', strtotime($task->duedate . ' '. $task->duetime)); ?>                           
                        </td> -->
                        <!-- 
                        <td>

                           @if($task->status == 'Missed')
                           <label class="badge badge-gradient-danger">Missed</label>
                           @elseif($task->status == 'Collected')
                           <label class="badge badge-gradient-success">Collected</label>
                           @elseif($task->status == 'Not Started')
                           <label class="badge badge-gradient-warning">Not Started</label>
                           @elseif($task->status == 'Started')
                           <label class="badge badge-gradient-info">Started</label>
                           @endif


                        </td> -->
                        <td style="text-align: center;">
                           
                           @if($task->status == 'Not Started')                      
                            <button href="#" id="start_task_<?php echo $task->id ?>" class="btn btn-primary" onclick="startTask(<?php echo $task->id ?>)" <?php echo ($task->status != 'Not Started') ? 'disabled':''; ?> >Start</button>  
                           @endif
                           @if($task->status != 'Collected' && $task->status != 'Missed' && $task->status != 'Not Started')
                            <button href="#" onclick="completeTask(<?php echo $task->id ?>)" class="btn btn-success" data-toggle="modal" data-target="#completedtask" <?php echo ($task->status == 'Collected' || $task->status == 'Missed') ? 'disabled':''; ?>>Completed</button> 
                           @endif                                                 
                           

                            <button href="#" onclick="deleteTask(<?php echo $task->id ?>)" class="btn btn-danger">Delete</button> 

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