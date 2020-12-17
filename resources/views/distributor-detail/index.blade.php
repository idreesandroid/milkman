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
                  <li class="breadcrumb-item"><a href="/">Distributor</a></li>
                  <li class="breadcrumb-item active">Listing</li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->
<!-- Page Wrapper -->
<div class="row">
   <div class="col-sm-12">
      <div class="card mb-0">
         <div class="card-body">
            @can('Create-Distributor')
            <div class="form-group mb-0 row">
               <div class="col-md-4">
                  <div class="input-group-append">
                     <a href="{{url('distributor-detail/create')}}" class="active"> <button class="btn btn-primary" type="button">Register Distributor</button></a>
                  </div>
               </div>
            </div>
            @endcan
            <div class="table-responsive">
               <table class="datatable table table-stripped mb-0 datatables">
                  <thead>
                     <tr>
                     <th>Serial No</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>CNIC</th>
                        <th>Contact</th>
                        <th>Company Name</th>
                        <th>Company Logo</th>
                        <th>Details</th>

                     </tr>
                  </thead>
                  <tbody>
                     @foreach($distributorDetails as $index => $distributorDetail)
                     <tr>
                     <td>{{$index+1}}</td>
                        <td><img alt="" class="profile-img" src="{{asset('/UserProfile/'.$distributorDetail->filenames)}}"></td>
                        <td>{{$distributorDetail->name}}</td>
                        <td>{{$distributorDetail->email}}</td>
                        <td>{{$distributorDetail->user_cnic}}</td>
                        <td>{{$distributorDetail->user_phone}}</td>
                       <td>{{$distributorDetail->distributorCompany->companyName}}</td>
                       <td><img src="{{asset('/distributorCompany/'.$distributorDetail->distributorCompany->companyLogo)}}" alt="Logo" class="img-thumbnail"></td>   
                         <td> <a href="{{ route('profile.user', $distributorDetail->id)}}" class="btn btn-primary">Profile</a>
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

