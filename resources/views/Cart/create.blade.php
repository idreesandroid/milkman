@extends('layouts.master')
@section('content')

<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">E-COMMERCE CART</h1>
     </div>
</section>

<div class="container mb-4">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            
                            <th scope="col">Product</th>
                            <th scope="col">Available</th>
                            <th scope="col" >Quantity</th>
                            <th scope="col" >Price</th>
                            <th scope="col" >Sub Total</th>
                            <th scope="col" >Manage Batch</th>

                       
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                           
                            <td>Product Name Dada</td>
                            <td>In stock</td>                            
                            <td><input class="form-control col-md-4" type="text" value="1" /></td>
                            <td >124,90 €</td>
                            <td>PXQ</td>
                            <td><button class="form-control btn btn-sm btn-primary">Batch</button> </td>
                        </tr>
                    
                       
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td ><strong>346,90 €</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col mb-2">
            <div class="row">
                <div class="col-sm-12  col-md-6">
                    <button class="btn btn-block btn-light">Continue Shopping</button>
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                    <button class="btn btn-lg btn-block btn-success text-uppercase">Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
