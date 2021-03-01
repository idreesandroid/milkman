@extends('layouts.master')

@section('content')

<style type="text/css">
	#totalSaleGraph{
		padding-top: 25px;
	}
</style>
<div class="row graphs">
	<div class="col-md-6">
		<div class="card h-100">
          <div class="card-body">
          	<h3 class="card-title">All Users</h3>
             <canvas id="allUsersPieChart" width="800" height="450"></canvas>
          </div>
        </div>
	</div>
	<div class="col-md-6">
		<div class="card h-100">
            <div class="card-body">
            	<h3 class="card-title">Daily Products Orders</h3>
              <canvas id="dailyProductsOrders" width="800" height="450"></canvas>
            </div>
        </div>
	</div>
</div>

<div class="row graphs">
	<div class="col-md-12">
		<div class="card h-100">
			<div class="card-body">
            	<h3 class="card-title">Monthly Products Orders Analysis</h3>
				<div id="line-charts"></div>
        	</div>
		</div>
	</div>	
</div>
<div class="row graphs" id="totalSaleGraph">
	
	<div class="col-md-12 mb-0">
		
		<div class="card h-100 mb-0">
            <div class="card-body">
            	<h3 class="card-title">Total Monthly Sales Analysis</h3>
             <div id="chart"></div>
            </div>
        </div>
	</div>
	
</div>
					
<?php 

$roleName = [];
$allUserCount = [];
foreach($roles as $index => $role){
	array_push($roleName,$role->name);
	array_push($allUserCount,$userCount[$index]);                  
}

?>

<script type="text/javascript">
var roles = [<?php echo '"'.implode('","', $roleName).'"' ?>];
var users = [<?php echo '"'.implode('","', $allUserCount).'"' ?>];
var productNames = [<?php echo '"'.implode('","', $productNames).'"' ?>];
var totalOrders = [<?php echo '"'.implode('","', $totalOrders).'"' ?>];
var dateRange = [<?php echo '"'.implode('","', $dateRange).'"' ?>];
var perDaySale = [<?php echo '"'.implode('","', $perDaySale).'"' ?>];

//var AllProData = <?php //echo $allProData; ?>;

var allProNewData = <?php echo $productsDetail; ?>;

$(document).ready(function() {  
	new Chart(document.getElementById("allUsersPieChart"), {
	    type: 'pie',
	    data: {
	      labels: roles,
	      datasets: [{
	        label: "Population (millions)",
	        backgroundColor: [ "#6610f2","#e83e8c","#fd7e14","#20c997","#007bff","#28a745","#17a2b8","#ffc107","#dc3545","#f8f9fa","#343a40"],
	        data: users
	      }]
	    },
	    options: {
	      title: {
	        display: true,
	        text: ''
	      }
	    }
	});

	new Chart(document.getElementById("dailyProductsOrders"), {
	    type: 'horizontalBar',
	    data: {
	      labels: productNames,
	      datasets: [
	        {
	          label: "Products",
	          backgroundColor: ["#6610f2","#e83e8c","#fd7e14","#20c997","#007bff","#28a745","#17a2b8","#ffc107","#dc3545","#f8f9fa","#343a40"],
	          data: totalOrders
	        }
	      ]
	    },
	    options: {
	      legend: { display: false },
	      title: {
	        display: true,
	        text: ''
	      }
	    }
	});

// Line Chart
	
	new Morris.Line({
		element: 'line-charts',
		data: allProNewData,
		xkey: 'date',
		ykeys: productNames,
		labels: productNames,
		lineColors: ["#6610f2","#e83e8c","#fd7e14","#20c997","#007bff","#28a745","#17a2b8","#ffc107","#dc3545","#f8f9fa","#343a40"],
		lineWidth: '3px',
		resize: true,
		redraw: true
	});
});


var options = {
          series: [{
            name: "Total Today's Sale",
            data: perDaySale
        }],
          chart: {
          height: 350,
          type: 'line',
          zoom: {
            enabled: false
          }
        },
        markers: {
	    size: 6,
	    colors: ['#F44336', '#E91E63', '#9C27B0']
		},
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
        title: {
          text: 'Product Trends by Month',
          align: 'left'
        },
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'dark',
            type: "horizontal",
            shadeIntensity: 0.5,
            gradientToColors: undefined, // optional, if not defined - uses the shades of same color in series
            inverseColors: true,
            opacityFrom: 1,
            opacityTo: 1,
            stops: [0, 50, 100],
            colorStops: []
          }
        },
		theme: {
		  monochrome: {
		    enabled: true,
		    color: '#255aee',
		    shadeTo: 'light',
		    shadeIntensity: 0.65
			  }
			},
		  grid: {
          row: {
            colors: [ 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        xaxis: {
          categories: dateRange,
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

function malformedJSON2Array (tar) {
    var arr = [];
    tar = tar.replace(/^\{|\}$/g,'').split(',');
    for(var i=0,cur,pair;cur=tar[i];i++){
        arr[i] = {};
        pair = cur.split(':');
        arr[i][pair[0]] = /^\d*$/.test(pair[1]) ? +pair[1] : pair[1];
    }
    return arr;
}
</script>
@endsection
