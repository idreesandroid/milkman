
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
                                <th>Route Name</th>
                                <th>Route Description</th>   
                                <th>Action</th>                    
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($vendor_routes as $vendor_route)
                            <tr>
                            <td>{{$vendor_route->id}}</td>
                            <td>{{$vendor_route->route_name}}</td>
                            <td>{{$vendor_route->route_description}}</td>
                            <td><a href="{{ route('edit.VendorRoute', $vendor_route->id)}}" class="btn btn-primary">Edit</a></td>
                                
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

		       

	