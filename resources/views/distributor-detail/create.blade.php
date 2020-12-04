@extends('layouts.master')
@section('content')
		
			
						
			<!-- Page Wrapper -->
					
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Register Distributor</h4>
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

                <form method="post" action="{{ route('store.distributor-detail') }}" enctype="multipart/form-data">
               
               
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
                <input type="text" class="form-control" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X" name="user_cnic"  maxlength="15"  required="" autocomplete="off"  >
            </div>

            <div class="form-group">
                <label>Contact No</label>
                <input type="text" class="form-control" name="user_phone" data-inputmask="'mask': '0399-99999999'" placeholder="03XX-XXXXXXX" maxlength="12" required=""  autocomplete="off"  >
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
            
        <div class="form-group"  type="text" required=""  >
            <label>State</label>
                <select class="select  form-control"  name="user_state" id="user_state">
                <option>States</option>
                <option value="">--- Select State ---</option>
                @foreach ($states as $state)
                    <option value="{{ $state->id}}">{{ $state->state_name }}</option>
                    @endforeach														
            </select>
        </div>

            <div class="form-group">
            <label for="title">Select City:</label>
            <select name="user_city" class="form-control" id="user_city" >
            </select>
            </div>

            
        
            </div>
         <div class="col-md-6">
            <div class="form-group">
                <label>Home Address</label>
                <input type="text" class="form-control" name="user_address" minlength="10"  required=""  autocomplete="off"  >
            </div>

         
        </div>

    </div>
					
    <h4 class="card-title">Company Information</h4>
    <div class="row">
    <div class="col-md-6">
        
    <div class="form-group">
                <label>Company Owner</label>
                <input type="text" min="0"  class="form-control" name="companyOwner"    required=""  autocomplete="off" >
            </div>

            <div class="form-group">
                <label>Company NTN</label>
                <input type="text" min="0"  class="form-control" name="companyNTN"    required=""  autocomplete="off" >
            </div>

            <div class="form-group">
                <label>Company Area</label>
                <input type="text" min="0"  class="form-control" name="companyArea"    required=""  autocomplete="off" >
            </div>

            <div class="form-group">
                <label>Upload Image</label>
                <input type="file" class="form-control" name="filenames[]" multiple required=""   autocomplete="off" >
            </div>

        </div>
        <div class="col-md-6">
            
            <div class="form-group">
                <label>Company Name</label>
                <input type="text" min="0"  class="form-control" name="companyName"    required=""  autocomplete="off" >
            </div>

            <div class="form-group">
                <label>Company Contact</label>
                <input type="text" min="0"  class="form-control" name="companyContact"    required=""  autocomplete="off" >
            </div>

            <div class="form-group">
                <label>Company Address</label>
                <input type="text" min="0"  class="form-control" name="companyAddress"    required=""  autocomplete="off" >
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


   

<!-- City State Ajax -->

 <script type="text/javascript">	
 
    $(document).ready(function() {		
        $("#user_state").on('change', function() {			
            var stateID = $("#user_state").val();
            
            if(stateID != 0 ) {
         $.ajax({				
                    url: '/register/ajax/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {                   
                        $("#user_city").empty();
                        $.each(data, function(key, value) {
                        $("#user_city").append('<option value="'+value.id +'">'+ value.city_name +'</option>');
                        });
                    }
                });

            }else{
                $("#user_city").empty();
            }
        });
    });
</script>
			

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>

	<script>
    $(":input").inputmask();
   </script>



			<!-- /page Wrapper -->
		
            @endsection