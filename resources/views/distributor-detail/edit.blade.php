

@extends('layouts.master')
@section('content')
<!-- Page Wrapper -->
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-header">
            <h4 class="card-title mb-0">Edit Vendor Detail</h4>
         </div>
         <div class="card-body">
            <form method="post" action="{{ route('update.VendorDetail', $vendor_details->id) }}">
               @csrf 
               <div class="form-group row">
                  <label for="vendor_id" class="col-form-label col-md-2">Vendor Name</label>
                  <div class="col-md-10">
                     <?php $showValue = $vendor_details->vendor_id; ?>
                     <select class="form-control" name="vendor_id" required="">
                        <option value="">--Vendor Name--</option>
                        @foreach ($vendor_lists as $vendor_list)
                        <option value="{{ $vendor_list->id}}" <?php echo ($showValue == $vendor_list->id) ? 'selected' : '' ?>>{{ $vendor_list->name}}</option>
                        @endforeach                            
                     </select>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="route_id" class="col-form-label col-md-2">Route</label>
                  <div class="col-md-10">
                     <?php $showValue = $vendor_routes->route_id; ?>
                     <select class="form-control" name="route_id" required="">
                        <option value="">--Route--</option>
                        @foreach ($vendor_routes as $vendor_route)
                        <option value="{{ $vendor_route->id}}" <?php echo ($showValue == $vendor_route->id) ? 'selected' : '' ?>>{{ $vendor_route->route_name}}</option>
                        @endforeach                            
                     </select>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="decided_milkQuantity" class="col-form-label col-md-2">Batch Id</label>
                  <div class="col-md-10">
                     <input type="text" class="form-control" name="decided_milkQuantity" value="{{ $vendor_details->decided_milkQuantity }}" required="">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="decided_rate" class="col-form-label col-md-2">Manufactured Date</label>
                  <div class="col-md-10">
                     <input type="date" class="form-control" name="decided_rate" value="{{ $vendor_details->decided_rate }}" required="">
                  </div>
               </div>
               <div class="form-group mb-0 row">
                  <div class="col-md-10">
                     <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Edit Vendor Detail</button>
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