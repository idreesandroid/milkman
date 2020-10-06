
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
 
                            <td>{{$vendorDetail->name}}</td>
                            <td>{{$vendorDetail->email}}</td>
                            <td>{{$vendorDetail->user_cnic}}</td>
                            <td>{{$vendorDetail->user_phone}}</td>
                            <td>{{$vendorDetail->state->state_name}}</td>
                            <td>{{$vendorDetail->city->city_name}}</td>
                            <td>{{$vendorDetail->user_address}}</td>
                            <td> </td>
                         
                            <td>{{$vendorDetail->vendor_detail->route_id}}</td>

                            <td>{{$vendorDetail->vendor_detail->decided_milkQuantity}}</td>
                            <td>{{$vendorDetail->vendor_detail->decided_rate}}</td>
                            <td>{{$vendorDetail->vendor_detail->bank_name}}</td>
                            <td>{{$vendorDetail->vendor_detail->branch_name}}</td>
                            <td>{{$vendorDetail->vendor_detail->branch_code}}</td>
                            <td>{{$vendorDetail->vendor_detail->acc_no}}</td>
                            <td>{{$vendorDetail->vendor_detail->acc_title}}</td>                
                                                       
 
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