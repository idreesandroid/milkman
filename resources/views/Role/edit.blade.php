

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
                  <li class="breadcrumb-item active">Update</li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->
         
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-header">
            <h4 class="card-title mb-0">Edit Role</h4>
         </div>
         <div class="card-body">
            <form method="post"  action="{{ route('update.role', $roles->id) }}">
               @csrf 
               <div class="form-group row">
                  <label for="name" class="col-form-label col-md-2">Role Name</label>
                  <div class="col-md-6">
                     <input type="text" class="form-control"type="text" name="name"  value="{{ $roles->name }}" required=""  autocomplete="off">
                  </div>
               </div>
               @foreach($permissions as $permission)
               <div class="col-sm-3">
                  <label class="checkbox-inline "for="permissionName[{{ $permission->id }}]">
                  <input id="perm[{{ $permission->id }}]" name="permissionName[{{ $permission->id }}]" type="checkbox" value="{{ $permission->id }}"
                  @if($roles->permissions->contains($permission->id)) checked=checked @endif
                  > {{ $permission->name }}
                  </label>
               </div>
               @endforeach                    
                <div class="col-md-6">                           
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Update Role</button>
                    </div>                           
                </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- /page Wrapper -->
@endsection

