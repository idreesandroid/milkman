@extends('layouts.master')
@section('content')
		
			
						
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
                            <option value="">--Distributor Name--</option>
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
                            <th scope="col" >Quantity</th>                            
                            <th scope="col" >Sub Total</th>
                            <th scope="col" >Manage Batch</th>                       
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        @foreach($products as $product)
                            <tr>                            
                            <td><img src="{{asset('/product_img/'.$product->filenames)}}" alt="Logo" class="img-thumbnail" width="100" height="100"></td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->currentInStock}}</td>                            
                            <td id="product_price_{{$product->id}}">{{$product->product_price}}</td>                      
                            <td><input class="form-control col-md-4 "  name="product_quantity[{{$product->id}}]" type="text" id="quantity_{{$product->id}}" onkeyup="changeId({{$product->id}}, this.value )" /></td>                            
                            <td id="sub_total_{{$product->id}}">0</td>
                            <td  >
                            <button type="button" class="form-control btn btn-sm btn-primary btn-info btn-lg" data-toggle="modal" data-target="#myModal" id="select_batch_{{$product->id}}">Batches</button>
                            
                            </td>
                            @endforeach 
                        </tr>
                                           
                        <tr>
                           <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td id="totalCost"><strong>0</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col mb-2">
            <div class="row">
                <div class="col-sm-12  col-md-6">
                    <button class="btn btn-block btn-primary text-uppercase" type="submit" name="action" value="save" >Save</button>
                </div>
                <div class="col-sm-12  col-md-6">
                    <button class="btn btn-block btn-primary text-uppercase" type="submit" name="action" value="checkout" >CheckOut</button>
                </div>

            </div>
        </div>
    </div>
</div>
 
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog" id="batch-info">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
                    <div class="table-responsive">
                        <table class="datatable table table-stripped mb-0 datatables">
                            <thead>
                                <tr>
                                <th>Batch ID</th>
                                <th>Manufacture Date</th>
                                <th>Expiry Date</th>
                                <th>Current Stock</th>  
                                <th>Select Quantity</th>                        
                                </tr>
                            </thead>
                            <tbody>
                           
                            </tbody>
                        </table>
                    </div>                				
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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