@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Edit Route</h4>
            </div>
            <div class="card-body">
            <form method="post"  action="{{ route('update.VendorRoute', $vendor_routes->id) }}">
                @csrf 
                    <div class="form-group row">
                        <label for="route_name" class="col-form-label col-md-2">Route Name</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control"type="text" name="route_name"  value="{{ $vendor_routes->route_name }}" required=""  autocomplete="off">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="route_description" class="col-form-label col-md-2">Route Description</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" type="text" name="route_description" value="{{ $vendor_routes->route_description }}" required=""  autocomplete="off" >
                        </div>
                    </div>

                    <div class="form-group mb-0 row">                
                        <div class="col-md-4">                           
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Update Route</button>
                            </div>                           
                        </div>
                    </div>
                        <!-- <div class="form-group pt-2">
                        <button class="btn btn-block btn-primary" type="submit">ADD Product</button>
                        </div> -->
                </form>
            </div>
        </div>
        
    </div>
</div>
				
			
			<!-- /page Wrapper -->
		
            @endsection