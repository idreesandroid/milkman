
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
                                <th>Serial No</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>CNIC</th>
 
                                <th>Details</th> 
                                

                                </tr>
                            </thead>
                            <tbody>
                            @foreach($distributorDetails as $index => $distributorDetail)
                            <tr>
                            <td>{{$index+1}}</td>
                            <td></td>
                            <td>{{$distributorDetail->name}}</td>
                            <td>{{$distributorDetail->user_cnic}}</td>
                   
                            <td><a href="{{ route('profile.user', $distributorDetail->id)}}" class="btn btn-primary">Profile</a></td>
                                                                                 
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