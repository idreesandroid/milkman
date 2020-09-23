@extends('layouts.master')
@section('content')
    <!-- ============================================================== -->
    <!-- signup form  -->
    <!-- ============================================================== -->
    <form method="post"  class="splash-container">
    @csrf 
<div class="card">
    <div class="card-header">
        <h3 class="mb-1">ADD Product</h3>
        <p>Please enter your product information.</p>
 
    </div>
    <div class="card-body">
        
      

        <div class="form-group">
            <input class="form-control form-control-lg" type="text" name="product_name" required="" placeholder="Name" autocomplete="off">
        </div>
         
        <div class="form-group">
            <input class="form-control form-control-lg" type="text" name="product_size" required="" placeholder="Size" autocomplete="off">
        </div>

        <div class="form-group">
            <input class="form-control form-control-lg" type="text" name="product_price" required="" placeholder="Price" autocomplete="off">
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