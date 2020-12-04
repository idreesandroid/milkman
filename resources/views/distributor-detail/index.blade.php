
@extends('layouts.master')
@section('content')
			
<!-- Page Wrapper -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card mb-0">
                
                <div class="card-body">

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
                                <th>Decided Rate</th> 
                               
                                

                                </tr>
                            </thead>
                            <tbody>
                            @foreach($distributorDetails as $distributorDetail)
                            <tr>
 
                            <td>{{$distributorDetail->name}}</td>
                            <td>{{$distributorDetail->email}}</td>
                            <td>{{$distributorDetail->user_cnic}}</td>
                            <td>{{$distributorDetail->user_phone}}</td>
                            <td>{{$distributorDetail->state->state_name}}</td>
                            <td>{{$distributorDetail->city->city_name}}</td>
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