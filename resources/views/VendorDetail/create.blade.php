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
            
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

                <form method="post" action="{{ route('store.VendorDetail') }}" enctype="multipart/form-data">
               
               
                @csrf 


									
                <h4 class="card-title">Personal Information</h4>

    <!-- <input type="hidden" name="role_title" value=3 /> -->
          


    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" class="form-control" name="name" minlength="3"  required=""   autocomplete="off"  >
            </div>
             

            <div class="form-group">
                <label>CNIC</label>
                <input type="text" class="form-control" name="user_cnic"  maxlength="13"  required="" autocomplete="off"  >
            </div>

            <div class="form-group">
                <label>Contact No</label>
                <input type="text" class="form-control" name="user_phone" maxlength="11" required=""  autocomplete="off"  >
            </div>											
    
            <div class="form-group">
                <label>Upload Image</label>
                <input type="file" class="form-control" name="filenames[]" multiple required=""   autocomplete="off" >
            </div>	

        </div>
        <div class="col-md-6">
            
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" type="email" name="email"  autocomplete="off"  >
            </div>

            <div class="form-group">
                <label>Password</label>
                <input class="form-control" id="password" name="password" type="password"  required=""  minlength="6" autocomplete="off" >
            </div>
            <div class="form-group">
                <label>Repeat Password</label>
                <input type="password" class="form-control" id="pass1" name="pass1" required=""   minlength="6" autocomplete="off" >
            </div>
        </div>
    </div>
    <h4 class="card-title">Address Information</h4>
    <div class="row">
        <div class="col-md-6">
            
            <div class="form-group"  type="text"  name="user_state" id="user_state">
                <label>Province</label>
                    <select class="select  form-control" required=""  name="user_state">
                    <option>--Province--</option>
                    @foreach ($states as $state)
                        <option value="{{ $state->id}}" >{{ $state->state_name}}</option>
                        @endforeach
                    
                </select>
            </div>

            <div class="form-group"  type="text"  name="user_city" id="user_city">
                <label>City</label>
                    <select class="select  form-control"  required="" name="user_city">
                    <option>--City--</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id}}" >{{ $city->city_name}}</option>
                        @endforeach
                    
                </select>
            </div>

            <div class="form-group"  type="text"  name="route_id" id="route_id">
                <label>Route</label>
                    <select class="select  form-control" required="" name="route_id">
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
                <input type="text" class="form-control" name="user_address" minlength="10"  required=""  autocomplete="off"  >
            </div>

            <div class="form-group">
                <label>Collection Address</label>
                <input type="text" class="form-control" name="vendor_location" minlength="10" required=""  autocomplete="off"  >
            </div>

            

        </div>


        
    </div>
					
    <h4 class="card-title">Business Information</h4>
    <div class="row">
    <div class="col-md-6">
            <div class="form-group">
                <label>Agreed  Quantity</label>
                <input type="text" class="form-control" name="decided_milkQuantity"    required=""  autocomplete="off" >
            </div>

        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Agreed Rate</label>
                <input type="text" class="form-control" name="decided_rate" required=""  autocomplete="off"  >
            </div>
    </div>
    </div>


<span>Have a bank accout? 
<a href="#bank_info" onclick="have_bank_acct('y');">Yes?</a> &nbsp;
<a href="#bank_info" onclick="have_bank_acct('n');">No?</a>
</span>

<div class="row" id="bank_info" style="display:none">
    <div class="col-md-6">

      

        <div class="form-group">
            <label>Bank Name</label>
            <input type="text" class="form-control" id="bank_name"   name="bank_name"   autocomplete="off" >
        </div>
        

        <div class="form-group">
            <label>Branch Name</label>
            <input type="text" class="form-control"  id="branch_name" name="branch_name"    autocomplete="off" >
        </div>

        <div class="form-group">
            <label>Branch Code</label>
            <input type="text" class="form-control" id="branch_code" name="branch_code"   autocomplete="off" >
        </div>											

    </div>
    <div class="col-md-6">

      
        
        <div class="form-group">
            <label>Account No</label>
            <input type="text" class="form-control"  id="acc_no" name="acc_no"    autocomplete="off" >
        </div>

        <div class="form-group">
            <label>Account Title</label>
            <input type="text" class="form-control"  id="acc_title"   name="acc_title"    autocomplete="off" >
        </div>
        
    </div>

</div>

      <hr/>             
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


 <script>
 function have_bank_acct(val){

if(val=='y'){
   $('#bank_info').show(); 

   $("#bank_name").attr("required", true);
   $("#branch_name").attr("required", true);
   $("#branch_code").attr("required", true);
   $("#acc_no").attr("required", true);
   $("#acc_title").attr("required", true);
   

}

if(val=='n'){

    $("#bank_name").attr("required", false);
   $("#branch_name").attr("required", false);
   $("#branch_code").attr("required", false);
   $("#acc_no").attr("required", false);
   $("#acc_title").attr("required", false);

$('#bank_name').val('');
$('#branch_name').val('');
$('#branch_code').val('');
$('#acc_no').val('');
$('#acc_title').val('');
$('#bank_info').hide(); 
}

 }
 
 
 </script>   			
			
			<!-- /page Wrapper -->
		
            @endsection