

@extends('layouts.master')
@section('content')
<!-- Page Wrapper -->
<div class="row">
   <div class="col-sm-9">
      <div class="card mb-0">
         <div class="card-body">
            @can('Create-Role')
            <div class="form-group mb-0 row">
               <div class="col-md-4">
                  <div class="input-group-append">
                     <a href="/role/create" class="active"> <button class="btn btn-primary" type="button">Add Role</button></a>
                  </div>
               </div>
            </div>
            @endcan
            <div class="table-responsive">
               <table class="datatable table table-stripped mb-0 datatables">
                  <thead>
                     <tr>
                        <th>Serial No</th>
                        <th>Role Title</th>
                        <th>Role Tag</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($roles as $index => $role)
                     <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$role->name}}</td>
                        <td>{{$role->slug}}</td>
                        <td>
                           @can('Edit-Role')
                           <a href="{{ route('edit.role', $role->id)}}" class="btn btn-primary">Edit</a>
                           @endcan
                           @can('Delete-Role')
                           <form action="{{ route('delete.role', $role->id)}}" method="post" style="display: inline-block">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                           </form>
                           @endcan
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

