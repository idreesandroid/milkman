

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
            <h4 class="card-title mb-0">Edit Asset</h4>
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
            <form method="post"  action="{{ route('update.asset', $Assets->id) }}"   id="edit-type">
               @csrf 

               <div class="form-group row">
                  <label for="type_id" class="col-form-label col-md-2">Asset Type</label>
                  <div class="col-md-4">
                     <?php $showValue = $Assets->type_id; ?>
                     <select class="form-control" name="type_id" required="" autocomplete="off">
                        <option value="">--Type Name--</option>
                        @foreach ($types as $type)
                        <option value="{{ $type->id}}" <?php echo ($showValue == $type->id) ? 'selected' : '' ?>>{{ $type->typeName}}</option>
                        @endforeach                            
                     </select>
                  </div>
               </div>  
            
               <div class="form-group row">
                  <label for="assetName" class="col-form-label col-md-2">Name</label>
                  <div class="col-md-6">
                     <input type="text" class="form-control"type="text" name="assetName"  value="{{$Assets->assetName}}" required=""  autocomplete="off">
                  </div>
               </div>

               <div class="form-group row">
                  <label for="assetCapacity" class="col-form-label col-md-2">Capacity</label>
                  <div class="col-md-6">
                     <input type="text" class="form-control"type="text" name="assetCapacity"  value="{{$Assets->assetCapacity}}" required=""  autocomplete="off">
                  </div>
               </div>
              
               <div class="form-group mb-0 row">
                  <div class="col-md-6">
                     <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Update Asset</button>
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

