
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
                                <th>Product Name</th>
                                <th>Batch ID</th>
                                <th>Manufacture Date</th>
                                <th>Expiry Date</th>
                                <th>Manufacture Quantity</th>
                                <th>Entered By</th>
                                <th>Action</th>                             
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($product_stocks as $product_stock)
                            <tr>
                            <td>{{$product_stock->id}}</td>
                            <td>{{$product_stock->product->product_name}}</td>
                            <td>{{$product_stock->batch_name}}</td>
                            <td>{{$product_stock->manufactured_date}}</td>
                            <td>{{$product_stock->expire_date}}</td>
                            <td>{{$product_stock->manufactured_quantity}}</td>
                            <td>{{$product_stock->manager_id}}</td>
                            <td><a href="{{ route('edit.productStock', $product_stock->id)}}" class="btn btn-primary">Edit</a>  
                            <form action="{{ route('delete.productStock', $product_stock->id)}}" method="post" style="display: inline-block">
                             @csrf
                            @method('DELETE')
                             <button class="btn btn-danger btn-sm" type="submit">Delete</button>
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
				
				
			<!-- /Page Wrapper -->
 @endsection