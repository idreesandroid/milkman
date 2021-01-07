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

            <div class="table-responsive">
               <table class="datatable table table-stripped mb-0 datatables">
                  <thead>
                     <tr>
                        <th>Serial No</th>
                        <th>Invoice No</th>
                        <th>Name</th>
                        <th>Payment Method</th>
                        <th>Bank Name</th>
                        <th>Branch Name</th>
                        <th>Account No</th>
                        <th>Card No</th>
                        <th>Transaction Id</th>
                        <th>Sender CNIC</th>
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
                     @foreach($invoices as $index => $invoice)
                     <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$invoice->invoice_no}}</td>
                        <td>{{$invoice->distributor_id}}</td>
                        <td>{{$invoice->paymentMethod}}</td>
                        <td>{{$invoice->bank_name}}</td>
                        <td>{{$invoice->branchName}}</td>
                        <td>{{$invoice->acc_No}}</td>
                        <td>{{$invoice->cardLastDigits}}</td>
                        <td>{{$invoice->transactionId}}</td>
                        <td>{{$invoice->senderCNIC}}</td>
                        <td>{{$invoice->senderCell}}</td>
                        
                        <td>{{$invoice->depositorName}}</td>
                        <td>{{$invoice->receiverName}}</td>
                        <td>{{$invoice->receiverCNIC}}</td>
                        <td>{{$invoice->amountPaid}}</td>
                        <td>{{$invoice->timeOfDeposit}}</td>
                        <td>{{$invoice->status}}</td>
                        <td><img src="{{asset('/receipt_img/'.$invoice->receiptPics)}}" alt="Logo" class="img-thumbnail"></td>
                        <form method="post" action="{{route ('verify.transaction', $invoice->id) }}">
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

