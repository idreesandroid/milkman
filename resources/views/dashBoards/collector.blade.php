@extends('layouts.master')

@section('content')



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
   <div class="card" style="width: 18rem;">
  <div class="card-body">
<a href="#"> <h5 class="card-title">My Tasks</h5></a>
  <ul>
  <li><h2 class="card-title">Total Task: {{$totalTask}}</h2></li>
  <li><h2 class="card-title">Completed Task: {{$taskCompleted}}</h2></li>
  </ul>
    <!-- <a href="{{route('my.transaction')}}" class="card-link">My Transaction</a> -->
  </div>
</div>	

<div class="card" style="width: 18rem;">
  <div class="card-body">
<a href="#"> <h5 class="card-title">New Tasks</h5></a>
  <ul>
  <li><h2 class="card-title">Morning Task: {{$myMorningTask}}</h2></li>
  <li><h2 class="card-title">Evening Task: {{$myEveningTask}}</h2></li>
  </ul>
    <!-- <a href="{{route('my.transaction')}}" class="card-link">My Transaction</a> -->
  </div>
</div>	


      <div class="">
         <div class="card-body p-0 row">
            <div class="table-responsive">
               <table class="table table-striped table-nowrap custom-table mb-0 datatable">
                  <thead>
                     <tr>
                        <th>Vendor</th>
                        <th>Area</th>
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
                    
                        <td>{{$task->name}}</td>
                        <td>{{$task->title}}</td>                        
                        <td>{{$task->lactometer_reading}}</td>                        
                        <td>{{$task->milk_amout}}</td>                        
                        <td>{{$task->milk_taste}}</td>                        
                        <td>{{$task->shift}}</td>                        
                        <td>@if(isset($task->starttime)){{timeFormat($task->starttime)['time']}}@endif</td>                        
                        <td>@if(isset($task->endtime)){{timeFormat($task->endtime)['time']}}@endif</td>                        
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

function completeTask(taskID){
	$("#taskId").val(taskID);
	$("#milkAmout").val("");
	$("#lactometerReading").val("");
	$("#milkTaste").val("");	
}

function updateTask(){
   var milkAmout =	$("#milkAmout").val();
   if(!milkAmout.length){
      $("#milkAmout").focus();
      alert('Please add the Milk Amout');            
      return false;
   } 
   var lactometerReading =	$("#lactometerReading").val();

   if(!lactometerReading.length){
      $("#lactometerReading").focus();
      alert('Please add the Lactometer Reading');            
      return false;
   } 

   var milkTaste = $( "#milkTaste option:selected" ).text();

   if(!milkTaste.length || milkTaste === 'undefined'){
      $("#milkTaste").focus();
      alert('Please add the milk taste');            
      return false;
   } 
   var taskID =	$("#taskId").val();

   if(!taskID.length){
      $("#taskID").focus();
      alert('Please select the task');
      return false;           
   }

   jQuery.ajax({
      url: "{{ route('update.task') }}",
      type: "POST",
      data: {
            milkAmout: milkAmout,          
            lactometerReading: lactometerReading,          
            milkTaste: milkTaste,          
            taskId: taskID,          
            '_token' : "{{ csrf_token() }}"
            },
      success: function(response, status){
      		jQuery('#completedtask').modal('hide');
      		swal.fire("Done!", "Task Completed Succesfully!", "success").then((result) => {
               if(result.isConfirmed) {
                  location.reload(true);
               }
            });         
   	   },
   	error: function(){
   		swal.fire("Error Completion Task!", "Task Completion error", "error").then((result) => {
            if(result.isConfirmed) {
               location.reload(true);
            }
         });
   	}
	});
}



function startTask(taskID){
   jQuery.ajax({
      url: "{{ route('start.task') }}",
      type: "POST",
      data: {
            id: taskID,
            '_token' : "{{ csrf_token() }}"
            },
         success: function(response, status){
            jQuery('#start_task_'+taskID).prop("disabled",true);
            swal.fire("Started!", "Task Started Succesfully!", "success").then((result) => {
               if(result.isConfirmed) {
                  location.reload(true);
               }
            }); 
         },
         error: function(){
            swal.fire("Error Started Task!", "Task Started error", "error").then((result) => {
               if(result.isConfirmed) {
                  location.reload(true);
               }
            });
         }
   });
}


function deleteTask(taskID){
   swal.fire({
         title: 'Are you sure?',
         text: "You won't be able to revert this task!",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes, delete it!'
     }).then((result) => {
         if (result.isConfirmed) {
             jQuery.ajax({
                 url: "{{ route('destroy.task') }}",
                 type: "POST",
                 data: {
                     id: taskID,
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
</script>

@endsection