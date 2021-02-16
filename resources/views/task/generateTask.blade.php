@extends('layouts.master')
@section('content')
 <!-- Page Header -->
 <style type="text/css">
 a .badge {
    background: rgb(40, 195, 212);
    color: #fff;
}

 </style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.css"/>
 
<div class="crms-title row bg-white mb-4">
   <div class="col">
      <h3 class="page-title">
         <span class="page-title-icon bg-gradient-primary text-white mr-2">
         <i class="la la-table"></i>
         </span> <span>Task</span>
      </h3>
   </div>
   <div class="col text-right">
      <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
         <li class="breadcrumb-item"><a href="{{route('user.dashBoard')}}">Dashboard</a></li>
         <li class="breadcrumb-item active">Generate Task</li>
      </ul>
   </div>
</div>
<!-- /Page Header -->
<!-- Page Wrapper -->
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-body">
            <!-- <h6 class="card-title">Bottom line justified</h6> -->
            <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
               <li class="nav-item">
                  <a class="nav-link active" href="#morningtasks" data-toggle="tab">Morning <span class="badge badge-pill">{{count($morningTasks)}}</span></a></i> 
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#evening" data-toggle="tab">Evening <span class="badge badge-pill">{{count($eveningTasks)}}</span></a>
               </li>
            </ul>
            <div class="tab-content">  
                       
               <div class="tab-pane show active" id="morningtasks">
               <form method="post" method="post" action="{{ route('store.morning.task') }}">
               @csrf
                  <div class="row">
                                                  
                     <div class="col text-right">
                        <ul class="list-inline-item pl-0">
                           <li class="list-inline-item">
                              
                        <button class="btn btn-primary" type="submit">generate Morning Task</button>
                           </li>
                        </ul>
                     </div>
                                  
                  </div>  
                  <div class="table-responsive">
                     <table class="datatable table table-stripped mb-0 datatables" id="morningTable">
                     <thead>
                     <tr>   
                        <th><input type="checkbox" id="selectMor" onclick="allMorSelect()"> Check All</th>                   
                        <th>Area</th>
                        <th>Collector Name</th>
                        <th>Assign Type</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                        <tbody> 
                        @foreach($morningTasks as $morningTask)
                     <tr>
                        <td><input type="checkbox"  id="mor[{{ $morningTask->id }}]" name="morTask[{{ $morningTask->id }}]" class="checkEve" value="{{$morningTask->id}}"></td>
                        <td>{{$morningTask->title}}</td>
                        <td>{{$morningTask->name}}</td>
                        <td>{{$morningTask->assignType}}</td> 
                        <td> @if($morningTask->assignType == 'Permanent')<a href="{{ route('assign.temporary.task', $morningTask->collector_id)}}" class="btn btn-primary">Assign Temporary</a>@endif</td>      
                     </tr>
                     @endforeach
                        </tbody>
                     </table>                     
                  </div>
                  </form>
               </div>
          
                  <div class="tab-pane" id="evening">
                  <form method="post" method="post" action="{{ route('store.evening.task') }}">
               @csrf
                  <div class="row">
                                                   
                     <div class="col text-right">
                        <ul class="list-inline-item pl-0">
                           <li class="list-inline-item">
                           <button class="btn btn-primary" type="submit">generate Evening Task</button>
                           </li>
                        </ul>
                     </div>
                            
                  </div> 

                  <div class="table-responsive">
                     <table class="datatable table table-stripped mb-0 datatables" id="eveningTable">
                     <thead>
                     <tr>   
                        <th><input type="checkbox" id="selectEve" onclick="allEveSelect()"> Check All</th>                   
                        <th>Area</th>
                        <th>Collector Name</th>
                        <th>Assign Type</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                        <tbody>
                                               
                        @foreach($eveningTasks as $eveningTask)
                     <tr>
                        <td><input type="checkbox"  id="eve[{{$eveningTask->id}}]" name="eveTask[{{ $eveningTask->id }}]" class="checkEve" value="{{$eveningTask->id}}"></td>
                        <td>{{$eveningTask->title}}</td>
                        <td>{{$eveningTask->name}}</td>
                        <td>{{$eveningTask->assignType}}</td>
                        <td> @if($eveningTask->assignType == 'Permanent')<a href="{{ route('assign.temporary.task', $eveningTask->collector_id)}}" class="btn btn-primary">Assign Temporary</a>@endif</td>   
                     </tr>
                     @endforeach
                     
                        </tbody>
                     </table>                     
                  </div>
                  </form>
                  </div>
               
            </div>
         </div>
      </div>
   </div>
</div>
 <?php //exit(); ?>
<!-- /Page Wrapper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
   $(document).ready( function () {
      $('#morningTable').DataTable();
      $('#eveningTable').DataTable();
   });
</script>



<script type="text/javascript">
function allEveSelect() {
  
  $(".checkEve").attr("checked", true);
 
}

function allMorSelect() {
  
  $(".checkEve").attr("checked", true);
 
}

</script>
@endsection

