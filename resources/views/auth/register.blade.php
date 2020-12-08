@extends('layouts.master')
@section('content')
<!-- Page Wrapper -->
<div class="row">
<div class="col-md-12">
   <div class="card">
      <div class="card-header">
         <h4 class="card-title mb-0">Registration Form</h4>
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
         <form method="post" >
            @csrf
            <div class="form-group row">
               <div class="col-md-6">
                  <label>User Roll</label>
                  <select class="form-control" name="role_id" required="" onchange="chk_role(this.value)">
                     <option value="">--User Roll--</option>
                     @foreach ($roles as $role)
                     <option value="{{ $role->id}}">{{$role->name }}</option>
                     @endforeach                          
                  </select>
               </div>
            </div>
            <h4 class="card-title">Personal Information</h4>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Full Name</label>
                     <input type="text" class="form-control"  minlength="3" name="name" required=""  autocomplete="off">
                  </div>
                  <div class="form-group">
                     <label>CNIC</label>
                     <input type="text" class="form-control" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X" name="user_cnic" required="" maxlength="15" autocomplete="off">
                  </div>
                  <div class="form-group">
                     <label>Contact No</label>
                     <input type="text" class="form-control" name="user_phone" data-inputmask="'mask': '0399-99999999'" placeholder="03XX-XXXXXXX" maxlength="12" required="" autocomplete="off">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Email (Optional)</label>
                     <input type="text" class="form-control" type="email" name="email"   autocomplete="off">
                  </div>
                  <div class="form-group">
                     <label>Password</label>
                     <input type="password" class="form-control" id="pass" name="password" required=""  autocomplete="off"   minlength="6"  >
                  </div>
                  <div class="form-group">
                     <label>Repeat Password</label>
                     <input type="password" class="form-control" id="pass1" name="pass1" required=""  autocomplete="off"  minlength="6"    >
                  </div>
               </div>
            </div>
            <h4 class="card-title">Address Information</h4>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group"  type="text" required=""  >
                     <label>State</label>                   
                     <input type="text" name="state" class="form-control" id="administrative_area_level_1">
                  </div>
                  <div class="form-group">
                     <label for="title">Select City:</label>
                     <input type="text" name="city" id="locality" class="form-control">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Address</label>                     
                     <input class="form-control" id="autocomplete" placeholder="Enter your address" onFocus="geolocate()" type="text" name="user_address" />
                  </div>
               </div>
            </div>            
      </div>
      <div class="text-right">
      <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
   </div>
</div>

<!-- /Page Wrapper -->
<script>
function chk_role(id){ 
	if(id==3){
	   		$('#vendor_detail').show();
	}else{
	   $('#route_id').val('');
	   $('#decided_milkQuantity').val('');
	   $('#decided_rate').val('');
	   $('#vendor_detail').hide();
	}
}   
</script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script>
   $(":input").inputmask();
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
@endsection
<!-- <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script> -->