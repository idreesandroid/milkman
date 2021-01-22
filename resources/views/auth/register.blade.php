@extends('layouts.master')
@section('content')

 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>MilkMan Dashboard</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                  <li class="breadcrumb-item active">Register</li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->

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
         <form method="post" enctype="multipart/form-data">
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

                  <div class="form-group">
                        <label>Upload Image</label>
                        <input type="file" class="form-control" name="filenames" required=""   autocomplete="off" >
                  </div>
               </div>
            </div>            
      <div class="text-right">
      <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </div>
      </form>
   </div>
</div>

<!-- /Page Wrapper -->
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script>
   $(":input").inputmask();
   $(document).ready(function() { 
           initAutocomplete();  
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
@endsection
<!-- <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script> -->

