@extends('layouts.master')
@section('content')
    <!-- ============================================================== -->
    <!-- Edit Product -->
    <!-- ============================================================== -->
    <form method="post"  class="splash-container" action="{{ route('update.product', $products->id) }}">
    @csrf 
<div class="card">
<div class="card-header">
        <h3 class="mb-1">Edit Product</h3>
        <p>Please update your product information.</p>
 
    </div>
    <div class="card-body">
        
      

        <div class="form-group">
            <input class="form-control form-control-lg" type="text" name="product_name"  value="{{ $products->product_name }}" required="" placeholder="Name" autocomplete="off">
        </div>
         
        <div class="form-group">
            <input class="form-control form-control-lg" type="text" name="product_size" value="{{ $products->product_size }}" required="" placeholder="Size" autocomplete="off">
        </div>

        <div class="form-group">
            <input class="form-control form-control-lg" type="text" name="product_price" value="{{ $products->product_price }}" required="" placeholder="Price" autocomplete="off">
        </div>
        
        <div class="form-group pt-2">
            <button class="btn btn-block btn-primary" type="submit">ADD Product</button>
        </div>
      
     
     
    
    </div>      
</div>   


 </form>
 @endsection


@section('scripts')

@endsection