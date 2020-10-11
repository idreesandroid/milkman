@extends('layouts.master')
@section('content')
 
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Vendor Ledger</h5>
                            <div class="card-body">
 <div class="table-responsive">
                                <button style="float:right;"  onclick='printDiv("DivIdToPrint");'>Print</button>
<div id='DivIdToPrint'>
 
 



                                    <table  border=1  style="border-collapse: collapse;width:100%;">
                                        <thead>
                                        <tr> 
                                        <th class="sorting_1">Sr#</th>
                                        <th>Request Date</th>
                                                <th>Vendor Name</th>
                                                <th>Claim Amount</th>
                                                <th>CNIC</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>
                                     </thead>
                                            
                                        </tbody>
                                        <tfoot>
                                    @foreach($payment_requset_list as $index => $payment_requset)
                                    <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $payment_requset->entry_date_time }}</td>
                                    <td>{{ $payment_requset->name }}</td>
                                    <td>{{ $payment_requset->claim_amount }}</td>
                                    <td>{{ $payment_requset->user_cnic }}</td>
                                    <td>{{ $payment_requset->user_phone }}</td>
                                    <td>{{ $payment_requset->user_address }}</td>
                                      <td>
                                     <a href="/payment_request_detail/{{ $payment_requset->id}}" title="View Detail" ><i class="fa fa-eye" aria-hidden="true"></i></a> 
                                      </td>
                                    </tr>
 

                                    @endforeach

                                        
                                        </tfoot>
                                    </table>
 
 
                    </div>

                                </div>
                            </div>


             





            </div>
    
                    </div>
                    <!-- ============================================================== -->
                    <!-- end basic table  -->
                    <!-- ============================================================== -->
              

               
               
                </div>
@endsection