
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
                                <th>ID</th>
                                <th>Vendor Name</th>
                                <th>Route Name</th>
                                <th>Decided Quantity</th>
                                <th>Decided Rate</th> 
                                <th>Action</th>                             
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($vendor_details as $vendor_detail)
                            <tr>
                            <td>{{$vendor_detail->id}}</td>
                            <td>{{$vendor_detail->vendor->name}}</td>
                            <td>{{$vendor_detail->vendor_route->route_name}}</td>
                            <td>{{$vendor_detail->decided_milkQuantity}}</td>
                            <td>{{$vendor_detail->decided_rate}}</td>
                            <td><a href="{{ route('edit.VendorDetail', $vendor_detail->id)}}" class="btn btn-primary">Edit</a></td>   
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