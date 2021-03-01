

@extends('layouts.master')
@section('content')
 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>Milk Process</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/DashBoard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Request Milk</li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->

<!-- Page Wrapper -->
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-header">
            <h4 class="card-title mb-0">Milk Process</h4>
         </div>
         <div class="card-body">
         @if ($errors->any())
            @foreach ($errors->all() as $error)
               <div>{{$error}}</div>
            @endforeach
         @endif
            <form method="post" action="{{route('store.milkRequest')}}">
               @csrf 

               <div class="form-group row">
                  <label for="milkBank_id" class="col-form-label col-md-2">Milk Bank Name</label>
                  <div class="col-md-6">
                     <select class="form-control" name="milkBank_id" required="" autocomplete="off">
                        <!-- <option value="">--Milk Bank Name--</option> -->
                        @foreach ($milkBanks as $milkBank)
                        <option value="{{ $milkBank->id}}" >{{$milkBank->bankName}}</option>
                        @endforeach                            
                     </select>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="product_id" class="col-form-label col-md-2">Product Name</label>
                  <div class="col-md-6">
                     <select class="form-control" name="product_id" required="" autocomplete="off">
                        <option value="">--Product Name--</option>
                        @foreach ($products as $product)
                        <option value="{{ $product->id}}" >{{ $product->product_name}}</option>
                        @endforeach                            
                     </select>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="milkQuantity" class="col-form-label col-md-2">Milk Quantity</label>
                  <div class="col-md-6">
                     <input type="number" min="1" class="form-control" name="milkQuantity" id="milkQuantity" required="" autocomplete="off"> Ltr
                  </div>
               </div>

               <div class="form-group row">
                  <label for="processDescription" class="col-form-label col-md-2">Request Description</label>
                  <div class="col-md-6">
                     <input type="textarea" class="form-control" name="processDescription" id="processDescription" required="" autocomplete="off">
                  </div>
               </div>
               <div class="form-group mb-0 row">
                  <div class="col-md-6">
                     <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Request Milk</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- /page Wrapper -->
@endsection