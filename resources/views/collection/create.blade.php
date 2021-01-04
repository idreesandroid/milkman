@extends('layouts.master')
@section('content')
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
         <li class="breadcrumb-item"><a href="#">Collection</a></li>
         <li class="breadcrumb-item active">Register</li>
      </ul>
   </div>
</div>
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-header">
            <h4 class="card-title mb-0">Collection Management</h4>
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
            <form method="post" action="{{ route('store.collection') }}">
               @csrf
               <div class="form-group row">
                  <label for="product_name" class="col-form-label col-md-1">Title</label>
                  <div class="col-md-11">
                     <input type="text" placeholder="Collection Area Title" class="form-control" name="title" required="" autocomplete="off">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="vendorsForCollectionArea" class="col-form-label col-md-1">Vendors</label>
                  <div class="col-md-11">
                     <select class="form-control" id="vendorsForCollectionArea" name="vendorsIds[]" multiple="multiple">                       
                        @foreach($vendors as $vendor)
                        <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="map" id="mapIn"></div>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">                        
                        <input type="text" min="0"  class="form-control" id="MapData" readonly name="vendors_location">
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
    $(document).ready(function() {                
        initializeMap();
        $('#vendorsForCollectionArea').select2();
   });   
</script>
@endsection

