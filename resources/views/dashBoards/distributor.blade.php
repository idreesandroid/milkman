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

<?php 
$colors = ["#6610F2","#E83E8C","#FD7E14","#343A40","#20C997","#007BFF","#28A745","#17A2B8","#FFC107","#DC3545","#F8F9FA"];
$labels = ['Total Libility', 'Total Paid', 'Pending Amount', 'Remaing Amount'];

?>
<script type="text/javascript">
let colors = [<?php echo '"'.implode('","', $colors).'"' ?>];
let productNames = [<?php echo '"'.implode('","', $productNames).'"' ?>];
let labels = [<?php echo '"'.implode('","', $labels).'"' ?>];
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
    ykeys: labels,
    labels,
    lineColors: colors,
    lineWidth: '3px',
    barColors: colors,
    resize: true,
    redraw: true
  });

});
</script>
@endsection