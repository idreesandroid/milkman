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
                        <th>Vendor</th>
                        <th>Due Date & Time</th>
                        <th>Status</th>
                        <th style="text-align: center;">Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                  	@foreach($tasks as $task)
                     <tr id="taskId_{{$task->id}}">
                        <td>
                           <a href="#" class="text-decoration-none" data-toggle="modal">{{$task->collector_name}}</a>
                        </td>
                        <td><a href="#" data-toggle="modal" data-target="#system-user">{{$task->vendor_name}}</a></td>
                        <td>08, Jan 2021 9:30AM</td>
                        <td>
                        	@if($task->status == 'Missed')
                        	<label class="badge badge-gradient-danger">Missed</label>
                        	@elseif($task->status == 'Collected')
                        	<label class="badge badge-gradient-success">Collected</label>
                        	@elseif($task->status == 'Not Started')
                        	<label class="badge badge-gradient-info">Not Started</label>
                        	@endif

                        </td>
                        <td style="text-align: center;">
                           <a href="#" class="btn btn-primary">Start</a>
                           <a href="#" onclick="completeTask(<?php echo $task->id ?>)" class="btn btn-primary" data-toggle="modal" data-target="#completedtask">Complete</a>
                           <a href="#" onclick="taskDetail(<?php echo $task->id ?>)" class="btn btn-primary" data-toggle="modal" data-target="#taskDetial">Detail</a>
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
                              <option>collector name -- capacity</option>
                           	@foreach($collectors as $collector)
                              <option value="{{$collector->id}}">{{$collector->name}} -- 20kg</option>
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
                           		<input class="form-control" type="date" placeholder="MM/DD/YY" id="dueDate">
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
                           <input class="form-control" type="text" id="milkAmout" placeholder="Milk Amount in KG">
                           <input type="hidden" id="taskId">
                        </div>
                        <div class="col-sm-6">
                           <label class="col-form-label">Lactometer Reading</label>
                           <input class="form-control" type="text" id="lactometerReading" placeholder="Lactometer Reading">
                        </div>
                     </div>
                     <div class="form-group row">
                        <div class="col-sm-6">
                           <label class="col-form-label">Milk Taste</label>
                           <select class="form-control" id="milkTaste">
                              <option>Select the Taste you Observe</option>
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
                        <td>10:05 PM</td>
                     </tr>
                     <tr>
                        <td>End Time:</td>
                        <td>10:12 AM</td>
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
	var vendorID = $("#vendorID").val();
	var dueDate = $("#dueDate").val();
	var dueTime = $("#dueTime").val();
	var shift = $("#shift").val();
	var priority = $("#priority").val();
	jQuery.ajax({
	   url: "{{ route('store.task') }}",
	   type: "POST",
	   data: {
	         collector_id : collectorID,          
	         vendor_id : vendorID,          
	         duedate : dueDate,          
	         duetime  : dueTime,          
	         shift : shift,          
	         priority : priority,          
	         '_token' : "{{ csrf_token() }}"
	         },
	   success: function(response, status){
	   		jQuery('#completedtask').modal('hide');
	   		swal.fire("Done!", "Task Completed Succesfully!", "success");         
		   },
		error: function(){
			swal.fire("Error Completion Task!", "Task Completion error", "error");
		}
	});
}

function completeTask(taskId){
	$("#taskId").val(taskId);
	$("#milkAmout").val("");
	$("#lactometerReading").val("");
	$("#milkTaste").val("");	
}

function updateTask(){
var milkAmout =	$("#milkAmout").val();
var lactometerReading =	$("#lactometerReading").val();
var milkTaste =	$("#milkTaste").val();
var taskId =	$("#taskId").val();
jQuery.ajax({
   url: "{{ route('update.task') }}",
   type: "POST",
   data: {
         milkAmout: milkAmout,          
         lactometerReading: lactometerReading,          
         milkTaste: milkTaste,          
         taskId: taskId,          
         '_token' : "{{ csrf_token() }}"
         },
   success: function(response, status){
   		jQuery('#completedtask').modal('hide');
   		swal.fire("Done!", "Task Completed Succesfully!", "success");         
	   },
	error: function(){
		swal.fire("Error Completion Task!", "Task Completion error", "error");
	}
	});
}

function taskDetail(taskId){
	jQuery.ajax({
	   url: "{{ route('show.task') }}",
	   type: "POST",
	   data: {
	         id: taskId,
	         '_token' : "{{ csrf_token() }}"
	         },
	   	success: function(response, status){
		   	console.log(response);
		   	jQuery('#taskDetial').modal('show');
		   	$("#collectionName").text(response.collector_name);
		   	$("#taskStatus").text(response.status);
		   	$("#taskMilkAmount").text(response.milk_amout);
		   	$("#taskLactometerReading").text(response.lactometer_reading);
		   	$("#taskMilkTaste").text(response.milk_taste);
		   	$("#taskVendorName").text(response.vendor_name);
		   	$("#taskShift").text(response.shift);
		   	$("#collectorImage").attr("src","UserProfile/"+response.filenames);
		}
	});
}
</script>

@endsection