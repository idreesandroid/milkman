@extends('layouts.master')
@section('content')
 <!-- Page Header -->
<div class="crms-title row bg-white mb-4">
   <div class="col">
      <h3 class="page-title">
         <span class="page-title-icon bg-gradient-primary text-white mr-2">
         <i class="la la-table"></i>
         </span> <span>Users</span>
      </h3>
   </div>
   <div class="col text-right">
      <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
         <li class="breadcrumb-item"><a href="{{route('user.dashBoard')}}">Dashboard</a></li>
         <li class="breadcrumb-item active">User List</li>
      </ul>
   </div>
</div>
<!-- /Page Header -->
<!-- Page Wrapper -->
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-body">
            <!-- <h6 class="card-title">Bottom line justified</h6> -->
            <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
               <li class="nav-item">
                  <a class="nav-link active" href="#systemUsers" data-toggle="tab">System Users <span class="badge badge-pill">{{count($users)}}</span></a></i> 
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#vendors" data-toggle="tab">Vendors <span class="badge badge-pill">{{count($vendors)}}</span></a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#distributor" data-toggle="tab">Distributors <span class="badge badge-pill">{{count($distributors)}}</span></a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="#collectors" data-toggle="tab">Collectors <span class="badge badge-pill">{{count($collectors)}}</span></a>
               </li>
            </ul>
            <div class="tab-content">                           
               <div class="tab-pane show active" id="systemUsers">
                  <div class="row">
                  @can('Register-User')                                 
                     <div class="col text-right">
                        <ul class="list-inline-item pl-0">
                           <li class="list-inline-item">
                              <a  href="/register"class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded">Registor System User</a>
                           </li>
                        </ul>
                     </div>
                  @endcan                 
                  </div>  
                  <div class="table-responsive">
                     <table class="datatable table table-stripped mb-0 datatables" id="systemUsersTable">
                        <thead>
                           <tr>                              
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
                              <td><img class="avatar" src="{{asset('/UserProfile/'.$user->filenames)}}"></td>
                              <td>{{ucfirst($user->name)}}</td>
                              <td>{{$user->email}} </td>
                              <td>@foreach ($user->roles as $role) <span>{{$role->name}}</span>@endforeach</td>
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
               <div class="tab-pane" id="vendors">
                  <div class="row">
                  @can('Create-Vendor')                                  
                     <div class="col text-right">
                        <ul class="list-inline-item pl-0">
                           <li class="list-inline-item">
                              <a  href="/vendor-detail/create"class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded">Registor Vendor</a>
                           </li>
                        </ul>
                     </div>
                  @endcan               
                  </div>  
                  <div class="table-responsive">
                     <table class="datatable table table-stripped mb-0 datatables" id="vendorsTable">
                        <thead>
                           <tr>                              
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
                           @foreach($vendors as $index => $user)
                           <tr>                        
                              <td><img class="avatar" src="{{asset('/UserProfile/'.$user->filenames)}}"></td>
                              <td>{{ucfirst($user->name)}}</td>
                              <td>{{$user->email}} </td>
                              <td>@foreach ($user->roles as $role) <span>{{$role->name}}</span>@endforeach</td>
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
               <div class="tab-pane" id="distributor">
                  <div class="row">                                                      
                  @can('Create-Distributor')
                     <div class="col text-right">
                        <ul class="list-inline-item pl-0">
                           <li class="list-inline-item">
                              <a  href="{{url('distributor-detail/create')}}"class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded">Registor Distributor</a>
                           </li>
                        </ul>
                     </div>                  
                  @endcan
                  </div>
                  <div class="table-responsive">
                     <table class="datatable table table-stripped mb-0 datatables" id="distributorTable">
                        <thead>
                           <tr>                              
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
                           @foreach($distributors as $index => $user)
                           <tr>                        
                              <td><img class="avatar" src="{{asset('/UserProfile/'.$user->filenames)}}"></td>
                              <td>{{ucfirst($user->name)}}</td>
                              <td>{{$user->email}} </td>
                              <td>@foreach ($user->roles as $role) <span>{{$role->name}}</span>@endforeach</td>
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
               <div class="tab-pane" id="collectors">
                  <div class="row">                                   
                  @can('Create-Collector')
                     <div class="col text-right">
                        <ul class="list-inline-item pl-0">
                           <li class="list-inline-item">
                              <a  href="/collector-detail/create"class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded">Registor Collector</a>
                           </li>
                        </ul>
                     </div>                  
                  @endcan
                  </div>
                  <div class="table-responsive">
                     <table class="datatable table table-stripped mb-0 datatables" id="collectorsTable">
                        <thead>
                           <tr>                              
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
                           @foreach($collectors as $index => $user)
                           <tr>                        
                              <td><img class="avatar" src="{{asset('/UserProfile/'.$user->filenames)}}"></td>
                              <td>{{ucfirst($user->name)}}</td>
                              <td>{{$user->email}} </td>
                              <td>@foreach ($user->roles as $role) <span>{{$role->name}}</span>@endforeach</td>
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
   </div>
</div>
 <?php //exit(); ?>
<!-- /Page Wrapper -->
<script>
   $(document).ready( function () {
      $('#systemUsersTable').DataTable();
      $('#collectorsTable').DataTable();
      $('#vendorsTable').DataTable();
      $('#distributorTable').DataTable();
   });
</script>
@endsection

