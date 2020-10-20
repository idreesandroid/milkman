
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
                                <th>Buyer Name</th>
                                <th>Invoice No</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Date</th>                                                             
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $invoice)
                            <tr>
                            <td>{{$invoice->buyer->name}}</td>                            
                            <td>{{$invoice->invoice_number}}</td>
                            <td>{{$invoice->total_amount}}</td>
                            <td>{{$invoice->flag}}</td>
                            <td>{{$invoice->created_at}}</td>                            
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