@extends('layouts.master')
@section('content')
						
			<!-- Page Wrapper -->
					
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Update</h4>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('update.userList', $users->id) }}">
                @csrf 

                <div class="form-group row">
                    <label for="name" class="col-form-label col-md-2">Name</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="name" value="{{ $users->name }}" required="">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-form-label col-md-2">Email</label>
                    <div class="col-md-10">
                        <input type="email" class="form-control" name="email" value="{{ $users->email }}" required="">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-form-label col-md-2">Password</label>
                    <div class="col-md-10">
                        <input type="password" class="form-control" name="password" value="{{ $users->password }}" required="">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="user_cnic" class="col-form-label col-md-2">CNIC</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="user_cnic" value="{{ $users->user_cnic }}" required="">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="user_phone" class="col-form-label col-md-2">Phone</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="user_phone" value="{{ $users->user_phone }}" required="">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="user_address" class="col-form-label col-md-2">Address</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="user_address" value="{{ $users->user_address }}" required="">
                    </div>
                </div>
                    <div class="form-group mb-0 row">                
                        <div class="col-md-10">                           
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>                           
                        </div>
                    </div>
                        
                </form>
            </div>
        </div>
        
    </div>
</div>
				
			
			<!-- /page Wrapper -->
		
            @endsection