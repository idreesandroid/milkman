@extends('layouts.master')
@section('content')
 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>Asset</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/DashBoard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Asset Type</li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->
<!-- Page Wrapper -->
<div class="row">
   <div class="col-sm-12">
      <div class="card mb-0">
         <div class="card-body">
            @can('Create-Asset-Type')
            <div class="form-group mb-0 row">
               <div class="col-md-4">
                  <div class="input-group-append">
                     <a href="{{ route('create.type')}}" class="active"> <button class="btn btn-primary" type="button">Add Type</button></a>
                  </div>
               </div>
            </div>
            @endcan
            
            <div class="table-responsive">
               <table class="datatable table table-stripped mb-0 datatables">
                  <thead>
                     <tr>
                        <th>Name</th>
                        <th>Unit</th>
                        <th>Description</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($assetTypes as $assetType)
                     <tr>
                        
                        <td>{{$assetType->typeName}}</td>
                        <td>{{$assetType->assetUnit}} </td>
                        <td>{{$assetType->description}}</td>
                        <td>
                           <a href="{{ route('edit.type', $assetType->id)}}" class="btn btn-primary">Edit</a>
                           <form action="{{ route('delete.type', $assetType->id)}}" method="post" style="display: inline-block">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                           </form>
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
<!-- /Page Wrapper -->
@endsection

