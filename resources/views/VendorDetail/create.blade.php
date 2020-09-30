@extends('layouts.master')
@section('content')
		
			
						
			<!-- Page Wrapper -->
					
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Register Vendor</h4>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('store.VendorDetail') }}" enctype="multipart/form-data">
               
               
                @csrf 


									
                <h4 class="card-title">Personal Information</h4>

    <!-- <input type="hidden" name="role_title" value=3 /> -->
          


    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" name="name"   >
            </div>
            

            <div class="form-group">
                <label>CNIC</label>
                <input type="text" class="form-control" name="user_cnic"  >
            </div>

            <div class="form-group">
                <label>Contact No</label>
                <input type="text" class="form-control" name="user_phone"  >
            </div>											
    
            <div class="form-group">
                <label>Upload Image</label>
                <input type="file" class="form-control" name="filenames[]"  >
            </div>	

        </div>
        <div class="col-md-6">
            
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" type="email" name="email"  >
            </div>

            <div class="form-group">
                <label>Password</label>
                <input class="form-control" id="password" name="password" type="password"  >
            </div>
            <div class="form-group">
                <label>Repeat Password</label>
                <input type="password" class="form-control" id="pass1" name="pass1"  >
            </div>
        </div>
    </div>
    <h4 class="card-title">Address Information</h4>
    <div class="row">
        <div class="col-md-6">
            
            <div class="form-group"  type="text"  name="user_state" id="user_state">
                <label>Province</label>
                    <select class="select  form-control"  name="user_state">
                    <option>--Province--</option>
                    @foreach ($states as $state)
                        <option value="{{ $state->id}}" >{{ $state->state_name}}</option>
                        @endforeach
                    
                </select>
            </div>

            <div class="form-group"  type="text"  name="user_city" id="user_city">
                <label>City</label>
                    <select class="select  form-control"  name="user_city">
                    <option>--City--</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id}}" >{{ $city->city_name}}</option>
                        @endforeach
                    
                </select>
            </div>

            <div class="form-group"  type="text"  name="route_id" id="route_id">
                <label>Route</label>
                    <select class="select  form-control"  name="route_id">
                    <option>--Route--</option>
                    @foreach ($vendor_routes as $vendor_route)
                    <option value="{{ $vendor_route->id}}" >{{ $vendor_route->route_name}}</option>
                    @endforeach
                    
                </select>
            </div>
        
            </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Home Address</label>
                <input type="text" class="form-control" name="user_address"   >
            </div>

            <div class="form-group">
                <label>Collection Address</label>
                <input type="text" class="form-control" name="vendor_location"   >
            </div>

            

        </div>


        
    </div>
					
    <h4 class="card-title">Business Information</h4>


<div class="row">
    <div class="col-md-6">

        <div class="form-group">
            <label>Milk Quantity</label>
            <input type="text" class="form-control" name="decided_milkQuantity"   >
        </div>

        <div class="form-group">
            <label>Bank Name</label>
            <input type="text" class="form-control" name="bank_name"   >
        </div>
        

        <div class="form-group">
            <label>Branch Name</label>
            <input type="text" class="form-control" name="branch_name"  >
        </div>

        <div class="form-group">
            <label>Branch Code</label>
            <input type="text" class="form-control" name="branch_code"  >
        </div>											

    </div>
    <div class="col-md-6">

        <div class="form-group">
            <label>Decided Rate</label>
            <input type="text" class="form-control" name="decided_rate"   >
        </div>
        
        <div class="form-group">
            <label>Account No</label>
            <input type="text" class="form-control" name="acc_no"  >
        </div>

        <div class="form-group">
            <label>Account Title</label>
            <input type="text" class="form-control"  name="acc_title"   >
        </div>
        
    </div>

</div>

                   
<div class="form-group mb-0 row">                
    <div class="col-md-10">                           
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit">Register</button>
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