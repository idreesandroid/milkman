

@extends('layouts.master')
@section('content')

 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>Sale</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/DashBoard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Generate Invoice</li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->
<!-- Page Wrapper -->
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-header">
            <h4 class="card-title mb-0">Generate Invoice</h4>
         </div>
         <div class="card-body">
            <form method="post">
               @csrf 
               <div class="form-group row">
                  <label for="buyer_id" class="col-form-label col-md-2">Distributor Name</label>
                  <div class="col-md-4">
                     <select class="form-control" name="buyer_id" required="">
                        <option value="">--Buyer Name--</option>
                        @foreach ($buyers as $buyer)
                        <option value="{{ $buyer->id}}" >{{ $buyer->name}}</option>
                        @endforeach                            
                     </select>
                  </div>
               </div>
               <div class="container mb-4">
                  <div class="row">
                     <div class="col-12">
                        <div class="table-responsive">
                           <table class="table table-striped">
                              <thead>
                                 <tr>
                      
                                    <th scope="col">Image</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Available</th>
                                    <th scope="col" >Price</th>
                                    <th scope="col" >Sub Total</th>
                                    <th scope="col" >Quantity</th>
                                    <th scope="col" >Delivery Date</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    @foreach($products as $index => $product)
                                 <tr>
                                   
                                    <td><img src="{{asset('/product_img/'.$product->filenames)}}" alt="Logo" class="img-thumbnail" width="48" height="48"></td>
                                    <td>{{$product->product_name}}</td>
                                    <td>{{number_format($product->stockInBatch)}}</td>
                                    <td id="product_price_{{$product->id}}">{{number_format($product->product_price)}} Rs</td>
                                    <td id="sub_total_{{$product->id}}">0</td>
                                    <td><input type="number" class="form-control col-md-10"   name="product_quantity[{{$product->id}}]" min="0" max="{{$product->stockInBatch}}" id="quantity_{{$product->id}}" onkeyup="changeId({{$product->id}}, this.value )" /></td>
                                    <td><input type="date" class="form-control col-md-12"   name="delivery_date[{{$product->id}}]" id="delivery_date_{{$product->id}}" /></td>
                                    @endforeach 
                                 </tr>
                                 <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td><td></td>
                                    <td><strong>Total</strong></td>
                                    <td id="totalCost"><strong>0</strong></td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <div class="col mb-2">
                        <div class="row">
                           <div class="col-sm-12  col-md-4">
                           </div>
                           <div class="col-sm-12  col-md-4">
                              <button class="btn btn-block btn-primary text-uppercase" type="submit" name="action" value="on_hold" >Hold</button>
                           </div>
                           <div class="col-sm-12  col-md-4">
                              <button class="btn btn-block btn-primary text-uppercase" type="submit" name="action" value="checkout" >Proceed</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- /page Wrapper -->
<script type="text/javascript">
   function changeId(id, value)
   {
       var sumQua = $('#product_price_'+id).text() * value;
       var specSubTol = $('#sub_total_'+id).text();
       $('#sub_total_'+id).text(sumQua);
       var total = parseInt($('#totalCost').text()) - specSubTol + sumQua;
       $('#totalCost').text(total);
   }
</script>
@endsection

