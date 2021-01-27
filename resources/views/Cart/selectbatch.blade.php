

@extends('layouts.master')
@section('content')
 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>Sale</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/DashBoard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Select Batch</li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->
<!-- Page Wrapper -->
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-header">
            <h4 class="card-title mb-0"> Invoice</h4>
         </div>
         <div class="card-body">
            <!-- <form method="post">
               @csrf -->
            <div class="container mb-4">
               <div class="row">
                  <div class="col-12">
                     <div class="table-responsive">
                        <table class="table table-striped" id="tbl_bat_sel">
                           <thead>
                              <tr>
                                 <th>Invoice Number  :  {{$invoice_no}}</th>
                                 <th></th>
                                 <th>Buyer Name : {{$buyer_name}}</th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                                 <th></th>
                              </tr>
                              <tr>
                                 <th scope="col">Serial No</th>
                                 <th scope="col">Product</th>
                                 <th scope="col" >Price</th>
                                 <th scope="col" >Quantity</th>
                                 <th scope="col" >Sub Total</th>
                                 <th scope="col" >Delivery Date</th>
                                 <th scope="col" >Manage Batch</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 @foreach($carts as $index => $cart)
                              <tr>
                                 <td style="display:none;"  id="cid_{{$cart->product->id}}" >{{$cart->id}}</td>
                                 <td>{{$index+1}}</td>
                                 <td id="setPName_{{$cart->product->id}}">{{$cart->product->product_name}}</td>
                                 <td>Rs {{number_format($cart->product_rate)}}</td>
                                 <td id="setPQuantity_{{$cart->product->id}}">{{$cart->product_quantity}}</td>
                                 <td>Rs {{number_format($cart->sub_total)}}</td>
                                 <td>{{timeFormat($cart->delivery_due_date)['date']}}</td>
                                 <td ><button type="button" id="batch_{{$cart->product->id}}" class=" form-control btn btn-sm btn-primary btn-info btn-lg " data-toggle="modal" data-target="#myModal"  onclick="getBId({{$cart->product->id}})">Batch</button> </td>
                                 @endforeach 
                              </tr>
                              <tr>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td><strong>Total</strong></td>
                                 <td id="totalCost"><strong>Rs {{number_format($total_amount)}}</strong></td>
                                 <td></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <div class="col mb-2">
                     <div class="row">
                        <div class="col-sm-12  col-md-4">
                        </div>
                        <div class="col-sm-12  col-md-4">
                           <a href="{{ route('update.Stock_status', $invoice_no)}}" ><button class="btn btn-block btn-primary text-uppercase" disabled type="button" id="reserve_btn" >Reserve</button></a>
                        </div>
                        <div class="col-sm-12  col-md-4">
                        <a href="{{ route('update.pending_payment', $invoice_no)}}" ><button class="btn btn-block btn-primary text-uppercase" disabled type="button" id="checkout_btn" >CheckOut</button></a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div id="myModal" class="modal fade" role="dialog">
               <div class="modal-dialog" id="batch-info">
                  <!-- Modal content-->
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <div class="modal-body">
                        <div class="table-responsive">
                           <form method="post"  action="{{ route('save.Batch' , $invoice_no) }}">
                              @csrf 
                              <table class="datatable table table-stripped mb-0 batch_fetch" id="batch_fetch">
                                 <thead>
                                    <tr>
                                       <th >Product Name</th>
                                       <th id="Pname"></th>
                                       <th >Quantity ToBe Selected</th>
                                       <th id="Pquantity"></th>
                                       <th></th>
                                    </tr>
                                    <tr>
                                       <th>Batch ID</th>
                                       <th>Manufacture Date</th>
                                       <th>Expiry Date</th>
                                       <th>Current Stock</th>
                                       <th>Select Quantity</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                              </table>
                              <button type="button" id="add_batch_id" disabled name="action" value="ad_bat" onclick="addbatch()" class=" form-control btn btn-sm btn-primary btn-info btn-lg " >Add</button>
                           </form>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>
            <!-- </form> -->
         </div>
      </div>
   </div>
