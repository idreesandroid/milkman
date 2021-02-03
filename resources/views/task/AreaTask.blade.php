@extends('layouts.master')
@section('content')
 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>Collection Area</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/DashBoard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Area List</li>
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
                        <th>Shift</th>
                        <th>Assign To</th>
                        <th>Task Completed</th>
                        <th>Task Expired</th>
                        @can('See-Collection-Against-Area')   <th>Action</th> @endcan
                     </tr>
                  </thead>
                  <tbody>
                  @foreach($arrangedArray as $arrangedArrays)
                     <tr>
                        <td>{{$arrangedArrays['areaTitle']}}</td>
                        <td>{{$arrangedArrays['areashift']}}</td>
                        <td>{{$arrangedArrays['collectorName']}}</td>
                        <td>{{$arrangedArrays['taskCo']}}</td>
                        <td>{{$arrangedArrays['taskEx']}}</td>   
                      @can('See-Collection-Against-Area')  <td><a href="{{ route('area.detail', $arrangedArrays['id'])}}" class="btn btn-primary">Detail</a></td>@endcan
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

