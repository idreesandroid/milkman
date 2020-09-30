
@extends('layouts.master')
@section('content')
			
<!-- Page Wrapper -->
           

					
aasim
    <div class="row">
        <div class="col-sm-12">
            <div class="card mb-0">
                
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="datatable table table-stripped mb-0 datatables">
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Size</th>
                                <th>Price</th>      
                                <th>Action</th>                           
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                            <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->product_size}} {{$product->unit}} </td>
                            <td>{{$product->product_price}}</td>
                            <td><a href="{{ route('edit.product', $product->id)}}" class="btn btn-primary">Edit</a></td>
                                
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

		       

	