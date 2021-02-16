@extends('layouts.master')
@section('content')
 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>Distributor</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/Dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Distributor List</li>
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
               <table class="datatable table table-stripped mb-0 datatables">
                  <thead>
                     <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Morning</th>
                        <th>Evening</th>
                        <th>Capacity</th>
                        <th>Contact</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($collectorDetails as $collectorDetail)
                     <tr>
                        <td><img alt="" class="profile-img" src="{{asset('/UserProfile/'.$collectorDetail->filenames)}}"></td>
                        <td><a href="{{ route('profile.user', $collectorDetail->id)}}" title="View Profile" >{{$collectorDetail->name}}</a></td>
                        <td>{{$collectorDetail->collectorMorStatus}}</td>
                        <td>{{$collectorDetail->collectorEveStatus}}</td>
                        <td>{{$collectorDetail->collectorCapacity}}</td> 
                        <td>{{$collectorDetail->user_phone}}</td>
                        <td>@if($collectorDetail->collectorMorStatus == 'Leave'||$collectorDetail->collectorEveStatus == 'Leave') <a href="{{ route('activate.collector', $collectorDetail->id)}}" class="btn btn-primary">Activate</a>@endif</td> 
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

