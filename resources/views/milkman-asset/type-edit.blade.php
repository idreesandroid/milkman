

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
                  <li class="breadcrumb-item active">Update</li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-header">
            <h4 class="card-title mb-0">Edit Type</h4>
         </div>
         <div class="card-body">
         @if ($errors->any())
         <div class="alert alert-danger">
            <ul>
               @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
         @endif
            <form method="post"  action="{{ route('update.type', $Types->id) }}"   id="edit-type">
               @csrf 
               <div class="form-group row">
                  <label for="typeName" class="col-form-label col-md-2">Type Name</label>
                  <div class="col-md-6">
                     <input type="text" class="form-control"type="text" name="typeName"  value="{{ $Types->typeName }}" required=""  autocomplete="off">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="assetUnit" class="col-form-label col-md-2">Type Unit</label>
                  <div class="col-md-6">
                     <input type="text" class="form-control"type="text" name="assetUnit"  value="{{ $Types->assetUnit }}" required=""  autocomplete="off">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="description" class="col-form-label col-md-2">Description</label>
                  <div class="col-md-6">
                     <input type="text" class="form-control"type="text" name="description"  value="{{ $Types->description }}" required=""  autocomplete="off">
                  </div>
               </div>
              
               <div class="form-group mb-0 row">
                  <div class="col-md-6">
                     <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Update Type</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- /page Wrapper -->

@endsection

