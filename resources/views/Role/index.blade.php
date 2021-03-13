@extends('layouts.master')
@section('content')

 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>Role</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/DashBoard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Role List</li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->
<div class="page-header  mb-0 ">
   <div class="row">
      <div class="col">
         <h3>Roles</h3>
      </div>
      @can('Create-Role')
      <div class="col text-right">
         <ul class="list-inline-item pl-0">
            <li class="list-inline-item">
               <a  href="{{url('/role/create')}}"class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded">Add Role</a>
            </li>
         </ul>
      </div>
      @endcan
   </div>
</div>
<!-- Page Wrapper -->
<div class="row">
   <div class="col-sm-12 col-md-12">
      <div class="card mb-0">
         <div class="card-body">
            <div class="table-responsive">
               <table class="datatable table table-stripped mb-0 datatables" id="rolesTable">
                  <thead>
                     <tr>
                        <th>Serial No</th>
                        <th>Role Title</th>
                        <th>Role Tag</th>
                        <th align="center">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($roles as $index => $role)
                     <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$role->name}}</td>
                        <td>{{$role->slug}}</td>
                        <td align="center">
                           @can('Edit-Role')
                           <a href="{{ route('edit.role', $role->id)}}" class="btn btn-outline-success">Edit</a>
                           @endcan
                           @can('Delete-Role')
                           <form action="{{ route('delete.role', $role->id)}}" method="post" style="display: inline-block">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-outline-danger" type="submit">Delete</button>
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
<script>
   $(document).ready( function () {
      $('#rolesTable').DataTable();
   });
</script>
<!-- /Page Wrapper -->
@endsection

