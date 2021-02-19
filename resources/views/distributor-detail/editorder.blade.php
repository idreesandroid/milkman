@extends('layouts.master')
@section('content')
 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
   <div class="col">
      <h3 class="page-title">
         <span class="page-title-icon bg-gradient-primary text-white mr-2">
         <i class="la la-table"></i>
         </span> <span>Update Order</span>
      </h3>
   </div>
   <div class="col text-right">
      <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
         <li class="breadcrumb-item"><a href="/">Distributor</a></li>
         <li class="breadcrumb-item active">Update Order</li>
      </ul>
   </div>
</div>
<!-- Page Wrapper -->
<div class="row">
   <div class="col-lg-12">
      
   
         <div class="row">
                  <div class="col-md-12">
                     <div class="card mb-0">
                        <div class="card-body">
                           <div class="table-responsive">
                              <table id="updateOrder" class="table table-striped table-nowrap custom-table mb-0 datatable">
                                 <thead>
                                    <tr>                                  
                                       <th></th>
                                       <th class="text-center">Product Name</th>                                      
                                       <th class="text-center">Unit</th>
                                       <th class="text-center">Quentity/Carton</th>
                                       <th class="text-center">Unit Price</th>
                                       <th class="text-center">Unit Quentity</th>
                                       <th class="text-center">Sub Total</th>
                                       <th class="text-center">Actions</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($cartDetail as $item)
                                    <tr class="product_row">
                                       <td class="checkBox">
                                          <label class="container-checkbox">
                                             <input type="checkbox" name="selectedProduct" id="product_{{$item->product_id}}" value="{{$item->product_id}}">
                                             <input type="hidden" class="productid" value="{{$item->product_id}}">
                                             <span class="checkmark"></span>
                                          </label>
                                       </td>
                                       <td class="text-center">{{$item->product_name}}</td>                                       
                                       <td class="text-center">{{$item->product_size}} {{$item->unit}}</td>
                                       <td class="text-center">{{$item->ctn_value}}</td>
                                       <td class="text-center unitprice" id="unitPrice<?php echo $item->product_id; ?>">{{$item->product_price}}</td>
                                       <td class="text-center">
                                          <input type="submit" value="+" onclick="quentityIncrement(<?php echo $item->product_id; ?>)">
                                          <input class="productquentity" onchange="quentityUpdate(<?php echo $item->product_id; ?>)" id="productQuentity{{$item->product_id}}" onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))" style="width: 40px" value="{{$item->product_quantity}}">
                                          <input type="submit" value="-" onclick="quentityDecrement(<?php echo $item->product_id; ?>)">
                                       </td>
                                       <td class="text-center sum_item" id="subTotal{{$item->product_id}}">{{$item->sub_total}}</td>
                                       <td class="text-center">
                                          <a href="" onclick="productDetail(<?php echo $item->product_id; ?>)" class="btn btn-outline-success">Detail</a>
                                       </td>
                                    </tr>
                                    @endforeach                           
                                 </tbody>
                                 <tfoot>
                                    <tr>
                                       <td><input type="hidden" value="{{$invoiceDetail->buyer_id}}" id="distributorID"></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td class="text-right">Total:</td>
                                       <td class="text-center" id="totalPrice">{{$invoiceDetail->total_amount}}</td>
                                       <td><a onclick="updateOrder(<?php echo $invoiceDetail->id ?>)" class="btn btn-outline-info" href="#">Update Order</a></td>
                                    </tr>
                                 </tfoot>
                              </table>
                           </div>
                        </div>
                     </div>      
                  </div>
               </div>
       
   <!-- modal-dialog -->
   </div>
</div>
<!-- /page Wrapper -->


