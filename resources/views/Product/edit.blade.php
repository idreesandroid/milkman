@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Add Product</h4>
            </div>
            <div class="card-body">
            <form method="post"  action="{{ route('update.product', $products->id) }}">
                @csrf 
                    <div class="form-group row">
                        <label for="product_name" class="col-form-label col-md-2">Product Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control"type="text" name="product_name"  value="{{ $products->product_name }}" required=""  autocomplete="off">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="product_size" class="col-form-label col-md-2">Size</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" type="text" name="product_size" value="{{ $products->product_size }}" required=""  autocomplete="off" >
                        </div>
                    </div>


                <div class="form-group row">
                <?php $showValue = $products->unit; ?>
                    <label for="unit" class="col-form-label col-md-2">Unit</label>
                    <div class="col-md-6">
                        <select class="form-control" name="unit" value="{{ $products->unit }}" required="">
                            <option value="">--Select Unit--</option>
                            @foreach ($units as $unit)
                             <option value="{{ $unit}}" <?php echo ($showValue == $unit) ? 'selected' : '' ?> >{{ $unit}}</option>
                             @endforeach                            
                        </select>
                    </div>
                </div>



                    <div class="form-group row">
                        <label for="product_price" class="col-form-label col-md-2">Price</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control"type="text" name="product_price" value="{{ $products->product_price }}" required=""  autocomplete="off" >
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="product_description" class="col-form-label col-md-2">Description</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control"type="text" name="product_description" value="{{ $products->product_description }}" required=""  autocomplete="off" >
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="ctn_value" class="col-form-label col-md-2">Quantity/Carton</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control"type="text" name="ctn_value" value="{{ $products->ctn_value }}" required=""  autocomplete="off" >
                        </div>
                    </div>


                    <div class="form-group mb-0 row">                
                        <div class="col-md-6">                           
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Update Product</button>
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