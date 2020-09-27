@extends('layouts.master')
@section('content')
 
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Vendor Ledger</h5>
                            <div class="card-body">
                                <div class="table-responsive">
<form method="post"  action="/vendorLedger" >    
@csrf                            
<table>
<tr>
<td width="33%">
<lable>Vendors</lable>
<select name="vendor_id" class="form-control">
<option value="" >--All Vendors--</option>
@foreach($get_vendors as $get_vendors_list)

<option value="{{ $get_vendors_list->vendor_id }}" > {{ $get_vendors_list->name }}</option>

@endforeach
</select>
</td>

<td width="20%">
<lable>Date From</lable>
<input type="date" name="date_from" class="form-control" />
</td>

<td width="20%">
<?php $to_date = date('Y-m-d') ?>
<lable>Date To</lable>
<input type="date" name="date_to" value="<?php echo $to_date; ?>"  class="form-control" />
</td>
 
<td>
<lable> <br/> </lable>
<input type="submit" name="submit"  class="btn btn-success" value="Get Result" />
</td>
</tr>



</table>
</form>
<?php  if(isset($vendor_GL_details)) { $sr =1; ?>

                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                        <tr> 
                                        <td class="sorting_1">Sr#</td>
                                                <td class="sorting_1">Vendor ID</td>
                                                <td>Vendor Name</td>
                                                <td>Receid Qty</td>
                                                <td>Amount</td>
                                            </tr>
                                            <?PHP 
                                            $tot_ltr  = 0; 
                                            $tot_amt =0;
                                            ?>
                                @foreach ($vendor_GL_details as $vendor_GL)
                                
                               <?PHP 
                               $tot_ltr =  $tot_ltr +  $vendor_GL->received_qty;
                               $tot_amt =  $tot_amt +  $vendor_GL->amounts;
                               ?>

                                <tr role="row" >
                                <td>{{ $sr }}</td>
                                                <td  >{{ $vendor_GL->vendor_id }}</td>
                                                <td>{{ $vendor_GL->name }}</td>
                                                <td>{{ $vendor_GL->received_qty }} ltr</td>
                                                <td>{{ $vendor_GL->amounts }}</td>
                                                 
                                                
                                            </tr>
<?php $sr++; ?>
                                            @endforeach
                                        </tbody>
                                        <tr>
                                        <td colspan=3>Total</td>
                                        <td>  {{ $tot_ltr }}</td>
                                        <td>  {{ $tot_amt }}</td>
                                        </tr>
                                        <tfoot>
                                           
                                        </tfoot>
                                    </table>
<?php  } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end basic table  -->
                    <!-- ============================================================== -->
                </div>
@endsection