@extends('layouts.master')
@section('content')
 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>Product</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/DashBoard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Create</li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->
<!-- Page Wrapper -->
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-header">
            <h4 class="card-title mb-0">Add Product</h4>
         </div>
         <div class="card-body">
         @if ($errors->any())
     @foreach ($errors->all() as $error)
         <div>{{$error}}</div>
     @endforeach
      @endif
            <form method="post" action="{{ route('store.product') }}"  enctype="multipart/form-data" id="product">
               @csrf 
               <div class="form-group row">
                  <label for="product_name" class="col-form-label col-md-2">Product Name</label>
                  <div class="col-md-4">
                     <input type="text" class="form-control" name="product_name" required="" autocomplete="off">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="product_nick" class="col-form-label col-md-2">Product Code</label>
                  <div class="col-md-4">
                     <input type="text" class="form-control" name="product_nick" required="" autocomplete="off">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="product_size" class="col-form-label col-md-2">Size</label>
                  <div class="col-md-4">
                     <input type="text" class="form-control" name="product_size" required="" autocomplete="off">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="unit" class="col-form-label col-md-2">Unit</label>
                  <div class="col-md-4">
                     <select class="form-control" name="unit" required="">
                        <option value="">--Select Unit--</option>
                        @foreach ($units as $unit)
                        <option value="{{ $unit}}" >{{ $unit}}</option>
                        @endforeach                            
                     </select>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="product_price" class="col-form-label col-md-2">Price</label>
                  <div class="col-md-4">
                     <input type="number" class="form-control" name="product_price" min="0" required="" autocomplete="off">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="product_description" class="col-form-label col-md-2">Description</label>
                  <div class="col-md-4">
                     <input type="text" class="form-control" name="product_description" required="" autocomplete="off">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="ctn_value" class="col-form-label col-md-2">Quantity/Carton</label>
                  <div class="col-md-4">
                     <input type="number" class="form-control" name="ctn_value" min="0" required="" autocomplete="off">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="filenames" class="col-form-label col-md-2">Product Image</label>
                  <div class="col-md-4">
                  <input type="file" class="form-control" name="filenames"  required=""  autocomplete="off" >
                  </div>
               </div>
               <div class="form-group mb-0 row">
                  <div class="col-md-10">
                     <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Add Product</button>
                     </div>
                  </div>
               </div>               
            </form>
         </div>
      </div>
   </div>
</div>
<!-- /page Wrapper -->
<script>
    $(document).ready(function () {
    $('#product').validate({ // initialize the plugin
        rules: {
            product_name: {
                required: true
            },
            product_nick: {
                required: true,
            },
            product_size: {
                required: true,
                digits: true,
                minvalue : 1
            },
            unit: {
                required: true,
            },
            product_price: {
                required: true,
                minvalue: 1
            },
            ctn_value: {
                required: true,
                minvalue: 1  
            },
            filename: {
                required: true,
                extension: "jpeg|png"
            },
        }
    });
});
</script>
@endsection

