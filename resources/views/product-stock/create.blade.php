@extends('layouts.master')
@section('content')
		
			
						
			<!-- Page Wrapper -->
					
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">New Stock</h4>
            </div>
            <div class="card-body">
                <form method="post">
                @csrf 

                <div class="form-group row">
                    <label for="product_id" class="col-form-label col-md-2">Product Name</label>
                    <div class="col-md-4">
                        <select class="form-control" name="product_id" required="">
                            <option value="">--Product Name--</option>
                            @foreach ($products as $product)
                             <option value="{{ $product->id}}" >{{ $product->product_name}}</option>
                             @endforeach                            
                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="manufactured_date" class="col-form-label col-md-2">Manufactured Date</label>
                    <div class="col-md-4">
                        <input type="date" class="form-control" name="manufactured_date" required="">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="expire_date" class="col-form-label col-md-2">Expire Date</label>
                    <div class="col-md-4">
                        <input type="date" class="form-control" name="expire_date" required="">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="manufactured_quantity" class="col-form-label col-md-2">Manufactured Quantity</label>
                    <div class="col-md-4">
                        <input type="number" min="1" class="form-control" name="manufactured_quantity" required="" autocomplete="off">
                    </div>
                </div>


                <div class="form-group mb-0 row">                
                    <div class="col-md-4">                           
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Add New Stock</button>
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