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
                    <label for="buyer_id" class="col-form-label col-md-2">Buyer Name</label>
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
                            <th scope="col">ID</th>
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
                            <td>{{$product->id}}</td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->currentInStock}}</td>                            
                            <td>{{$product->product_price}}</td>                      
                            <td><input class="form-control col-md-4" type="text" id="quantity" /></td>                            
                            <td>PXQ</td>
                            <td><button class="form-control btn btn-sm btn-primary">Batch</button> </td>
                            @endforeach 
                        </tr>
                    
                       
                        <tr>
                           <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td ><strong>346,90 €</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col mb-2">
            <div class="row">
                <div class="col-sm-12  col-md-6">
                    <button class="btn btn-block btn-primary text-uppercase">Save</button>
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                    <button class="btn btn-lg btn-block btn-success text-uppercase">Checkout</button>
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
$(document).ready(function() {	  
    $("#quantity").on('change', function() {			
        var quantityValue = $("#quantity").val();
        // alert("Done");	
        //alert(quantityValue);
        if(batchID != 0 ) {
     $.ajax({				
                url: '/Cart/batchId/ajax/'+batchID,
                type: "GET",
                dataType: "json",
                success:function(data) { 
                   // alert("Done");              
                    $("#batch_name").empty();
                    $.each(data, function(key, value) {                     
                    $("#batch_name").append('<option value="'+value.id+'">'+ value.batch_name +'</option>');
                    });
                }
            });
           
        }else{
            $("#batch_name").empty();
        }
    });
});
</script>

            
            @endsection