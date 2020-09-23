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
                                                <th>Name</th>
                                                <th>Size</th>
                                                <th>Price</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                            <tr>
                                            <td>{{$product->id}}</td>
                                            <td>{{$product->product_name}}</td>
                                            <td>{{$product->product_size}}</td>
                                            <td>{{$product->product_price}}</td>
                                                
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