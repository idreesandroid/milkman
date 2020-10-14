
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>User Roll</th>      
                                <th>CNIC</th>                                
                                <th>Phone</th>
                                <th>State</th>      
                                <th>City</th> 
                                <th>Address</th>
                                <th>Action</th>  

                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                            <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}} </td>
                            <td></td>
                            <td>{{$user->user_cnic}}</td>
                            <td>{{$user->user_phone}}</td>
                            <td>{{$user->state->state_name}} </td>
                            <td>{{$user->city->city_name}}</td>
                            <td>{{$user->user_address}}</td>
                            <td><a href="{{ route('edit.userList', $user->id)}}" class="btn btn-primary">Edit</a></td>
                                
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

		       

	