
@extends('layouts.master')
@section('content')
			
<!-- Page Wrapper -->
           

					

    <div class="row">
        <div class="col-sm-12">
            <div class="card mb-0">
                
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="datatable table table-stripped mb-0 datatables">
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th>Buyer Name</th>
                                <th>Invoice No</th>
                                <th>Product Name</th>
                                <th>Batch ID</th>
                                <th>Quantity</th>
                                <th>Product Rate</th> 
                                <th>Seller Name</th>
                                <th>Action</th>                             
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($saleViews as $saleView)
                            <tr>
                            <td>{{$saleView->id}}</td>
                            <td>{{$saleView->buyer->name}}</td>                            
                            <td>{{$saleView->bill_invoice->id}}</td>
                            <td>{{$saleView->product->product_name}}</td>
                            <td>{{$saleView->batch->batch_name}}</td>
                            <td>{{$saleView->product_quantity}}</td>
                            <td>{{$saleView->product->product_price}}</td>
                            <td>{{$saleView->buyer->name}}</td>
                            <td><a href="{{ route('edit.cart', $saleView->id)}}" class="btn btn-primary">Edit</a></td>   
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
				
				
			<!-- /Page Wrapper -->
 @endsection