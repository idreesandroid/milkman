

@extends('layouts.master')
@section('content')
 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>MilkMan Dashboard</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/">Permission</a></li>
                  <li class="breadcrumb-item active">List</li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->
<!-- Page Wrapper -->
<div class="row">
   <div class="col-sm-9">
      <div class="card mb-0">
         <div class="card-body">
         @can('Create-Permission')
            <div class="form-group mb-0 row">
               <div class="col-md-4">
                  <div class="input-group-append">
                     <a href="/permission/create" class="active"> <button class="btn btn-primary" type="button">Add Permission</button></a>
                     <br><br><br>
                  </div>
               </div>
            </div>
            @endcan
            <div class="table-responsive">
               <table class="datatable table table-stripped mb-0 datatables">
                  <thead>
                     <tr>
                        <th>Serial No</th>
                        <th>Permission Title</th>
                        <th>Permission Tag</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($permissions as $index => $permission)
                     <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$permission->name}}</td>
                        <td>{{$permission->slug}}</td>
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