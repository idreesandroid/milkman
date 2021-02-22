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
         <li class="breadcrumb-item"><a href="{{route('user.dashBoard')}}">Dashboard</a></li>
         <li class="breadcrumb-item active">Product Stock List</li>
      </ul>
   </div>
</div>
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-body">
            <!-- <h6 class="card-title">Bottom line justified</h6> -->            
            <div class="tab-content">                           
               <div class="tab-pane show active" id="systemUsers">
                  <div class="row">
                  @can('Create-Product-Stock')                                 
                     <div class="col text-right">
                        <ul class="list-inline-item pl-0">
                           <li class="list-inline-item">
                              <a  href="/product-stock/create"class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded">Add Stock</a>
                           </li>
                        </ul>
                     </div>
                  @endcan                 
                  </div>  
                  <div class="table-responsive">
                     <table class="datatable table table-stripped mb-0 datatables" id="productLising">
                        <thead>
                           <tr>                              
                              <th>Product Name</th>
                              <th>Batch ID</th>
                              <th>Manufacture</th>
                              <th>Expiry</th>
                              <th>Quantity</th>
                              <th>Current Stock</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($product_stocks as $index => $product_stock)
                           <tr>
                              <td>{{$product_stock->product->product_name}}</td>
                              <td>{{$product_stock->batch_name}}</td>
                              <td>{{timeFormat($product_stock->manufactured_date)['date']}}</td>
                              <td>{{timeFormat($product_stock->expire_date)['date']}}</td>
                              <td>{{number_format($product_stock->manufactured_quantity)}}</td>
                              <td>{{number_format($product_stock->stockInBatch)}}</td>
                          
                              <td>
                              @can('Edit-Product-Stock')  <a href="{{ route('edit.productStock', $product_stock->id)}}" class="btn btn-outline-success">Edit</a>  @endcan 
                              @can('Delete-Product-Stock')
                              <form action="{{ route('delete.productStock', $product_stock->id)}}" method="post" style="display: inline-block"> 
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger" type="submit">Delete</button>
                                 </form>@endcan
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
 <?php //exit(); ?>
<!-- /Page Wrapper -->
<script>
   $(document).ready( function () {
      $('#productLising').DataTable({
        "columns": [
          { "width": "15%" },
          { "width": "20%" },
          { "width": "10%" },
          { "width": "15%" },
          { "width": "10%" },
          { "width": "15%" },
          { "width": "15%" },
        ]
      });
});
</script>
@endsection

