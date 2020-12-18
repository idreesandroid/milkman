@extends('layouts.master')
@section('content')
 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>MilkMan Dashboard</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/">Product Stock</a></li>
                  <li class="breadcrumb-item active">Stocks</li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->
<!-- Page Wrapper -->
<div class="row">
   <div class="col-sm-12">
      <div class="card mb-0">
         <div class="card-body">
         @can('Create-Product-Stock') <div class="form-group mb-0 row">
               <div class="col-md-4">
                  <div class="input-group-append">
                     <a href="/product-stock/create" class="active"> <button class="btn btn-primary" type="button">Add Stock </button></a>
                  </div>
               </div>
               @endcan
            </div>
            <div class="table-responsive">
               <table class="datatable table table-stripped mb-0 datatables">
                  <thead>
                     <tr>
                        <th>Serial No</th>
                        <th>Product Name</th>
                        <th>Batch ID</th>
                        <th>Manufacture Date</th>
                        <th>Expiry Date</th>
                        <th>Manufacture Quantity</th>
                        <th>Current Stock</th>
                        <th>Entered By</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($product_stocks as $index => $product_stock)
                     <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$product_stock->product->product_name}}</td>
                        <td>{{$product_stock->batch_name}}</td>
                        <td>{{$product_stock->manufactured_date}}</td>
                        <td>{{$product_stock->expire_date}}</td>
                        <td>{{$product_stock->manufactured_quantity}}</td>
                        <td>{{$product_stock->stockInBatch}}</td>
                        <td>{{$product_stock->user_id}}</td>
                        <td></td>
                        <td>
                        @can('Edit-Product-Stock')  <a href="{{ route('edit.productStock', $product_stock->id)}}" class="btn btn-primary">Edit</a>  @endcan 
                        @can('Delete-Product-Stock')   <form action="{{ route('delete.productStock', $product_stock->id)}}" method="post" style="display: inline-block"> 
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                           </form>@endcan
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

