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
                  <li class="breadcrumb-item active">Add Asset</li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->
<!-- Page Wrapper -->
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-header">
            <h4 class="card-title mb-0">Add Asset</h4>
         </div>
         <div class="card-body">
         @if ($errors->any())
     @foreach ($errors->all() as $error)
         <div>{{$error}}</div>
     @endforeach
      @endif
            <form method="post" action="{{ route('store.asset') }}"  id="type">
               @csrf 
               <div class="form-group row">
                  <label for="type_id" class="col-form-label col-md-2">Asset Type</label>
                  <div class="col-md-4">
                     <select class="form-control" name="type_id" required="" autocomplete="off">
                        <option value="">--Asset Type--</option>
                        @foreach ($types as $type)
                        <option value="{{ $type->id}}" >{{ $type->typeName}}</option>
                        @endforeach                            
                     </select>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="assetCapacity" class="col-form-label col-md-2">Asset Capacity</label>
                  <div class="col-md-4">
                     <input type="number" class="form-control" name="assetCapacity" required="" min="0" autocomplete="off">
                  </div>
               </div>

               <div class="form-group mb-0 row">
                  <div class="col-md-10">
                     <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Add Asset</button>
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

