@extends('layouts/master')

@section('content')

<!-- basic table  -->
                    <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Product Table</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Product Name</th>
                                                <th>Batch ID</th>
                                                <th>Manufacture Date</th>
                                                <th>Expiry Date</th>
                                                <th>Manufacture Quantity</th>
                                                
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
                                                
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                           
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end basic table  -->
                    <!-- ============================================================== -->
                </div>
      

@endsection