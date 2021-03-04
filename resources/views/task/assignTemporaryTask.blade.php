

@extends('layouts.master')
@section('content')
 <!-- Page Header -->
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
                  <li class="breadcrumb-item"><a href="/DashBoard">Dashboard</a></li>
                  <li class="breadcrumb-item active"Task List></li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->

<!-- Page Wrapper -->
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-header">
            <h4 class="card-title mb-0">Task List</h4>
         </div>
         <div class="card-body">
         @if ($errors->any())
         @foreach ($errors->all() as $error)
         <div>{{$error}}</div>
         @endforeach
         @endif
            <form method="post" action="{{ route('store.temporary.task') }}" >
               @csrf 
         <input type="hidden" name="oldCollector" value="{{$collectorId}}">

               <div class="table-responsive">
               <table class="datatable table table-stripped mb-0 datatables">
                  <thead>
                     <tr>
                        <th>Area Name</th>
                        <th>Shift</th>
                        <th>From</th>
                        <th>Till</th>
                        <th>Select Collector</th>
                     </tr>
                  </thead>
                  <tbody>
                  @foreach($findTasks as $findTask)
                     <tr>
                        <input type="hidden" name="area_id[]" value="{{$findTask->area_id}}">
                        <input type="hidden" name="collector[]" value="{{$findTask->collector_id}}">
                        <input type="hidden" name="shifts[]" value="{{$findTask->shift}}">
                        <td>{{$findTask->title}}</td>
                        <td>{{$findTask->shift}}</td>
                        <td><input type='date' class="form-control" name="fromDate[]" required="" autocomplete="off"></td>
                        <td><input type='date' class="form-control" name="endDate[]" required="" autocomplete="off"></td>
                        
                       @if($findTask->shift == 'Morning')
                        <td>
                           <div class="form-group row">
                           <div class="col-md-12">
                           <select class="form-control" name="new_collector_id[]" required="" autocomplete="off">
                           <option value="">--Select Collector--</option>
                           @foreach ($morningCollectors as $collectorM)
                           <option value="{{ $collectorM->id}}" >{{ $collectorM->name}}</option>
                           @endforeach                            
                           </select>
                           </div>
                           </div>
                        </td>
                        @endif
                        
                        @if($findTask->shift == 'Evening')
                        <td>
                           <div class="form-group row">
                           <div class="col-md-12">
                           <select class="form-control" name="new_collector_id[]" required="" autocomplete="off">
                           <option value="">--Select Collector--</option>
                           @foreach ($eveningCollectors as $collectorE)
                           <option value="{{ $collectorE->id}}" >{{ $collectorE->name}}</option>
                           @endforeach                            
                           </select>
                           </div>
                           </div>
                        </td>
                        @endif
                     </tr> 
                  @endforeach     
                  </tbody>
               </table>
            </div>
          
               <div class="form-group mb-0 row">
                  <div class="col-md-4">
                     <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Select Collector</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- /page Wrapper -->

<script>
  
</script>
@endsection