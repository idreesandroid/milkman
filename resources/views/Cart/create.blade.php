@extends('layouts.master')
@section('content')
		
			
						
			<!-- Page Wrapper -->
					
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Add Product</h4>
            </div>
            <div class="card-body">
                <form method="post">
                @csrf 

                <div class="form-group row">
                    <label for="buyer_id" class="col-form-label col-md-2">Buyer Name</label>
                    <div class="col-md-10">
                        <select class="form-control" name="buyer_id" required="">
                            <option value="">--Buyer Name--</option>
                            @foreach ($invoices as $invoice)
                             <option value="{{ $invoice->id}}" >{{ $invoice->buyer_id}}</option>
                             @endforeach                            
                        </select>
                    </div>
                </div>



                <div class="form-group row">
                    <label for="product_id" class="col-form-label col-md-2">Product Name</label>
                    <div class="col-md-10">
                        <select class="form-control" name="product_id" required="">
                            <option value="">--Product Name--</option>
                            @foreach ($products as $product)
                             <option value="{{ $product->id}}" >{{ $product->product_name}}</option>
                             @endforeach                            
                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="batch_id" class="col-form-label col-md-2">Batch ID</label>
                    <div class="col-md-10">
                        <select class="form-control" name="batch_id" required="">
                            <option value="">--Batch ID--</option>
                            @foreach ($product_stocks as $product_stock)
                             <option value="{{ $product_stock->id}}" >{{ $product_stock->batch_name}}</option>
                             @endforeach                            
                        </select>
                    </div>
                </div>

                <!-- <div class="form-group row">
                    <label for="batch_name" class="col-form-label col-md-2">Batch Id</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="batch_name" required="">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="manufactured_date" class="col-form-label col-md-2">Manufactured Date</label>
                    <div class="col-md-10">
                        <input type="date" class="form-control" name="manufactured_date" required="">
                    </div>
                </div> -->

                   


                <div class="form-group mb-0 row">                
                    <div class="col-md-10">                           
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