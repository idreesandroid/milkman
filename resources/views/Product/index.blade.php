
@extends('layouts.master')
@section('content')
			
<!-- Page Wrapper -->
           

					

    <div class="row">
        <div class="col-sm-12">
            <div class="card mb-0">


                
                <div class="card-body">

                @can('Create-Product')
                <div class="form-group mb-0 row">                
                        <div class="col-md-4">                           
                            <div class="input-group-append">
                            <a href="/product/create" class="active"> <button class="btn btn-primary" type="button">Add Product</button></a>
                            </div>                           
                        </div>
                    </div>
                @endcan
                    <div class="table-responsive">
                        <table class="datatable table table-stripped mb-0 datatables">
                            <thead>
                                <tr> 
                                <th>Serial No</th>                               
                                <th>Image</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Stock Quantity</th>
                                <th>Qty/Carton</th>
                                <th>Description</th> 
                                <th>Action</th>                           
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $index => $product)
                            <tr>   
                            <td>{{$index+1}}</td>                        
                            <td><img src="{{asset('/product_img/'.$product->filenames)}}" alt="Logo" class="img-thumbnail"></td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->product_nick}}</td>
                            <td>{{$product->product_size}} {{$product->unit}} </td>
                            <td>{{$product->product_price}}</td>
                            <td>{{$product->stockInBatch}}</td>                            
                            <td>{{$product->ctn_value}}</td>
                            <td>{{$product->product_description}}</td>                         
                            
                            <td><a href="{{ route('edit.product', $product->id)}}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('delete.product', $product->id)}}" method="post" style="display: inline-block">
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

		       

	