@extends('layouts.master')
@section('content')
<style type="text/css">
  #distributorProOrder{
    margin-bottom: 15px; 
  }
</style>
<div class="row graphs" id="distributorProOrder">
    <div class="col-md-12">
      <div class="card h-100">
        <div class="card-body">
          <h3 class="card-title">Monthly Products Orders Analysis</h3>
          <div id="#DistributormonthlyProductsOrdersAnalysis"></div>
        </div>
      </div>
    </div>    
</div>

<div class="row">
<div class="card" style="width: 18rem;">
  <div class="card-body">
  <ul>
  <li><h5 class="card-title">Balance: <?php echo isset($distributorBalance->balance)? $distributorBalance->balance : '0.00'?></h5></li>

  </ul>
    <a href="{{route('transaction.slip')}}" class="card-link">Add Balance</a>
  </div>
</div>	

<div class="card" style="width: 18rem;">
  <div class="card-body">
  <ul>
  <li><h5 class="card-title">Transactions: {{$transaction}}</h5></li>
 
  </ul>
    <a href="{{route('my.transaction')}}" class="card-link">My Transaction</a>
  </div>
</div>
</div>
<?php 
$colors = ["#6610F2","#E83E8C","#FD7E14","#20C997","#007BFF","#28A745","#17A2B8","#FFC107","#DC3545","#F8F9FA","#343A40"];
?>
<script type="text/javascript">
var colors = [<?php echo '"'.implode('","', $colors).'"' ?>];
var productNames = [<?php echo '"'.implode('","', $productNames).'"' ?>];
var productsOrderDetail = <?php echo $productsDetail; ?>;
$(document).ready(function() {  
  new Morris.Line({
    element: '#DistributormonthlyProductsOrdersAnalysis',
    data: productsOrderDetail,
    xkey: 'date',
    ykeys: productNames,
    labels: productNames,
    lineColors: colors,
    lineWidth: '3px',
    resize: true,
    redraw: true
  });  
});
</script>
@endsection