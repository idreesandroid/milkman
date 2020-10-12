@extends('layouts.master')
@section('content')
		
			
						
			<!-- Page Wrapper -->
					
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Payments</h4>
            </div>
            <div class="card-body">
                <form method="post">
                @csrf  
                    <div class="form-group row">
                        <label for="route_name" class="col-form-label col-md-2">Payment To</label>
                        <div class="col-md-10">
                            <select class="form-control" name="user_id" id="user_id"  required="">
<option value="">--Choose--</option>

@foreach($userList as $userLists)

<option value="{{$userLists->id}}">{{$userLists->name}}</option>

@endforeach
 </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="route_description" class="col-form-label col-md-2">Payment Detail</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="payment_detail" required="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="route_description" class="col-form-label col-md-2">Amount</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="amount" id="amount"  required="">
                        </div>
                    </div>
                 
                       <div class="form-group pt-2">
                        <button class="btn btn-block btn-primary" type="submit">Pay</button>
                        </div>  
                </form>
            </div> 
            
            <hr/>
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
  <a href="#" onclick="payment_data('<?php echo $payment_requset->u_id; ?>','<?php echo $payment_requset->claim_amount; ?>');" title="View Detail" >Pay</i></a> 
                                      </td>
                                    </tr>
 

                                    @endforeach

                                        
                                        </tfoot>
                                    </table>   
        </div>
       
    </div>
</div>
<script>
 function payment_data(u_id, amt){
 $('#user_id').val(u_id);
 $('#amount').val(amt);

 }
</script>
				
			
			<!-- /page Wrapper -->
		
            @endsection