
@extends('layouts.master')
@section('content')
			
<!-- Page Wrapper -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card mb-0">
                
                <div class="card-body">

                <div class="form-group mb-0 row">                
                        <div class="col-md-4">                           
                            <div class="input-group-append">
                            <a href="/vendor-detail/create" class="active"> <button class="btn btn-primary" type="button">Add Vendor</button></a>
                            </div>                           
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="datatable table table-stripped mb-0 datatables">
                            <thead>
                                <tr>
                                <th>Serial No</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>CNIC</th>
                                <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($vendorDetails as $index => $vendorDetail)
                            <tr>
                            <td>{{$index+1}}</td>
                            <td></td>
                            <td>{{$vendorDetail->name}}</td>
                            <td>{{$vendorDetail->user_cnic}}</td>
                            <td><a href="{{ route('profile.user', $vendorDetail->id)}}" class="btn btn-primary">Profile</a></td>
                                                    
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