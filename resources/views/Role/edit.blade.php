

@extends('layouts.master')
@section('content')
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

