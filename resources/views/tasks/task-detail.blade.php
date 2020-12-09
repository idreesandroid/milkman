

@extends('layouts.master')
@section('content')
<!-- Page Wrapper -->

<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-header">
            <h4 class="card-title mb-0">Create Collection Area</h4>
         </div>
         <div class="card-body">
            <form method="post" action="{{ route('store.product') }}" enctype="multipart/form-data">
               @csrf 
               <div class="form-group row">
                  <label for="product_name" class="col-form-label col-md-1">Title</label>
                  <div class="col-md-11">
                     <input type="text" placeholder="Collection Area Title" class="form-control" name="collectionAreaTitle" required="" autocomplete="off">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="product_name" class="col-form-label col-md-1">Vendors</label>
                  <div class="col-md-11">
                     <select class="form-control" id="vendorsForCollectionAreaw" name="vendors[]" multiple="multiple">
                       <option>Select Vendors</option>
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
                 <!--  <div class="col-md-2">
                     <div class="form-group">                        
                        <input type="button" id="restore" class="form-control btn btn-primary"  value="Restore">
                     </div>
                  </div> -->
               </div>
               
               <div class="form-group mb-0 row">
                  <div class="col-md-10">
                     <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Create Collection Area</button>
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
<script type="text/javascript">

    //    $(document).ready(function() {
    //      initializeMap();
    // });  
 
</script>