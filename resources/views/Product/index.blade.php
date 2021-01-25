@extends('layouts.master')
@section('content')
 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>Products</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/DashBoard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Products List</li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->
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
                      
                        <th>Image</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Size</th>
                        <th>Price</th>
                        @can('See-Product-Stock')<th>Stock Quantity</th> @endcan
                        <th>Qty/Carton</th>
                        <th>Description</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($products as $index => $product)
                     <tr>
                        
                        <td><img src="{{asset('/product_img/'.$product->filenames)}}" alt="Logo" class="img-thumbnail"></td>
                        <td>{{$product->product_name}}</td>
                        <td>{{$product->product_nick}}</td>
                        <td>{{$product->product_size}} {{$product->unit}} </td>
                        <td>Rs {{number_format($product->product_price)}}</td>
                        @can('See-Product-Stock')  <td>{{$product->stockInBatch}}</td> @endcan
                        <td>{{$product->ctn_value}}</td>
                        <td>{{$product->product_description}}</td>
                        <td>
                           <a href="{{ route('edit.product', $product->id)}}" class="btn btn-primary">Edit</a>
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

