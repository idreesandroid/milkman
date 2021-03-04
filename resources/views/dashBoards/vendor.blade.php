@extends('layouts.master')
@section('content')
<div class="crms-title row bg-white mb-4">
   <div class="col  p-0">
      <div></div>
      <h3 class="page-title">
         <span class="page-title-icon bg-gradient-primary text-white mr-2">
         <i class="la la-table"></i>
         </span>Vendor Dashboard
      </h3>
   </div>
   <div class="col p-0 text-right">
      <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
         <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
         <li class="breadcrumb-item active">Vendor Dashboard</li>
      </ul>
   </div>
</div>
 <div class="row">
   <div class="col-sm-3">
      <div class="info-box">
         <span class="info-box-icon bg-yellow"><i class="fa fa-calendar-check-o"></i></span>
         <div class="info-box-content" > 
          <span class="info-box-text">
            Total Milk Sold
          </span>
          <span class="count">{{$saleMilk}}</span>
         </div>
      </div>
   </div>
   <div class="col-sm-3">
      <div class="info-box">
         <span class="info-box-icon bg-yellow"><i class="fa fa-check-square-o"></i></span>
         <div class="info-box-content" > 
          <span class="info-box-text">Milk Price Per Litter</span>
          <span class="count">{{$decided_rate->decided_rate}}</span>
         </div>
      </div>
   </div>
   <div class="col-sm-3">
      <div class="info-box">
         <span class="info-box-icon bg-yellow"><i class="fa fa-check-circle"></i></span>
         <div class="info-box-content" >
          <span class="info-box-text">
            Today's Morning Milk Quentity
          </span>
          <span class="count">{{$todayMorningQuentity}}</span>
         </div>
      </div>
   </div>
   <div class="col-sm-3">
      <div class="info-box">
         <span class="info-box-icon bg-yellow"><i class="fa fa-check-circle-o"></i></span>
         <div class="info-box-content" >
          <span class="info-box-text">
            Today's Evening Milk Quentity
          </span>
          <span class="count">{{$todayEveningQuentity}}</span>
         </div>
      </div>
   </div>
</div> 
<?php
$currentDate = date('d');
if($currentDate <= 15){ ?>
<div class="row graphs">
  <div class="col-md-6">
    <div class="card h-100">
      <div class="card-body">
        <h3 class="card-title">Total Monthly Morning Milk Analysis</h3>
        <div id="TotalMonthyMonrningMilkAnalysis"></div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card h-100">
      <div class="card-body">
        <h3 class="card-title">Total Monthly Evening Milk Analysis</h3>
        <div id="TotalMonthyEveningMilkAnalysis"></div>
      </div>
    </div>
  </div>
</div>
<?php }else{ ?>

<div class="row graphs">
  <div class="col-md-12">
    <div class="card h-100">
      <div class="card-body">
        <h3 class="card-title">Total Monthly Morning Milk Analysis</h3>
        <div id="TotalMonthyMonrningMilkAnalysis"></div>
      </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="card h-100">
      <div class="card-body">
        <h3 class="card-title">Total Monthly Evening Milk Analysis</h3>
        <div id="TotalMonthyEveningMilkAnalysis"></div>
      </div>
    </div>
  </div>
</div>
          
<?php } ?>
<div class="col-md-12 grid-margin">
   <div class="">
      <div class="card-body p-0 row">
         <div class="table-responsive">
            <table class="table table-striped table-nowrap custom-table mb-0 datatable">
               <thead>
                  <tr>
                     <th>Milk Collected</th>
                     <th>Collection Date</th>
                     <th>Collection Shift</th>
                     <th>Collected By</th>
                     <th>Milk Purity</th>
                     <th>Quality ScreenShot</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($myMilkTransactions as $myMilkTransaction)
                  <tr>
                     <td>{{$myMilkTransaction->milkCollected}} ltr</td>
                     <td>{{timeFormat($myMilkTransaction->collectedTime)['date']}}</td>
                     <td>{{$myMilkTransaction->taskShift}}</td>
                     <td>{{$myMilkTransaction->name}}</td>
                     <td>{{$myMilkTransaction->totalSolid}}</td>
                     <td><img src="{{asset('/milkQuality_img/'.$myMilkTransaction->qualityPic)}}" alt="Logo" width="50" height="60" class="img-thumbnail"></td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<?php

$colors = ["#6610F2","#E83E8C","#FD7E14","#20C997","#007BFF","#28A745","#17A2B8","#FFC107","#DC3545","#F8F9FA","#343A40"];
?>
<script type="text/javascript">
var colors = [<?php echo '"'.implode('","', $colors).'"' ?>];
var MorningMilkDetail = <?php echo $MorningMilkDetail; ?>;
var EveningMilkDetail = <?php echo $EveningMilkDetail; ?>;
$(document).ready(function() {  
  $('.count').each(function () {
      $(this).prop('Counter',0).animate({
          Counter: $(this).text()
      }, {
          duration: 4000,
          easing: 'swing',
          step: function (now) {
              $(this).text(Math.ceil(now));
          }
      });
  });

  Morris.Line({
    element: 'TotalMonthyMonrningMilkAnalysis',
    data: MorningMilkDetail,
    xkey: 'date',
    ykeys: ['milkCollected', 'fat','Lactose','Ash'],    
    labels: ['Milk Collected', 'Fat','Lactose','Ash'],
    lineColors: colors,
    lineWidth: '3px',
    resize: true,
    redraw: true, 
  });


  Morris.Line({
    element: 'TotalMonthyEveningMilkAnalysis',
    data: EveningMilkDetail,
    xkey: 'date',
    ykeys: ['milkCollected', 'fat','Lactose','Ash'],    
    labels: ['Milk Collected', 'Fat','Lactose','Ash'],
    lineColors: colors,
    lineWidth: '3px',
    resize: true,
    redraw: true, 
  });
});

</script>
@endsection

