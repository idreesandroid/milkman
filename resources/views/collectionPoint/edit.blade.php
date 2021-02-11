

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
            <h4 class="card-title mb-0">Edit Collection Point</h4>
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
            <form method="post"  action="{{ route('update.collectionPoint', $points->id) }}"  enctype="multipart/form-data" id="edit-product">
               @csrf 
               <div class="form-group row">
                  <label for="pointName" class="col-form-label col-md-2">Point Name</label>
                  <div class="col-md-6">
                     <input type="text" class="form-control"type="text" name="pointName"  value="{{$points->pointName}}" required=""  autocomplete="off">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="pointAddress" class="col-form-label col-md-2">Point Address</label>
                  <div class="col-md-6">
                     <input type="text" class="form-control"type="text" name="pointAddress"  value="{{$points->pointAddress}}" required=""  autocomplete="off">
                  </div>
               </div>
              
               <div class="form-group mb-0 row">
                  <div class="col-md-6">
                     <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Update Collection Point</button>
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

