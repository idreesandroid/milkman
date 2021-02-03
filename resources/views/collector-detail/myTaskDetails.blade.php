@extends('layouts.master')
@section('content')
 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>My Task</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/DashBoard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Task List</li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->
<!-- Page Wrapper -->
<div class="row">
   <div class="col-sm-12">
      <div class="card mb-0">
         <div class="card-body">           
            <div class="table-responsive">
            <table class="table table-striped table-nowrap custom-table mb-0 datatable">
                  <thead>
                     <tr>
                        <th>Vendor</th>
                        <th>Status</th>
                        <th>Shift</th>
                        <th>Collection Date</th>
                        <th>collected Milk</th> 
                        <th>ScreenShot</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($taskDetails as $taskDetail)
                     <tr>
                        <td>{{$taskDetail->name}}</td>
                        <td>{{$taskDetail->status}}</td>
                        <td>{{$taskDetail->taskShift}}</td>                                               
                        <td>{{timeFormat($taskDetail->collection_date)['date']}}</td>                        
                        <td>@if(isset($taskDetail->milkCollected)){{$taskDetail->milkCollected}} Ltr @endif</td>
                        <td>@if(isset($taskDetail->qualityPic))<img src="{{asset('/milkQuality_img/'.$taskDetail->qualityPic)}}" alt="Logo" width="50" height="60" class="img-thumbnail">@endif</td>                                              
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- /Page Wrapper -->
@endsection

