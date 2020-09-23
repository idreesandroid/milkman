@extends('layouts.master')
@section('content')
    <!-- ============================================================== -->
    <!-- Edit Product -->
    <!-- ============================================================== -->
    <form method="post"  class="splash-container" action="{{ route('update.productStock', $product_stocks->id) }}">
    @csrf 
<div class="card">
<div class="card-header">
        <h3 class="mb-1">Edit Product</h3>
        <p>Please update your product information.</p>
 
    </div>
    <div class="card-body">
        


         <div class="form-group">
            <?php $showValue = $product_stocks->product_id; ?>
            <select class="form-control form-control-lg" type="text" required name="product_id"  >
             @foreach ($products as $product)
             <option value="{{ $product->id}}" <?php echo ($showValue == $product->id) ? 'selected' : '' ?>  >{{ $product->product_name}}</option>
             @endforeach

            </select>
        </div>
   

         

        <div class="form-group">
            <input class="form-control form-control-lg" type="text" name="batch_name"  value="{{ $product_stocks->batch_name }}" required=""  autocomplete="off">
        </div>
         
        <div class="form-group">
            <input class="form-control form-control-lg" type="text" name="manufactured_date" value="{{ $product_stocks->manufactured_date }}" required=""  autocomplete="off">
        </div>

        <div class="form-group">
            <input class="form-control form-control-lg" type="text" name="expire_date" value="{{ $product_stocks->expire_date }}" required=""  autocomplete="off">
        </div>

        <div class="form-group">
            <input class="form-control form-control-lg" type="text" name="manufactured_quantity" value="{{ $product_stocks->manufactured_quantity }}" required=""  autocomplete="off">
        </div>
        
        <div class="form-group pt-2">
            <button class="btn btn-block btn-primary" type="submit">Update Product Stock</button>
        </div>
      
     
     
    
    </div>      
</div>   


 </form>
 @endsection


@section('scripts')

@endsection