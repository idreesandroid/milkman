@extends('layouts.master')
@section('content')

 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>Register</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/DashBoard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Vendor Register</li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->
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
            <form method="post" action="{{ route('store.vendor-detail') }}" enctype="multipart/form-data" >
               @csrf 
               <h4 class="card-title">Personal Information</h4>
               <!-- <input type="hidden" name="role_title" value=3 /> -->
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Full Name:</label>
                        <input type="text" class="form-control" name="name" minlength="3"  required=""   autocomplete="off"  >
                     </div>
                     <div class="form-group">
                        <label>CNIC:</label>
                        <input type="text" class="form-control" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X" name="user_cnic"  maxlength="15"  required="" autocomplete="off"  >
                     </div>
                     <div class="form-group">
                        <label>Contact No:</label>
                        <input type="text" class="form-control" name="user_phone" data-inputmask="'mask': '0399-99999999'" placeholder="03XX-XXXXXXX" maxlength="12" required=""  autocomplete="off"  >
                     </div>
                    
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Email:</label>
                        <input type="text" class="form-control" type="email" name="email"  autocomplete="off"  >
                     </div>
                     <div class="form-group">
                        <label>Password:</label>
                        <input class="form-control" id="password" name="password" type="password"  required=""  minlength="6" autocomplete="off" >
                     </div>
                     <div class="form-group">
                        <label>Confirm Password:</label>
                        <input type="password" class="form-control" id="Confirm" name="Confirm" required=""   minlength="6" autocomplete="off" >
                     </div>
                  </div>
               </div>
               <h4 class="card-title">Address Information</h4>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group"  type="text" required=""  >
                        <label>State:</label>
                        <input type="text" name="state" class="form-control" id="administrative_area_level_1">
                     </div>
                     <div class="form-group">
                        <label for="title">City:</label>
                        <input type="text" name="city" id="locality" class="form-control">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Home Address:</label>
                        <input class="form-control" id="autocomplete"  onFocus="geolocate()" type="text" name="user_address"/>
                     </div>
                     <div class="form-group">
                        <label>Upload Image:</label>
                        <input type="file" class="form-control" name="filenames" required=""   autocomplete="off" >
                     </div>
                  </div>
               </div>
               <h4 class="card-title">Business Address Information</h4>
               <div class="row">
                  <div class="col-md-12">  
                     <div class="form-group">
                        <label>Business Address:</label>
                        <input class="form-control" id="autocomplete2" onfocus="searchLocation()" type="text" name="user_address"/>
                     </div>
                  </div>
               </div>
               <h4 class="card-title">Business Information</h4>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Average Daily Quantity:</label>
                        <input type="number" min="0"  class="form-control" name="decided_milkQuantity"    required=""  autocomplete="off" >
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Agreed Rate:</label>
                        <input type="number" min="0" class="form-control" name="decided_rate" required=""  autocomplete="off" >
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Morning Agreed Quantity:</label>
                        <input type="number" min="0"  class="form-control" name="morning_decided_milkQuantity"    required=""  autocomplete="off" >
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Morning Expected Time:</label>
                        <input type="time" min="0" class="form-control" name="morningTime" required=""  autocomplete="off"  >
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Evening Agreed Quantity:</label>
                        <input type="number" min="0"  class="form-control" name="evening_decided_milkQuantity"    required=""  autocomplete="off" >
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Evening Expected Time:</label>
                        <input type="time" min="0" class="form-control" name="eveningTime" required=""  autocomplete="off"  >
                     </div>
                  </div>
               </div>
               <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" id="bankDetails" name="bankDetails" value="1" onClick="haveBankDetail()">
                  <label class="custom-control-label" for="bankDetails">Have a bank accout?</label>
               </div>
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
                        <input type="number" class="form-control" id="branch_code" name="branch_code"   autocomplete="off" >
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Account No</label>
                        <input type="number" class="form-control"  id="acc_no" name="acc_no"    autocomplete="off" >
                     </div>
                     <div class="form-group">
                        <label>Account Title</label>
                        <input type="text" class="form-control"  id="acc_title"   name="acc_title"    autocomplete="off" >
                     </div>
                  </div>
               </div>
               <hr/>
               <div class="map" id="mapIn"></div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">                        
                        <input type="text" min="0"  class="form-control" id="MapData" readonly name="map_detail">
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-2">
                     <div class="form-group">                        
                        <input type="button"  class="form-control btn btn-info"  value="Add" id="save_raw_map">
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group">                        
                        <input type="button" class="form-control btn btn-danger"  value="Clear Shap" id="clear_shapes">
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group">                        
                        <input type="button" id="restore" class="form-control btn btn-primary"  value="Restore">
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
<script>
   function haveBankDetail()
   {
       if ($('#bankDetails').is(":checked")) {
         
          $('#bank_info').show();   
          $("#bank_name").attr("required", true);
          $("#branch_name").attr("required", true);
          $("#branch_code").attr("required", true);
          $("#acc_no").attr("required", true);
          $("#acc_title").attr("required", true);
   
        } 
            else if($('#bankDetails').is(':not(:checked)'))
        {
           $("#bank_name").attr("required", false);
           $("#branch_name").attr("required", false);
           $("#branch_code").attr("required", false);
           $("#acc_no").attr("required", false);
           $("#acc_title").attr("required", false);           
           $('#bank_info').hide();    
        }   
   }
        
</script>   
<!-- City State Ajax -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script>
   $(":input").inputmask();
   $(document).ready(function() {       
           initializeMap('mapIn','clear_shapes','save_raw_map','restore','MapData');
          // initializeMap('updateCollectionMap','edit_clear_shapes','update_raw_map','edit_restore','update_MapData',infoWindowDetail,infoWindowDetail[0][1],infoWindowDetail[0][2]);
           initAutocomplete();  
    });
</script>
<!-- /page Wrapper -->
@endsection

