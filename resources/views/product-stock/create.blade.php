

@extends('layouts.master')
@section('content')
 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>Product Stock</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/DashBoard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Add Stock</li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->

<!-- Page Wrapper -->
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-header">
            <h4 class="card-title mb-0">New Stock</h4>
         </div>
         <div class="card-body">
         @if ($errors->any())
     @foreach ($errors->all() as $error)
         <div>{{$error}}</div>
     @endforeach
 @endif
            <form method="post" action="{{ route('store.productStock') }}"  enctype="multipart/form-data" id="product_stock">
               @csrf 
               <div class="form-group row">
                  <label for="product_id" class="col-form-label col-md-2">Product Name</label>
                  <div class="col-md-4">
                     <select class="form-control" name="product_id" required="" autocomplete="off">
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
                     <input type="date" class="form-control" name="manufactured_date" required="" autocomplete="off">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="expire_date" class="col-form-label col-md-2">Expire Date</label>
                  <div class="col-md-4">
                     <input type="date" class="form-control" name="expire_date" id="expire_date" required="" autocomplete="off">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="manufactured_quantity" class="col-form-label col-md-2">Manufactured Quantity</label>
                  <div class="col-md-4">
                     <input type="number" min="1" class="form-control" name="manufactured_quantity" id="manufactured_quantity" required="" autocomplete="off">
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

<script>
    $(document).ready(function () {
    $('#product_stock').validate({ // initialize the plugin
        rules: {
         product_id: {
                required: true
            },
         manufactured_date: {
                required: true,
            },
         expire_date: {
                required: true,       
            },
         manufactured_quantity: {
                required: true,
                digits: true,
                minvalue: 1 ,
            },
        }
    });
});
</script>
@endsection