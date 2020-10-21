@extends('layouts.master')
@section('content')
 
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Vendor Ledger</h5>
                            <div class="card-body">
 <div class="table-responsive">
                                <button style="float:right;"  onclick='printDiv("DivIdToPrint");'>Print</button>
<div id='DivIdToPrint'>
<img src="{{asset('assets/img/logo.png')}}" width="100" style="float:right;" />

 



                                    <table  border=1  style="border-collapse: collapse;width:100%;">
                                        <thead>
                                        <tr> 
                                        <th class="sorting_1">Sr#</th>
                                                
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
                                    @foreach($payment_request_detail as $index => $payment_requset)
                                    <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $payment_requset->name }}</td>
                                    <td>{{ $payment_requset->claim_amount }}</td>
                                    <td>{{ $payment_requset->user_cnic }}</td>
                                    <td>{{ $payment_requset->user_phone }}</td>
                                    <td>{{ $payment_requset->user_address }}</td>
                                    
                                    <td></td>
                                    </tr>


                                    @endforeach

                                        
                                        </tfoot>
                                    </table>
 <hr/>


 
 <h2 class="card-header">Comments</h2>
 <table  border=1  style="border-collapse: collapse;width:100%;">
                                        <thead>
                                        <tr> 
                                        <th class="sorting_1">Sr#</th>
                                                
                                                <th>Comments</th>
                                                <th>Comment By</th>
                                                <th>Comment Date</th>
                                                 
                                            </tr>
                                     </thead>
                                            
                                        </tbody>
                                        <tfoot>
                                         
@foreach($get_comments_list as $index => $get_comments)
<tr>
<td>{{$index+1}}</td>
<td>{{$get_comments->commnet_text}}</td>
<td>{{$get_comments->name}}  - {{ $get_comments->mark_from_role_title}}</td>
<td>{{$get_comments->entry_date}}</td>
</tr>
 
@endforeach

</table>

 
                    </div>

                                </div>
                            </div>


             




  
                           

                    @if(session()->get('hierarchy_role') <  25)
                 <br/>     <br/>     <br/>     <br/>

               
                 <h2 class="card-header">Claim Your Payment</h2>
                <form method="post" action="/payment_next_back">
                @csrf
                <input type="hidden"  name="request_id" required value="{{$payment_requset->id}}"/>
        <div class="row">
               
                <div class="col-md-6">
                    <label>Enter Your Remarks</label>
    <textarea  class="form-control" name="commnet_text"    required=""  autocomplete="off"></textarea>
                </div>

        <div class="col-md-6">
        <label>&nbsp; </label>
        <br/>

        <input type="submit" class="btn btn-danger" name="submit_next_back" value="Back" required=""> 
        <input type="submit" class="btn btn-success" name="submit_next_back" value="Next" required="">  

        </div>

        </div>



        </form>
        <br/>     <br/> <br/>     <br/>


  @endif
  </div>
   
   </div>
   <!-- ============================================================== -->
   <!-- end basic table  -->
   <!-- ============================================================== -->
      
               
                </div>
@endsection