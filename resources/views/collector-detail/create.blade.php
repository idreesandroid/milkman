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
            <li class="breadcrumb-item"><a href="/Dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Collector Register</li>
         </ul>
      </div>
   </div>
         <!-- /Page Header -->
         @if ($errors->any())
     @foreach ($errors->all() as $error)
         <div>{{$error}}</div>
     @endforeach
         @endif
<!-- Page Wrapper -->
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-header">
            <h4 class="card-title mb-0">Register Collector</h4>
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
            <form method="post" action="{{ route('store.collector-detail') }}" enctype="multipart/form-data">
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
                     <div class="form-group">
                     <label>Collection Point:</label>
                     <select class="form-control" name="pointName" required="" autocomplete="off">
                        <option value="">--Point Name--</option>
                        @foreach ($collectionPoints as $collectionPoint)
                        <option value="{{$collectionPoint->id}}" >{{$collectionPoint->pointName}}</option>
                        @endforeach                            
                     </select>
                  </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Home Address:</label>
                        <input class="form-control" id="autocomplete" placeholder="Enter your address" onFocus="geolocate()" type="text" name="user_address"/>
                     </div>

                     <div class="form-group">
                        <label>collector Image:</label>
                        <input type="file" class="form-control" name="filenames" required=""   autocomplete="off" >
                  </div>
                  </div>
               </div>                     
                  </div>
               </div>

               <h4 class="card-title">Asset Assign</h4>
               <div class="row">
                  <div class="col-md-6">  
                  <div class="form-group">
                     @foreach ($assets as $asset)
                     <input type="checkbox"  id="userAsset" name="userAsset[]" value="{{ $asset->id}}">
                     <label class="checkbox-inline" for="userAsset[]">{{$asset->assetName}} ---> {{$asset->assetCode}}</label><br>
                      @endforeach   
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script>
   
    $(document).ready(function() {  
        $(":input").inputmask();        
        initializeMap('mapIn','clear_shapes','save_raw_map','restore','MapData');
        initAutocomplete();  
   });
   
</script>
<!-- /page Wrapper -->
@endsection

