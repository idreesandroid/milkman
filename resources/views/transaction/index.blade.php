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
                  <li class="breadcrumb-item"><a href="/">Payment</a></li>
                  <li class="breadcrumb-item active">Verification</li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->
<!-- Page Wrapper -->
<div class="row">
   <div class="col-sm-12">
      <div class="card mb-0">
         <div class="card-body">
         @can('Make-Transaction')
            <div class="form-group mb-0 row">
               <div class="col-md-4">
                  <div class="input-group-append">
                     <a href="/product/create" class="active"> <button class="btn btn-primary" type="button">New Transaction</button></a>
                  </div>
               </div>
            </div>
            @endcan
            <div class="table-responsive">
               <table class="datatable table table-stripped mb-0 datatables">
                  <thead>
                     <tr>
                        <th>Serial No</th>
                        <th>Account No</th>
                        <th>Name</th>
                        <th>Payment Method</th>
                        <th>Bank Name</th>
                        <th>Branch Name</th>
                        <th>Account No</th>
                        <th>Card No</th>
                        <th>Transaction Id</th>
                        <th>Sender Phone</th>
                        <th>Deposited By</th>
                        <th>Receiver Name</th>
                        <th>Receiver CNIC</th>
                        <th>Deposited Amount </th>
                        <th>Deposit Time</th>
                        <th>status</th>
                        <th>Image</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($transactions as $index => $transaction)
                     <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$transaction->userAcc_id}}</td>
                        <td>{{$transaction->user_id}}</td>
                        <td>{{$transaction->paymentMethod}}</td>
                        <td>{{$transaction->bank_name}}</td>
                        <td>{{$transaction->branchName}}</td>
                        <td>{{$transaction->acc_No}}</td>
                        <td>{{$transaction->cardLastDigits}}</td>
                        <td>{{$transaction->transactionId}}</td>
                        <td>{{$transaction->senderCell}}</td>
                        
                        <td>{{$transaction->depositorName}}</td>
                        <td>{{$transaction->receiverName}}</td>
                        <td>{{$transaction->receiverCNIC}}</td>
                        <td>{{$transaction->amountPaid}}</td>
                        <td>{{$transaction->timeOfDeposit}}</td>
                        <td>{{$transaction->status}}</td>
                        <td><img src="{{asset('/receipt_img/'.$transaction->receiptPics)}}" alt="Logo" class="img-thumbnail"></td>
                        <form method="post" action="{{route ('verify.transaction', $transaction->id) }}">
                    @csrf
                         <td><button class="btn btn-block btn-primary text-uppercase" type="submit" name="action" value="1" id="verified" >Verified</button></td>
                         <td><button class="btn btn-block btn-primary text-uppercase" type="submit" name="action" value="2" id="failed" >Failed</button></td>
                     </form>
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

