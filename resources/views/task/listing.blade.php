@extends('layouts.master')
@section('content')

<!-- Page Header -->
<div class="crms-title row bg-white mb-4">
   <div class="col">      
      <h3 class="page-title">
         <span class="page-title-icon bg-gradient-primary text-white mr-2">
         <i class="la la-table"></i>
         </span>Tasks Management
      </h3>
   </div>
   <div class="col p-0 text-right">
      <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
         <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
         <li class="breadcrumb-item active">Task Management</li>
      </ul>
   </div>
</div>


<div class="page-header  mb-0 ">
   <div class="row">
      <div class="col">
         <h3>All Tasks</h3>
      </div>
      <div class="col text-right">
         <ul class="list-inline-item pl-0">
            <li class="list-inline-item">
               <button class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" id="add-task" data-toggle="modal" data-target="#createCustomTask">Create Custom Task</button>
            </li>
         </ul>
      </div>
   </div>
</div>	

	<!-- /Page Header -->


	<!-- Content Starts -->

<div class="row m-0">
   <div class="col-md-12 grid-margin">
      <div class="">
         <div class="card-body p-0 row">
            <div class="table-responsive">
               <table class="table table-striped table-nowrap custom-table mb-0 datatable">
                  <thead>
                     <tr>
                        <th>Collector</th>
                        <th>Collection Area</th>   
                        <th style="text-align: center;">Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                  	@foreach($tasks as $task)
                     <tr id="taskId_{{$task->id}}">
                        <td>
                           <a href="{{ route('profile.user', $task->collector_id)}}" class="text-decoration-none">{{$task->collector_name}}</a>
                        </td>
                        <td>>{{$task->title}}</td>                        
                        <!-- <td><?php //echo date('d/m/Y h:i A', strtotime($task->duedate . ' '. $task->duetime)); ?>                           
                        </td> -->
                        <!-- <td>
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
                           <!-- <button href="#" id="start_task_<?php //echo $task->id ?>" class="btn btn-primary" onclick="startTask(<?php //echo $task->id ?>)" <?php //echo ($task->status != 'Not Started') ? 'disabled':''; ?> >Start</button>  -->
                           @endif
                           @if($task->status != 'Collected' && $task->status != 'Missed' && $task->status != 'Not Started')
                           <!-- <button href="#" onclick="completeTask(<?php //echo $task->id ?>)" class="btn btn-success" data-toggle="modal" data-target="#completedtask" <?php //echo ($task->status == 'Collected' || $task->status == 'Missed') ? 'disabled':''; ?>>Completed</button> -->
                           @endif
                           <button href="#" onclick="taskDetail(<?php echo $task->id ?>)" class="btn btn-info" data-toggle="modal" data-target="#taskDetial">Detail</button>
                           <!-- <button href="#" onclick="deleteTask(<?php //echo $task->id ?>)" class="btn btn-danger">Delete</button> -->
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




<!-- Modal -->




