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
                            <select class="form-control" name="user_id" required="">
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
                            <input type="text" class="form-control" name="amount" required="">
                        </div>
                    </div>
                 
                       <div class="form-group pt-2">
                        <button class="btn btn-block btn-primary" type="submit">Pay</button>
                        </div>  
                </form>
            </div>
        </div>
        
    </div>
</div>
				
			
			<!-- /page Wrapper -->
		
            @endsection