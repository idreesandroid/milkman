@extends('layouts.master')
@section('content')
		
			
						
			<!-- Page Wrapper -->
					
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Add To Cart</h4>
            </div>
            <div class="card-body">
                <form method="post">
                @csrf 

                <div class="form-group row">
                    <label for="buyer_id" class="col-form-label col-md-2">Buyer Name</label>
                    <div class="col-md-4">
                        <select class="form-control" name="buyer_id"  id="buyer_id" required="">
                            <option value="">--Buyer Name--</option>
                            @foreach ($invoices as $invoice)
                             <option value="{{ $invoice->buyer_id}}" >{{ $invoice->buyer_id}}</option>                             
                             @endforeach                            
                        </select>
                    </div>
                </div>


                <div class="form-group row">
                <label for="invoice_id" class="col-form-label col-md-2">Select Invoice</label>
                <div class="col-md-4">
                <select name="invoice_id" class="form-control" id="invoice_id" >
                </select>
                </div>
                </div>
               

                <div class="form-group row">
                    <label for="product_id" class="col-form-label col-md-2">Product Name</label>
                    <div class="col-md-4">
                        <select class="form-control" name="product_id" required="" id="product_id">
                            <option value="">--Product Name--</option>
                            @foreach ($products as $product)
                             <option value="{{ $product->id}}" >{{ $product->product_name}}</option>
                             @endforeach                            
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                <label for="batch_id" class="col-form-label col-md-2">Batch ID</label>
                <div class="col-md-4">
                <select name="batch_id" class="form-control" id="batch_name" >
                </select>
                </div>
                </div>
               

                <div class="form-group row">
                    <label for="product_quantity" class="col-form-label col-md-2">Quantity</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="product_quantity" required="">
                    </div>
                </div>

                <div class="form-group mb-0 row">                
                    <div class="col-md-10">                           
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">For More Shopping</button>
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
    
    $("#buyer_id").on('change', function() {			
        var stateID = $("#buyer_id").val();
        // alert("Done");	
   // alert(stateID);
        if(stateID != 0 ) {
     $.ajax({				
                url: '/Cart/createCart/ajax/'+stateID,
                type: "GET",
                dataType: "json",
                success:function(data) { 
                   // alert("Done");              
                    $("#invoice_id").empty();
                    $.each(data, function(key, value) {                     
                    $("#invoice_id").append('<option value="'+value.id+'">'+ value.invoice_number +'</option>');
                    });
                }
            });
           
        }else{
            $("#invoice_id").empty();
        }
    });
});
</script>

<script type="text/javascript">		
$(document).ready(function() {	  
    $("#product_id").on('change', function() {			
        var batchID = $("#product_id").val();
        // alert("Done");	
        // alert(batchID);
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
            @endSection      

         