
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
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                            <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->user_cnic}}</td>
                            <td>{{$user->user_phone}}</td>
                           <td>{{$user->State->state_name}}</td>
                           <td></td>
                            <td>{{$user->user_address}}</td>
                            
                             
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