<div class="modal right fade" id="createCustomTask" tabindex="-1" role="dialog" aria-modal="true">
   <div class="modal-dialog" role="document">
      <button type="button" class="close md-close" data-dismiss="modal" aria-label="Close">
      	<span aria-hidden="true">&times;</span>
      </button>
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close xs-close" data-dismiss="modal">×</button>
            <div class="row w-100">
               <div class="col-md-7 account d-flex">
                  <div class="company_img">
                     <img src="assets/img/task.png" alt="User" class="user-image" class="img-fluid" />
                  </div>
                  <div>
                     <p class="mb-0">Task</p>
                     <span class="modal-title">Assign a custom Task</span>
                     <span class="rating-star"><i class="fa fa-star" aria-hidden="true"></i></span>
                     <span class="lock"><i class="fa fa-lock" aria-hidden="true"></i></span>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-12">
                  <form>
                     <h4>Create Custom Task</h4>
                     <div class="form-group row">
                        <div class="col-sm-6">
                           <label class="col-form-label">Collector<span class="text-danger">*</span>:</label>
                           <select class="form-control" id="collectorID">
                           	@foreach($collectors as $collector)
                              <option value="{{$collector->id}}">{{$collector->name}} -- 20 ltr</option>
                            @endforeach 
                           </select>
                        </div>
                        <div class="col-sm-6">
                           <label class="col-form-label">Vendor Name:</label>
                           <select class="form-control" id="vendorID">
                           	@foreach($vendors as $vendor)
                              <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                            @endforeach                              
                           </select>
                        </div>
                     </div>
                     <div class="form-group row">                        
                        <div class="col-sm-6">
                           <label class="col-form-label">
                           	Due Date<span class="text-danger">*</span>:
                           </label>
                           <div class="cal-icon">
                           		<input class="form-control" type="date" id="dueDate">
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <label class="col-form-label">
                           	Due Time <span class="text-danger">*</span>:
                           </label>
                           <div class="cal-icon">
                           		<input id="dueTime" class="form-control" type="time" placeholder="&#61442;">
                           </div>
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-sm-6">
                           <label class="col-form-label">Shift (Morning/Evening):</label>
                           <select class="form-control" id="shift">
                              <option value="morning">Morning</option>
                              <option value="evening">Evening</option>
                           </select>
                        </div>
                        <div class="col-sm-6">
                           <label class="col-form-label">Priority:</label>
                           <select class="form-control" id="priority">
                              <option value="low">Low</option>
                              <option value="medium">Medium</option>
                              <option value="high">High</option>
                           </select>
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-sm-6">
                           <label class="col-form-label">Collection Name:</label>
                           <select class="form-control" id="collectionID">
                              @foreach($collections as $collection)
                              <option value="{{$collection->id}}">{{$collection->title}}</option>
                            @endforeach                              
                           </select>
                        </div>                        
                     </div>
                     <div class="text-center py-3">
                        <button type="button" class="border-0 btn btn-primary btn-gradient-primary btn-rounded" onclick="createCustomTask()">Create Custom Task</button>&nbsp;&nbsp;
                        <button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal">Cancel</button>
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










<div class="modal right fade" id="completedtask" tabindex="-1" role="dialog" aria-modal="true">
   <div class="modal-dialog" role="document">
      <button type="button" class="close md-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close xs-close" data-dismiss="modal">×</button>
            <div class="row w-100">
               <div class="col-md-7 account d-flex">
                  <div class="company_img">
                     <img src="assets/img/task.png" alt="User" class="user-image" class="img-fluid" />
                  </div>
                  <div>
                     <p class="mb-0">Complete Task</p>
                     <span class="modal-title">After collection of Milk</span>
                     <span class="rating-star"><i class="fa fa-star" aria-hidden="true"></i></span>
                     <span class="lock"><i class="fa fa-lock" aria-hidden="true"></i></span>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-12">
                  <form>
                     <h4>Task Details</h4>
                     <div class="form-group row">
                        <div class="col-sm-6">
                           <label class="col-form-label">Milk Amount<span class="text-danger">*</span></label>
                           <input class="form-control" type="text" id="milkAmout">
                           <input type="hidden" id="taskId">
                        </div>
                        <div class="col-sm-6">  
                           <label class="col-form-label">Lactometer Reading</label>
                           <input class="form-control" type="text" id="lactometerReading">
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-sm-6">
                           <label class="col-form-label">Milk Taste</label>
                           <select class="form-control" id="milkTaste">
                              <option value="Poor">Poor</option>
                              <option value="Normal">Normal</option>
                              <option value="Good">Good</option>
                           </select>
                        </div>
                     </div>
                     <div class="text-center py-3">
                        <a class="border-0 btn btn-primary btn-gradient-primary btn-rounded" onclick="updateTask()">Save</a>&nbsp;&nbsp;
                        <button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal">Cancel</button>
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



<!--system users Modal -->

