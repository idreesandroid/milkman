@extends('layouts.master')
@section('content')
<!-- Page Wrapper -->
<div class="row">
   <div class="col-sm-12">
      <div class="card mb-0">
         <div class="card-body">
            @can('Create-User')
            <div class="form-group mb-0 row">
               <div class="col-md-4">
                  <div class="input-group-append">
                     <a href="/register" class="active"> <button class="btn btn-primary" type="button">Register</button></a>
                  </div>
               </div>
            </div>
            @endcan
            <div class="table-responsive" >
               <table class="datatable table table-stripped mb-0 datatables" id="userTable">
                  <thead>
                     <tr>
                        <th>Serial No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>User Roll</th>
                        <th>CNIC</th>
                        <th>Phone</th>
                        <th>State</th>
                        <th>City</th>
                        <th>Address</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($users as $index => $user)
                     <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}} </td>
                        <td>@foreach ($user->roles as $role) <span>{{$role->name.','}}</span>@endforeach</td>
                        <td>{{$user->user_cnic}}</td>
                        <td>{{$user->user_phone}}</td>
                        <td>{{$user->state}} </td>
                        <td>{{$user->city}}</td>
                        <td>{{$user->user_address}}</td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>
   $(document).ready( function () {
      $('#userTable').DataTable();
   });
</script>
@endsection

