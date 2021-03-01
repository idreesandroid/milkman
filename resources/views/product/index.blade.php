@extends('layouts.master')
@section('content')
 <!-- Page Header -->
<div class="crms-title row bg-white mb-4">
   <div class="col">
      <h3 class="page-title">
         <span class="page-title-icon bg-gradient-primary text-white mr-2">
         <i class="la la-table"></i>
         </span> <span>Products</span>
      </h3>
   </div>
   <div class="col text-right">
      <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
         <li class="breadcrumb-item"><a href="{{route('user.dashBoard')}}">Dashboard</a></li>
         <li class="breadcrumb-item active">Product List</li>
      </ul>
   </div>
</div>
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-body">                      
            <div class="tab-content">                           
               <div class="tab-pane show active" id="systemUsers">
                  <div class="row">
                  @can('Create-Product')                                 
                     <div class="col text-right">
                        <ul class="list-inline-item pl-0">
                           <li class="list-inline-item">
                              <a  href="/product/create"class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded">Add Product</a>
                           </li>
                        </ul>
                     </div>
                  @endcan                 
                  </div>  
                  <div class="table-responsive">
                     <table class="datatable table table-stripped mb-0 datatables" id="productLising">
                        <thead>
                           <tr>
                              <th>Name</th>                       
                              <th>Size</th>
                              <th>Price</th>
                              @can('See-Product-Stock')
                              <th>Stock Quantity</th>
                              @endcan
                              <th>Qty/Carton</th>
                              <th>Description</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($products as $index => $product)
                           <tr>                              
                              <td>{{$product->product_name}} ({{$product->product_nick}})</td>                        
                              <td>{{$product->product_size}} {{$product->unit}} </td>
                              <td>{{number_format($product->product_price)}}</td>
                              @can('See-Product-Stock')  
                              <td>{{$product->stockInBatch}}</td>
                              @endcan
                              <td>{{$product->ctn_value}}</td>
                              <td>{{$product->product_description}}</td>
                              <td>
                                 <a href="{{ route('edit.product', $product->id)}}" class="btn btn-outline-success">Edit</a>
                                 <form action="{{ route('delete.product', $product->id)}}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger" type="submit">Delete</button>
                                 </form>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>                     
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- /Page Wrapper -->
<script>
   $(document).ready( function () {
      $('#productLising').DataTable({
        "columns": [
          { "width": "20%" },
          { "width": "10%" },
          { "width": "10%" },
          { "width": "10%" },
          { "width": "10%" },
          { "width": "25%" },
          { "width": "15%" },
        ]
      });
});
</script>
@endsection

