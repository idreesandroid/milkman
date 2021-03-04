@extends('layouts.master')
@section('content')
<!-- <div class="card" style="width: 18rem;">
   <div class="card-body">
      <a href="#">
         <h5 class="card-title">My Tasks</h5>
      </a>
      <ul>
         <li>
            <h2 class="card-title">Total Milk Sale: {{$saleMilk}} Ltr</h2>
         </li>
      </ul>
   </div>
</div> -->
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
<div class="row graphs">
  <div class="col-md-12">
    <div class="card h-100">
      <div class="card-body">
        <h3 class="card-title">Total Monthly Milk Analysis</h3>
        <div id="TotalMonthyMilkAnalysis"></div>
      </div>
    </div>
  </div>
</div>
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

<script type="text/javascript">
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
    element: 'TotalMonthyMilkAnalysis',
    data: [
      { y: '2006', a: 50, b: 90 },
      { y: '2007', a: 75,  b: 65 },
      { y: '2008', a: 50,  b: 40 },
      { y: '2009', a: 75,  b: 65 },
      { y: '2010', a: 50,  b: 40 },
      { y: '2011', a: 75,  b: 65 },
      { y: '2012', a: 100, b: 50 }
    ],
    xkey: 'y',
    ykeys: ['a', 'b'],    
    labels: ['Total Sales', 'Total Revenue','Collector'],
    lineColors: ['#9a55ff','#da8cff'],
    lineWidth: '3px',
    resize: true,
    redraw: true,
    stacked: false,
    hoverCallback: function (index, options, content, row) {
        var finalContent = content;
        $.each(options.ykeys, function (i, v) {
            var hours = ("0" + Math.floor(row[v] / 60)).slice(-2);
            var minutes = ("0" + row[v] % 60).slice(-2);
            finalContent.replace(row[v], hours + ":" + minutes);
        });
        return finalContent;
    }  
  });
});

</script>
@endsection

