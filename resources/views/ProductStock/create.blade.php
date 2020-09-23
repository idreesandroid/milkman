@extends('layouts.master')
@section('content')
    <!-- ============================================================== -->
    <!-- Product Stock form  -->
    <!-- ============================================================== -->
    <form method="post"  class="splash-container">
    @csrf 
<div class="card">
    <div class="card-header">
        <h3 class="mb-1">ADD Product Stock</h3>
        <p>Please enter your product Stock.</p>
 
    </div>
    <div class="card-body">
        

    <div class="card-body">
        <div class="form-group">
            <select class="form-control form-control-lg" type="text" required name="product_id"  >
            <option value="">--Product Name--</option>
            @foreach ($products as $product)
             <option value="{{ $product->id}}" >{{ $product->product_name}}</option>
             @endforeach

            </select>
        </div>
      

        <div class="form-group">
            <input class="form-control form-control-lg" type="text" name="batch_name" required="" placeholder="Batch Id" autocomplete="off">
        </div>
         
        <div class="form-group">
            <input class="form-control form-control-lg" type="date" name="manufactured_date" required="" placeholder="Manufacture Date" autocomplete="off">
        </div>

        <div class="form-group">
            <input class="form-control form-control-lg" type="date" name="expire_date" required="" placeholder="Expiry Date" autocomplete="off">
        </div>

        <div class="form-group">
            <input class="form-control form-control-lg" type="text" name="manufactured_quantity" required="" placeholder="Manufacture Quantity" autocomplete="off">
        </div>
        
        <div class="form-group pt-2">
            <button class="btn btn-block btn-primary" type="submit">ADD Product Stock</button>
        </div>
      
     
     
    
    </div>      
</div>   


 </form>
 @endsection


@section('scripts')

@endsection