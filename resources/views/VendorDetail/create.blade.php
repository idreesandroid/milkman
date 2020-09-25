@extends('layouts.master')
@section('content')
		
			
						
			<!-- Page Wrapper -->
					
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Add Detail</h4>
            </div>
            <div class="card-body">
                <form method="post">
                @csrf 

                <div class="form-group row">
                    <label for="vendor_id" class="col-form-label col-md-2">Vendor Name</label>
                    <div class="col-md-10">
                        <select class="form-control" name="vendor_id" required="">
                            <option value="">--Vendor Name--</option>
                            @foreach ($vendor_details as $vendor_detail)
                             <option value="{{ $vendor_detail->id}}" >{{ $vendor_detail->name}}</option>
                             @endforeach                            
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="route_id" class="col-form-label col-md-2">Route</label>
                    <div class="col-md-10">
                        <select class="form-control" name="route_id" required="">
                            <option value="">--Route--</option>
                            @foreach ($vendor_routes as $vendor_route)
                             <option value="{{ $vendor_route->id}}" >{{ $vendor_routes->route_name}}</option>
                             @endforeach                            
                        </select>
                    </div>
                </div>

               

                    <div class="form-group row">
                        <label for="decided_milkQuantity" class="col-form-label col-md-2">Decided Quantity</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="decided_milkQuantity" required="">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="decided_rate" class="col-form-label col-md-2">Decided Rate</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="decided_rate" required="">
                        </div>
                    </div>

                    <div class="form-group mb-0 row">                
                        <div class="col-md-10">                           
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Add Detail</button>
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