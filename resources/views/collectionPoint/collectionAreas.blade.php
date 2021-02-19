@extends('layouts.master')
@section('content')
 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>Collection Point</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/Dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Collector List</li>
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
                        <th>Area Title</th>
                        <th>Collector</th>
                        <th>Type</th>
                        <th>Shift</th>
                        <th>Capacity</th>
                        <th>Area Status</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($collectionPoints as $collectionPoint)
                     <tr>
                         <td>{{$collectionPoint->title}}</td>
                        <td>{{$collectionPoint->name}}</td>
                        <td>{{$collectionPoint->assignType}}</td> 
                        <td>{{$collectionPoint->shift}}</td>
                        <td></td> 
                        <td>{{$collectionPoint->areaStatus}}</td>
                         
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

