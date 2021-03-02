@extends('layouts.master')
@section('content')
<style type="text/css">
  #distributorProOrder,
  #MonthlyTransaction
  {
    margin-bottom: 15px; 
  }
</style>
<?php 
$currentDate = date('d');

if($currentDate <= 15){ ?>
  <div class="row graphs" id="distributorProOrder">
    <div class="col-md-6">
      <div class="card h-100">
        <div class="card-body">
          <h3 class="card-title">Monthly Products Orders Analysis</h3>
          <div id="#DistributorMonthlyProductsOrdersAnalysis"></div>
        </div>
      </div>
    </div>    

  <div class="col-md-6">
    <div class="card h-100">
      <div class="card-body">
          <h3 class="card-title">Monthly Transaction Analysis</h3>
        <div id="DistributorMonthlyTransaction" width="800" height="450"></div>
      </div>
    </div>
  </div>  
</div>
<?php }else{ ?>
<div class="row graphs" id="distributorProOrder">
    <div class="col-md-12">
      <div class="card h-100">
        <div class="card-body">
          <h3 class="card-title">Monthly Products Orders Analysis</h3>
          <div id="#DistributorMonthlyProductsOrdersAnalysis"></div>
        </div>
      </div>
    </div>    
</div>
<div class="row graphs" id="MonthlyTransaction">
  <div class="col-md-12">
    <div class="card h-100">
      <div class="card-body">
          <h3 class="card-title">Monthly Transaction Analysis</h3>
        <div id="DistributorMonthlyTransaction" width="800" height="450"></div>
      </div>
    </div>
  </div>  
</div>
<?php } ?>

<!-- <div class="row graphs" id="distributorProOrder">
    <div class="col-md-12">
      <div class="card h-100">
        <div class="card-body">
          <h3 class="card-title">Monthly Products Orders Analysis</h3>
          <div id="#DistributorMonthlyProductsOrdersAnalysis"></div>
        </div>
      </div>
    </div>    
</div>
<div class="row graphs" id="MonthlyTransaction">
  <div class="col-md-12">
    <div class="card h-100">
      <div class="card-body">
          <h3 class="card-title">Monthly Transaction Analysis</h3>
        <div id="DistributorMonthlyTransaction" width="800" height="450"></div>
      </div>
    </div>
  </div>  
</div> -->
<!-- <div class="row">
  <div class="card" style="width: 18rem;">
    <div class="card-body">
      <ul>
        <li>
          <h5 class="card-title">Balance: <?php //echo isset($distributorBalance->balance)? $distributorBalance->balance : '0.00'?></h5>
        </li>
      </ul>
        <a href="{{route('transaction.slip')}}" class="card-link">Add Balance</a>
    </div>
  </div>
  <div class="card" style="width: 18rem;">
    <div class="card-body">
      <ul>
        <li>
          <h5 class="card-title">Transactions: {{$transaction}}</h5>
        </li>
      </ul>
        <a href="{{route('my.transaction')}}" class="card-link">My Transaction</a>
    </div>
  </div>
</div> -->
<?php 
$colors = ["#6610F2","#E83E8C","#FD7E14","#20C997","#007BFF","#28A745","#17A2B8","#FFC107","#DC3545","#F8F9FA","#343A40"];

//echo $transactionDetail;
?>
<script type="text/javascript">
let colors = [<?php echo '"'.implode('","', $colors).'"' ?>];
let productNames = [<?php echo '"'.implode('","', $productNames).'"' ?>];
let productsOrderDetail = <?php echo $productsDetail; ?>;
let transactionDetail = <?php echo $transactionDetail; ?>;
$(document).ready(function() {  
  new Morris.Line({
    element: '#DistributorMonthlyProductsOrdersAnalysis',
    data: productsOrderDetail,
    xkey: 'date',
    ykeys: productNames,
    labels: productNames,
    lineColors: colors,
    lineWidth: '3px',
    resize: true,
    redraw: true
  });

  new Morris.Bar({
    element: 'DistributorMonthlyTransaction',
    data: transactionDetail,
    xkey: 'date',
    ykeys: ['Total Libility', 'Total Paid', 'Pending Amount', 'Remaing Amount'],
    labels: ['Total Libility', 'Total Paid', 'Pending Amount', 'Remaing Amount'],
    lineColors: ["#DC3545","#17A2B8","#343A40","#FD7E14"],
    lineWidth: '3px',
    barColors: ["#DC3545","#17A2B8","#343A40","#FD7E14"],
    resize: true,
    redraw: true
  });

});
</script>
@endsection