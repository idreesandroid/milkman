
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
                                <th>Collection Address</th>
                                <th>Route</th>
                                <th>Milk Quantity</th>
                                <th>Decided Rate</th> 
                                <th>Bank Name</th>
                                <th>Branch Name</th>
                                <th>Branch Code</th> 
                                <th>Account No</th>
                                <th>Account Title</th>  
                                <th>Action</th>  

                                </tr>
                            </thead>
                            <tbody>
                            @foreach($vendorDetails as $vendorDetail)
                            <tr>
                            <td>{{$vendorDetail->vendor->name}}</td>
                            <td>{{$vendorDetail->vendor->email}}</td>
                            <td>{{$vendorDetail->vendor->user_cnic}}</td>
                            <td>{{$vendorDetail->vendor->user_phone}}</td>
                            <td>State name</td>
                            <td>city name</td>
                            <td>{{$vendorDetail->vendor->user_address}}</td>
                            <td>{{$vendorDetail->vendor_location}}</td>
                           >
                            <td>route name</td>
                            <td>{{$vendorDetail->decided_milkQuantity}}</td>
                            <td>{{$vendorDetail->decided_rate}}</td>
                            <td>{{$vendorDetail->bank_name}}</td>
                            <td>{{$vendorDetail->branch_name}}</td>
                            <td>{{$vendorDetail->branch_code}}</td>
                            <td>{{$vendorDetail->acc_no}}</td>
                            <td>{{$vendorDetail->acc_title}}</td>
                           
                            
                            
                            
                             
                            <td><a href="" class="btn btn-primary">Edit</a></td>   
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