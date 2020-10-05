
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
                                <th>Buyer Name</th>
                                <th>status</th>
                                <th>Action</th>                             
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $invoice)
                            <tr>
                            <td>{{$invoice->id}}</td>
                            <td>{{$invoice->buyer_id}}</td>                            
                            <td>{{$invoice->flag}}</td>
                            <td> <form action="{{ route('delete.invoice', $invoice->id)}}" method="post" style="display: inline-block">
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