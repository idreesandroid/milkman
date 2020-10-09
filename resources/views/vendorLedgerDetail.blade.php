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

<?php  if(isset($vendor_GL_details)) { $sr =1; ?>
Vendor ID: <?php echo $vendor_id_d; ?>
<br/>
Vendor Name: <?php echo $name_d; ?>
<br/>
Vendor CNIC: <?php echo $user_cnic_d; ?>



                                    <table  border=1  style="border-collapse: collapse;width:100%;">
                                        <thead>
                                        <tr> 
                                        <th class="sorting_1">Sr#</th>
                                                
                                                <th>Reveived Date</th>
                                                <th>Reveived Qty (Ltr)</th>
                                                <th>Rate</th>
                                                <th>Amount (Debit)</th>
                                                <th>Amount (Credit)</th>
                                            </tr>
                                     </thead>
                                            <?PHP 
                                            $tot_ltr  = 0; 
                                            $tot_amt_dr =0;
                                            $tot_amt_cr =0;
                                            ?>
                                @foreach ($vendor_GL_details as $vendor_GL)
                                
                               <?PHP 
                               $tot_ltr =  $tot_ltr +  $vendor_GL->received_qty;
                               $tot_amt_dr =  $tot_amt_dr +  $vendor_GL->dr_amount;
                               $tot_amt_cr =  $tot_amt_cr +  $vendor_GL->cr_amount;
                               ?>

                                <tr role="row" >
                                <td>{{ $sr }}</td>
                                                
                                                <td>{{ $vendor_GL->received_date_time }}</td> 
                                                 <td  style="text-align:center;">
                                                 {{ $vendor_GL->received_qty }}
                                                 {{ $vendor_GL->payment_detail }}
                                                 
                                                 
                                                 </td>
                                                 <td> {{ $vendor_GL->rate }}</td>
                                                <td style="text-align:right;">
                                                 
                                                <?php echo   number_format($vendor_GL->dr_amount,2); ?>
                                                 
                                                </td>
                                                <td style="text-align:right;">
                                                 
                                                <?php echo   number_format($vendor_GL->cr_amount,2); ?>
                                                  
                                                 </td>
                                                
                                            </tr>
                        <?php $sr++; ?>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                        <td colspan=3>Total</td>
                                        <td >  {{ $tot_ltr }} Ltr </td>
                                        <td style="text-align:right;"> <?php echo   number_format($tot_amt_dr,2); ?></td>
                                        <td style="text-align:right;"> <?php echo   number_format($tot_amt_cr,2); ?></td>
                                        </tr>
                                      
                                           
                                        <tr>
                                        <td colspan=4>Balance </td>
                                         
                                        
                                        <td colspan=3 style="text-align:center;"> <?php
                                        $balances  = $tot_amt_dr - $tot_amt_cr;
                                        
                                        
                                        echo number_format($balances,2) ;   ?></td>
                                        </tr>
                                        </tfoot>
                                    </table>
<?php  } ?>

                    </div>

 @if(session()->get('user_role')==5)
                 <br/>     <br/>     <br/>     <br/>

               
                 <h2 class="card-header">Claim Your Payment</h2>
                <form method="post" action="/payment_request">
                @csrf
        <div class="row">
        <div class="col-md-6">
        <label>Enter Amount</label>
        <input type="number" class="form-control" name="claim_amount" min="1" max="{{$balances}}"  required=""  autocomplete="off">   
        </div>

        <div class="col-md-6">
        <label>&nbsp; </label>
        <br/>
        <input type="submit" class="btn btn-success" name="claim_submit" value="Send" required="">   
        </div>

        </div>



        </form>
        <br/>     <br/> <br/>     <br/>


  @endif
                                </div>
                            </div>


             





            </div>
    
                    </div>
                    <!-- ============================================================== -->
                    <!-- end basic table  -->
                    <!-- ============================================================== -->
              

               
               
                </div>
@endsection