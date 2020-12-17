@extends('layouts.master')
@section('content')
 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>Deals Dashboard</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                  <li class="breadcrumb-item active">Deals Dashboard</li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->
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
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>User Roll</th>
                        <th>CNIC</th>
                        <th>Phone</th>
                        <th>Details</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($users as $index => $user)
                     <tr>
                        <td>{{$index+1}}</td>
                        <td><img alt="" class="profile-img" src="{{asset('/UserProfile/'.$user->filenames)}}"></td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}} </td>
                        <td>@foreach ($user->roles as $role) <span>{{$role->name.','}}</span>@endforeach</td>
                        <td>{{$user->user_cnic}}</td>
                        <td>{{$user->user_phone}}</td>
                        <td><a href="{{ route('profile.user', $user->id)}}" class="btn btn-primary">Profile</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script>
   $(document).ready( function () {
      $('#userTable').DataTable();
   });
</script>
@endsection

