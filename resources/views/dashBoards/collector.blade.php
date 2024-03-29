@extends('layouts.master')

@section('content')
<div class="crms-title row bg-white mb-4">
   <div class="col  p-0">
      <div></div>
      <h3 class="page-title">
         <span class="page-title-icon bg-gradient-primary text-white mr-2">
         <i class="la la-table"></i>
         </span>Collector Dashboard
      </h3>
   </div>
   <div class="col p-0 text-right">
      <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
         <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
         <li class="breadcrumb-item active">Collector Dashboard</li>
      </ul>
   </div>
</div>
 <div class="row">
   <div class="col-sm-3">
      <div class="info-box">
         <span class="info-box-icon bg-yellow"><i class="fa fa-calendar-check-o"></i></span>
         <div class="info-box-content" > 
          <span class="info-box-text">
            Total Tasks
          </span>
          <span class="count">{{$totalTask}}</span>
         </div>
      </div>
   </div>
   <div class="col-sm-3">
      <div class="info-box">
         <span class="info-box-icon bg-yellow"><i class="fa fa-check-square-o"></i></span>
         <div class="info-box-content" > 
          <span class="info-box-text">Total Completed Tasks</span>
          <span class="count">{{$taskCompleted}}</span>
         </div>
      </div>
   </div>
   <div class="col-sm-3">
      <div class="info-box">
         <span class="info-box-icon bg-yellow"><i class="fa fa-check-circle"></i></span>
         <div class="info-box-content" >
          <span class="info-box-text">
            Today's Morning Tasks
          </span>
          <span class="count">{{$myMorningTask}}</span>
         </div>
      </div>
   </div>
   <div class="col-sm-3">
      <div class="info-box">
         <span class="info-box-icon bg-yellow"><i class="fa fa-check-circle-o"></i></span>
         <div class="info-box-content" >
          <span class="info-box-text">
            Today's Evening Tasks
          </span>
          <span class="count">{{$myEveningTask}}</span>
         </div>
      </div>
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
                     <th>Vendor Location</th>
                     <th>Shift</th>
                     <th>Status</th>
                     <th>Expected Milk Quantity</th>
                     <th>Expected Collection Time</th>
                     @can('Start-Task')  
                     <th>Actions</th>
                     @endcan
                  </tr>
               </thead>
               <tbody>
                  <span style="display: none;" id="location"></span>
                  @foreach($newTasks as $task)
                  <tr id="taskId_">
                     <td>{{$task->name}}</td>
                     <td><a href="#" onclick="redirectToGoogleMap(<?php echo $task->latitude.','. $task->longitude?>);" id>
                        Google Map Direction</a>
                     </td>
                     <td>{{$task->taskShift}}</td>
                     <td>{{$task->status}}</td>
                     <td>@if($task->taskShift == 'Morning'){{$task->morning_decided_milkQuantity}}@endif @if($task->taskShift == 'Evening'){{$task->evening_decided_milkQuantity}}@endif</td>
                     <td>@if($task->taskShift == 'Morning'){{timeFormat($task->morningTime)['time']}}@endif @if($task->taskShift == 'Evening'){{timeFormat($task->eveningTime)['time']}}@endif</td>
                     @can('Start-Task') 
                     <td>@if($task->status == 'initialize')<a href="{{ route('task.start', $task->id)}}" class="btn btn-primary">Start</a>@endif  @if($task->status == 'inProcess')<button type="button" class=" form-control btn btn-sm btn-primary btn-info btn-lg" onclick="setId({{$task->id}})" data-toggle="modal" data-target="#taskComplete">Complete</button>@endif</td>
                     @endcan 
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
         <div id="taskComplete" class="modal fade" role="dialog">
            <div class="modal-dialog" id="batch-info">
               <!-- Modal content-->
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="table-responsive">
                              <form method="post" action="{{ route('task.complete')}}"  enctype="multipart/form-data" >
                                 @csrf 
                                 <input type="hidden" name="req_id" id="req_id" value="">
                                 <div class="form-group row">
                                    <label for="milkCollected" class="col-form-label col-md-4">Milk Quantity</label>
                                    <div class="col-md-8">
                                       <input type="numeric" class="form-control" name="milkCollected" required="" autocomplete="off">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label for="fat" class="col-form-label col-md-4">Fat</label>
                                    <div class="col-md-8">
                                       <input type="numeric" class="form-control" name="fat" required="" autocomplete="off">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label for="Lactose" class="col-form-label col-md-4">Lactose</label>
                                    <div class="col-md-8">
                                       <input type="numeric" class="form-control" name="Lactose" required="" autocomplete="off">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label for="Ash" class="col-form-label col-md-4">Ash</label>
                                    <div class="col-md-8">
                                       <input type="numeric" class="form-control" name="Ash" required="" autocomplete="off">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label for="totalProteins" class="col-form-label col-md-4">Total Proteins</label>
                                    <div class="col-md-8">
                                       <input type="numeric" class="form-control" name="totalProteins" required="" autocomplete="off">
                                    </div>
                                 </div>
                                 <div class="form-group row">
                                    <label for="qualityPic" class="col-form-label col-md-4">Test Result</label>
                                    <div class="col-md-8">
                                       <input type="file" class="form-control" name="qualityPic"  required=""  autocomplete="off" >
                                    </div>
                                 </div>
                                 @can('Complete-Task') <button type="submit" value="ad_bat"  class=" form-control btn btn-primary btn-info btn-lg " >Submit Milk Report</button>@endcan
                              </form>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="table-responsive">
                              <table class="datatable table table-stripped mb-0">
                                 <thead>
                                    <tr>
                                       <th>Standards</th>
                                       <th>Fat</th>
                                       <th >Lactose</th>
                                       <th>Ash</th>
                                       <th>Proteins</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr style="background-color:#60b760;">
                                       <td>Good</td>
                                       <td>&gt1.8</td>
                                       <td >&gt1.5</td>
                                       <td>&gt2.5</td>
                                       <td>&gt2</td>
                                    </tr>
                                    <tr style="background-color:yellow;">
                                       <td>Average</td>
                                       <td>1</td>
                                       <td >1.5</td>
                                       <td>2</td>
                                       <td>1.5</td>
                                    </tr>
                                    <tr style="background-color:#e25353;">
                                       <td>Poor</td>
                                       <td>&lt1</td>
                                       <td >&lt0.9</td>
                                       <td>&lt2</td>
                                       <td>&lt1.5</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
$(document).ready(function() {  
  $('.count').each(function () {
      $(this).prop('Counter',0).animate({
          Counter: $(this).text()
      }, {
          duration: 4000,
          easing: 'swing',
          step: function (now) {
              $(this).text(Math.ceil(now));
          }
      });
  });
});



    var msg = '{{Session::get('alert')}}';  
    var exist = '{{Session::has('alert')}}';
    if(exist)
            {
      if(msg == 1){     
      Swal.fire(
               'Milk Quality is Fine',
               'You Can Collect Milk!',
               'success'
               );
                  }
    else if (msg == 0){
      Swal.fire(
               'Milk Quality is Low',
               'Do Not Collect Milk!',
               'error'
               );
                  }
            }


function setId(id)
{
$("#req_id").val(id);
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
window.onload = function() {
  getLocation();
};

var x = document.getElementById("location");
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  x.innerHTML = position.coords.latitude +"," + position.coords.longitude;
}


//Direction For google--------------------

function redirectToGoogleMap(lat,lng){
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
  var googleUrl = 'https://www.google.com/maps/dir/'+$("#location").text()+'/'+lat+','+lng;

  window.open(googleUrl, '_blank');
}
</script>

@endsection