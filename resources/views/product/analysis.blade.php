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
        <h6 class="card-title">Products Analysis</h6>
        <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
          <li class="nav-item"><a class="nav-link active" href="#ProductInStockAnalysis" data-toggle="tab">Product In Stock Analysis</a></li>          
          <li class="nav-item"><a class="nav-link" href="#OrderAnalysis" data-toggle="tab">Order Analysis</a></li>
        </ul>
        <div class="tab-content">          
          <div class="tab-pane show active" id="ProductInStockAnalysis">
            <div class="row">
               <div class="col-md-12">
                  <div class="card">
                     <div class="card-body">
                        <!-- <h6 class="card-title">Bottom line justified</h6> -->            
                        <div class="tab-content">                           
                           <div class="tab-pane show active" id="systemUsers">                   
                              <div class="table-responsive">
                                 <table class="datatable table table-stripped mb-0 datatables" id="productInStockAnalysisData">
                                    <thead>
                                       <tr>                              
                                          <th>Name</th>                       
                                          <th>Production Date</th>
                                          <th>Product Unit Price</th>
                                          <th>Product Produced</th>
                                          <th>Total Amount</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($product_stocks as $product)
                                      <tr>                              
                                          <td>{{$product->product_name}}</td>
                                          <td>{{ date("m-d-Y H:i:s", strtotime($product->stockDate)) }}</td>  
                                          <td>{{$product->product_price}}</td>
                                          <td>{{$product->mfquentity}}</td>
                                          <td>{{number_format($product->mfquentity * $product->product_price,2)}}</td>
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
          </div>
          <div class="tab-pane" id="OrderAnalysis">
            <div class="row">
               <div class="col-md-12">
                  <div class="card">
                     <div class="card-body">
                        <!-- <h6 class="card-title">Bottom line justified</h6> -->            
                        <div class="tab-content">                           
                           <div class="tab-pane show active" id="systemUsers">                   
                              <div class="table-responsive">
                                 <table class="datatable table table-stripped mb-0 datatables" id="productOrderAnalysis">
                                    <thead>
                                       <tr>                              
                                          <th>Name</th>                       
                                          <th>Order Date</th>
                                          <th>Product Price</th>
                                          <th>Product Order</th>
                                          <th>Amount</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($products as $product)
                                      <tr> 
                                        <!-- date("m-d-Y", strtotime($product->orderdate)); -->
                                        <!-- date_format(strtotime($product->orderdate),"d-m-Y H:i:s")  -->                            
                                          <td>{{$product->product_name}}</td>
                                          <td>{{ date("m-d-Y H:i:s", strtotime($product->orderdate)) }}</td>
                                          <td>{{$product->product_price}}</td>
                                          <td>{{$product->orderquentity}}</td>
                                          <td>{{number_format($product->orderquentity * $product->product_price,2)}}</td>
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

    

      $('#productOrderAnalysis').DataTable({        
       "order": [[ 1, "desc" ]]
      });

      

      $('#productInStockAnalysisData').DataTable({        
       "order": [[ 1, "desc" ]]
      });

});
</script>
@endsection