</div>
<!-- /page Wrapper -->
<script type="text/javascript">
   var BID="";
   var getPQuantity="";
   // alert("show");
   function getBId(id)
   {     
     BID=id;
     if(BID != null)
     {
      $.ajax({
               url: '/batch_selection/ajax/'+BID,
               type: "GET",
               dataType: "json",
               success:function(response) {
                                              var len = 0;
                                             $('#batch_fetch tbody').empty();     
                                             if(response.length > 0){
                                                len = response.length;
   
                                                var getPName = $('#setPName_'+BID).text();              
                                                $('#Pname').text(getPName);
   
                                                getPQuantity = $('#setPQuantity_'+BID).text();              
                                                $('#Pquantity').text(getPQuantity);
   
                for(var i=0; i<len; i++){
                   var b_id = response[i].id;                
                   var batch_name = response[i].batch_name;
                   var stockInBatch = response[i].stockInBatch;  
                   var manufactured_date = response[i].manufactured_date;
                   var expire_date = response[i].expire_date;            
   
                   var tr_str = "<tr>" +
                     "<td>" + batch_name + "</td>" +
                     "<td >" + manufactured_date + "</td>" +    
                     "<td >" + expire_date + "</td>" +
                     "<td id='in_batch_"+b_id+"'>" + stockInBatch + "</td>"+
                     "<td >"+"<input type='number' class='form-control col-md-8' value='0' onkeyup='autoChangeValue("+b_id+")'  name='select_qty["+b_id+"]' min='0' max='"+getPQuantity+"' id='select_qty_"+b_id+"'/>"+" </td>"+                
                   "</tr>";
                   $("#batch_fetch tbody").append(tr_str);
                }          
             }
             else
             {
                var tr_str = "<tr>" +
                    "<td align='center' colspan='4'>No record found.</td>" +
                "</tr>";
   
                $("#batch_fetch tbody").append(tr_str);
             }
                      }
              });
   }}
   
   function autoChangeValue(id)
   {  
      var test_val = $("#select_qty_"+id).val();
      var check_val = parseInt($("#in_batch_"+id).text());
   
      if(check_val>=test_val )
      {
      $("#Pquantity").text(getPQuantity);
   
      var quantityToBeChanged =   parseInt($("#Pquantity").text());  
      $('.batch_fetch').each(function(){
    var totalPoints = 0;
    $(this).find('input').each(function(){
      totalPoints += parseInt($(this).val()); //<==== a catch  in here !! read below
    });
   
    var sumofquantity= quantityToBeChanged - totalPoints;
    if(sumofquantity>= 0)
    {
      $("#Pquantity").text(sumofquantity);
      if($("#Pquantity").text() == 0)
      {
      $('#add_batch_id').removeAttr('disabled');    
      } 
      else
      {
     $('#add_batch_id').attr('disabled', 'disabled'); 
      }
    
    }
   else
   {
     $("#Pquantity").text("value exceed from " + getPQuantity);
     $('#add_batch_id').attr('disabled', 'disabled');
     
   }
   });  
   }
   else
   {
      $("#Pquantity").text("selected value exceed than stock value "+ check_val);
   }
   }
   
   
   
   function addbatch()
   {
      
   var cart_no = $("#cid_"+BID).text();
   var collect_id=[];
   //alert(cart_no);
   
   // var inv_no = $("#inv").text();
   
   var select_qty=[];
   
      $('.batch_fetch').each(function(){
          $(this).find('input').each(function(){
              if($(this).val() != 0){
        select_qty.push({index : $(this).attr("id") , sq : $(this).val()}); //<==== a catch  in here !! read below
              }
    });
    });
   
    let sel_qty = select_qty;
    //alert("ok");
      $.ajax({
   url: '/selectbatch/'+cart_no,
   type: "POST",
   dataType: "json",
   headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
   data:{"name":sel_qty},
   success:function(data) {
      
       $('.batch_fetch').each(function(){
          $(this).find('input').each(function(){
              $(this).attr('disabled', 'disabled');    
    });
    });
  
    $("#myModal").modal('hide');
    $('#add_batch_id').attr('disabled', 'disabled'); 
    $('#batch_'+BID).attr('disabled', 'disabled');
    
    $('#tbl_bat_sel').each(function(){
    $(this).find('button').each(function(){
      collect_id.push($(this).attr("id"));       
    });
    });
   
   let allbtndisable = false;    
      for(i=0; i<=collect_id.length-1; i++ )
   {
   if( $('#'+collect_id[i]).is(":not(:disabled)"))
   { 
      allbtndisable = true;
      break;   
   }
   else{
      allbtndisable = false;   
      }
   } 
   if(allbtndisable == false)
   {
      $('#reserve_btn').prop('disabled', false);
      $('#checkout_btn').prop('disabled', false); 
   }
   }
   });
   }
</script>
@endsection