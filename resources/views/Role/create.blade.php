

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
                  <li class="breadcrumb-item"><a href="/">Role</a></li>
                  <li class="breadcrumb-item active">Add</li>
               </ul>
            </div>
         </div>
         
<form method="post"  class="splash-container">
   @csrf 
   <div class="card">
      <div class="card-header">
         <h3 class="mb-1">Add Role</h3>
         <div class="form-group row">
            <label for="name" class="col-form-label col-md-2">Role Title</label>
            <div class="col-md-4">
               <input type="text" class="form-control" name="name" required="">
            </div>
         </div>
      </div>
      <div class="form-group">
         @foreach ($permissions as $permission)
         <input type="checkbox"  id="permission" name="permissionName[]" value="{{ $permission->id}}">
         <label class="checkbox-inline" for="permissionName[]">{{$permission->name}}</label>
         @endforeach   
      </div>
      <div class="form-group pt-2">
         <button class="btn btn-block btn-primary" type="submit">Add Role</button>
      </div>
   </div>
   </div>   
</form>
@endsection