<div class="modal right fade" id="taskDetial" tabindex="-1" role="dialog" aria-modal="true">
   <div class="modal-dialog" role="document">
      <button type="button" class="close md-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close xs-close" data-dismiss="modal">×</button>
            <div class="row w-100">
               <div class="col-md-7 account d-flex">
                  <div class="company_img">
                     <img src="UserProfile/collector.jpg" alt="User" id="collectorImage" class="user-image img-fluid"/>
                  </div>
                  <div>
                     <p class="mb-0">Collector Name</p>
                     <span class="modal-title" id="collectionName">Idrees</span>
                     <span class="rating-star"><i class="fa fa-star" aria-hidden="true"></i></span>
                     <span class="lock"><i class="fa fa-lock" aria-hidden="true"></i></span>
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-body">
            <div class="task-infos">
               <table class="table">
                  <tbody>
                     <tr>
                        <td class="border-0">Vendor Name:</td>
                        <td class="border-0" id="taskVendorName">Kafeel Ahmed</td>
                     </tr>
                     <tr>
                        <td>Start Time:</td>
                        <td id="startedTime">10:05 PM</td>
                     </tr>
                     <tr>
                        <td>End Time:</td>
                        <td id="endTime">10:12 AM</td>
                     </tr>
                     <tr>
                        <td>Milk Taste:</td>
                        <td id="taskMilkTaste">Good</td>
                     </tr>
                     <tr>
                        <td>Lactometer Reading:</td>
                        <td id="taskLactometerReading">30</td>
                     </tr>
                     <tr>
                        <td>Milk Amount:</td>
                        <td id="taskMilkAmount">50kg</td>
                     </tr>
                     <tr>
                        <td>Priority:</td>
                        <td id="taskPriority">High</td>
                     </tr>
                     <tr>
                        <td>Shift:</td>
                        <td id="taskShift">High</td>
                     </tr>
                     <tr>
                        <td>Status:</td>
                        <td id="taskStatus">Collected</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <!-- modal-content -->
   </div>
   <!-- modal-dialog -->
</div>
<!-- modal -->


<script type="text/javascript">
function createCustomTask(){
	var collectorID = $("#collectorID").val();

   if(!collectorID.length){
      $("#collectorID").focus();
      alert('Please select the collector');            
      return false;
   } 
	var vendorID = $("#vendorID").val();

   if(!vendorID.length){
      $("#vendorID").focus();
      alert('Please select the vendor');            
      return false;
   }

   var collectionID = $("#collectionID").val();
   if(!collectionID.length){
      $("#collectionID").focus();
      alert('Please select the collection');            
      return false;
   }
	var dueDate = $("#dueDate").val();

   if(!dueDate.length){
      $("#dueDate").focus();
      alert('Please select the Due Date');            
      return false;
   }
	var dueTime = $("#dueTime").val();

   if(!dueTime.length){
      $("#dueTime").focus();
      alert('Please select the Due Time');            
      return false;
   }
	var shift = $("#shift").val();

   if(!shift.length){
      $("#shift").focus();
      alert('Please select the shift');            
      return false;
   }
	var priority = $("#priority").val();

   if(!priority.length){
      $("#priority").focus();
      alert('Please select the priority');            
      return false;
   } 


	jQuery.ajax({
	   url: "{{ route('store.task') }}",
	   type: "POST",
	   data: {
	         collector_id : collectorID,          
	         vendor_id : vendorID,          
            collectionID : collectionID,          
	         duedate : dueDate,          
	         duetime  : dueTime,          
	         shift : shift,          
	         priority : priority,          
	         '_token' : "{{ csrf_token() }}"
	         },
	   success: function(response, status){
	   		jQuery('#createCustomTask').modal('hide');
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

function taskDetail(taskID){
	jQuery.ajax({
	   url: "{{ route('show.task') }}",
	   type: "POST",
	   data: {
	         id: taskID,
	         '_token' : "{{ csrf_token() }}"
	         },
	   	success: function(response, status){
		   	jQuery('#taskDetial').modal('show');
		   	$("#collectionName").text(response.collector_name);
		   	$("#taskStatus").text(response.status);
            if(response.milk_amout){
		   	   $("#taskMilkAmount").text(response.milk_amout+' ltr');
            }else{
               $("#taskMilkAmount").text(response.milk_amout);
            }
		   	$("#taskLactometerReading").text(response.lactometer_reading);
		   	$("#taskMilkTaste").text(response.milk_taste);
		   	$("#taskVendorName").text(response.vendor_name);
		   	$("#taskShift").text(response.shift);
            if(response.starttime){
            starttime = new Date(response.starttime)
            var start_time = moment(starttime, 'DD MMM YYYY - hh:mm a').format('DD-MM-YYYY hh:mm:ss a');          
            $("#startedTime").text(start_time);
            }else{
            $("#startedTime").text(response.endtime);

            }
            if(response.endtime){
               endtime = new Date(response.endtime)
               var end_time = moment(endtime, 'DD MMM YYYY - hh:mm a').format('DD-MM-YYYY hh:mm:ss a');
            $("#endTime").text(end_time);
            }else{
            $("#endTime").text(response.endtime);

            }
		   	$("#collectorImage").attr("src","UserProfile/"+response.filenames);
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