@extends('layouts.master')
@section('content')
 <!-- Page Header -->
<div class="crms-title row bg-white mb-4">
   <div class="col">
      <h3 class="page-title">
         <span class="page-title-icon bg-gradient-primary text-white mr-2">
         <i class="la la-table"></i>
         </span> <span>Products Analysis</span>
      </h3>
   </div>
   <div class="col text-right">
      <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
         <li class="breadcrumb-item"><a href="{{route('user.dashBoard')}}">Dashboard</a></li>
         <li class="breadcrumb-item active">Product Analysis</li>
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
                  <div class="table-responsive">
                     <table class="datatable table table-stripped mb-0 datatables" id="productAnalysis">
                        <thead>
                           <tr>                              
                              <th>Name</th>                       
                              <th>Date</th>
                              <th>Production</th>
                              <th>Cast</th>
                              <th>Order</th>
                              <th>Cast</th>
                              <th>Left</th>
                              <th>Cast</th>
                              <th>Return</th>
                              <th>Cast</th>
                           </tr>
                        </thead>
                        <tbody>
                        	@foreach($products as $product)
                        	<tr>                              
                              <td>{{$product->product_name}}</td>                       
                              <td>{{$product->orderdate}}</td>
                              <td>Production</td>
                              <td>Cast</td>
                              <td>{{$product->orderquentity}}</td>
                              <td>{{number_format($product->orderquentity * $product->product_price,2)}}</td>
                              <td>Left</td>
                              <td>Cast</td>
                              <td>Return</td>
                              <td>Cast</td>
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
      $('#productAnalysis').DataTable({
        "columns": [
          { "width": "10%" },
          { "width": "10%" },
          { "width": "10%" },
          { "width": "10%" },
          { "width": "10%" },
          { "width": "10%" },
          { "width": "10%" },
          { "width": "10%" },
          { "width": "10%" },
          { "width": "10%" },
        ],
       "order": [[ 1, "desc" ]]
      });
});
</script>
@endsection