<script type="text/javascript">
$(document).ready(function() { 
   $("#updateOrder").DataTable();
});
function updateOrder(invoiceID){
   var orderDetail = [];
   var haveQuentity = [];
   $(".product_row").each(function(){
      var items = [];
      var productid = $(this).find('.productid').val();
      items.push(productid);
      var unitprice = $(this).find('.unitprice').text();
      items.push(unitprice);
      var productquentity = $(this).find('.productquentity').val();
      items.push(productquentity);
      if(productquentity == 0){
         haveQuentity.push('product not selected');
      }
      var sum_item = $(this).find('.sum_item').text();
      items.push(sum_item);
      orderDetail.push(items);
   });

   if(haveQuentity.length == orderDetail.length){
      $("#orderNow").modal('hide');
      swal.fire("Error Ordering!", "Please select any product to process", "error").then((result) => {
         if(result.isConfirmed) {
            location.reload(true);
         }
      });
      return false;
   }   
   var totalPrice = $("#totalPrice").text();
   var distributorID = $("#distributorID").val();
   $.ajax({
        url: "{{ route('updateorder') }}",
        type: "POST",
        data: {
            'orderDetail': orderDetail,
            'distributorID' : distributorID,
            'totalPrice' : totalPrice,
            'invoiceID' : invoiceID,
            '_token' : "{{ csrf_token() }}"
        },
        success: function (response, status) {
            $('#orderNow').modal('hide');
            if(response){
               swal.fire("Done!", "Order Updated Succesfully!", "success").then((result) => {
                  if(result.isConfirmed) {
                     location.reload(true);
                  }
               });
            }else{
               $('#orderNow').modal('hide');
               swal.fire("Error Order Updateding!", "Your order fails", "error").then((result) => {
                  if(result.isConfirmed) {
                     location.reload(true);
                  }
               });
            }
        },
        error: function () {
            $('#orderNow').modal('hide');
            swal.fire("Error Order Updateding!", "Please try again", "error").then((result) => {
               if(result.isConfirmed) {
                  location.reload(true);
               }
            });
        }
   }); 
}

function quentityIncrement(productID){
   var productQuentity = $("#productQuentity"+productID).val();
   if(!productQuentity.length){
      productQuentity = 0;
   }
   $("#productQuentity"+productID).val(parseInt(productQuentity)+1);
   var unitPrice = $("#unitPrice"+productID).text();
   var currentQuentity = $("#productQuentity"+productID).val();
   $("#subTotal"+productID).text((parseInt(currentQuentity) * parseFloat(unitPrice)).toFixed(2));

   var sum = 0;
   $('.sum_item').each(function(){
      var item_val = parseFloat($(this).text());
      if(isNaN(item_val)){
        item_val = 0;
      }
      sum += item_val;
   });
   $('#totalPrice').text(sum.toFixed(2));
}

function quentityDecrement(productID){
   var productQuentity = $("#productQuentity"+productID).val();
   if(!productQuentity.length || productQuentity <= 0){
      productQuentity = 1;
   }
   $("#productQuentity"+productID).val(parseInt(productQuentity)-1);
   var unitPrice = $("#unitPrice"+productID).text();
   var currentQuentity = $("#productQuentity"+productID).val();
   $("#subTotal"+productID).text((parseInt(currentQuentity) * parseFloat(unitPrice)).toFixed(2));  

   var sum = 0;
   $('.sum_item').each(function(){
      var item_val = parseFloat($(this).text());
      if(isNaN(item_val)){
        item_val = 0;
      }
      sum += item_val;
   });
   $('#totalPrice').text(sum.toFixed(2));
}

function quentityUpdate(productID){
   var unitPrice = $("#unitPrice"+productID).text();
   var currentQuentity = $("#productQuentity"+productID).val();
   $("#subTotal"+productID).text((parseInt(currentQuentity) * parseFloat(unitPrice)).toFixed(2));
      var sum = 0;
      $('.sum_item').each(function(){
      var item_val = parseFloat($(this).text());
      if(isNaN(item_val)){
        item_val = 0;
      }
      sum += item_val;
   });
   $('#totalPrice').text(sum.toFixed(2));
}
</script>
@endsection

