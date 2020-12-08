@extends('layouts.master')
@section('content')
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>CNIC</th>
                        <th>Contact</th>
                        <th>Province</th>
                        <th>City</th>
                        <th>Address</th>
                        <th>Milk Quantity</th>
                        <th>companyName</th>
                        <th>companyOwner</th>
                        <th>companyContact</th>
                        <th>companyAddress</th>
                        <th>companyNTN</th>
                        <th>companyArea</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($distributorDetails as $distributorDetail)
                     <tr>
                        <td>{{$distributorDetail->name}}</td>
                        <td>{{$distributorDetail->email}}</td>
                        <td>{{$distributorDetail->user_cnic}}</td>
                        <td>{{$distributorDetail->user_phone}}</td>
                        <td>{{$distributorDetail->state}}</td>
                        <td>{{$distributorDetail->city}}</td>
                        <td>{{$distributorDetail->user_address}}</td>
                        <td><img src="{{asset('/distributorCompany/'.$distributorDetail->distributorCompany->filenames)}}" alt="Logo" class="img-thumbnail"></td>
                        <td>{{$distributorDetail->distributorCompany->companyName}}</td>
                        <td>{{$distributorDetail->distributorCompany->companyOwner}}</td>
                        <td>{{$distributorDetail->distributorCompany->companyContact}}</td>
                        <td>{{$distributorDetail->distributorCompany->companyAddress}}</td>
                        <td>{{$distributorDetail->distributorCompany->companyNTN}}</td>
                        <td>{{$distributorDetail->distributorCompany->companyArea}}</td>
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

