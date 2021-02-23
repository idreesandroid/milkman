@extends('layouts.master')

@section('content')

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
            	<h3 class="card-title">Monthly Sales Overview</h3>
				<div id="line-charts"></div>
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

$productsName = [];
foreach ($products as $item) {
	array_push($productsName,$item['product_name']);
}

?>

<script type="text/javascript">
var roles = [<?php echo '"'.implode('","', $roleName).'"' ?>];
var users = [<?php echo '"'.implode('","', $allUserCount).'"' ?>];
var productsName = [<?php echo '"'.implode('","', $productsName).'"' ?>];
var totalOrders = [<?php echo '"'.implode('","', $totalOrders).'"' ?>];

$(document).ready(function() {  
	new Chart(document.getElementById("allUsersPieChart"), {
	    type: 'pie',
	    data: {
	      labels: roles,
	      datasets: [{
	        label: "Population (millions)",
	        backgroundColor: [ "#9a55ff","#fe7096","#94528f","#fad096","#aad296","#75e496","#ee7046"],
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
	      labels: productsName,
	      datasets: [
	        {
	          label: "Products",
	          backgroundColor: ["#fe7096", "#9a55ff","#3cba9f","#e8c3b9","#9a55ff"],
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
		data: [
			{ date: '2021-02-01', a: 50, b: 90, c : 30 },
			{ date: '2021-02-02', a: 75,  b: 65, c : 45},
			{ date: '2021-02-03', a: 50,  b: 40, c : 43},
			{ date: '2021-02-04', a: 75,  b: 65, c : 52},
			{ date: '2021-02-05', a: 50,  b: 54, c : 62},
			{ date: '2021-02-06', a: 75,  b: 65, c : 57},
			{ date: '2021-02-07', a: 100, b: 50, c : 49},
			{ date: '2021-02-08', a: 45, b: 50, c : 49},
			{ date: '2021-02-09', a: 12, b: 50, c : 45},
			{ date: '2021-02-10', a: 54, b: 50, c : 49},
			{ date: '2021-02-11', a: 54, b: 50, c : 45},
			{ date: '2021-02-12', a: 12, b: 50, c : 78},
			{ date: '2021-02-13', a: 78, b: 50, c : 49},
			{ date: '2021-02-14', a: 24, b: 50, c : 53},
			{ date: '2021-02-15', a: 45, b: 50, c : 49},
			{ date: '2021-02-16', a: 56, b: 50, c : 12},
			{ date: '2021-02-17', a: 32, b: 78, c : 49},
			{ date: '2021-02-18', a: 12, b: 50, c : 42},
			{ date: '2021-02-19', a: 12, b: 50, c : 78},
			{ date: '2021-02-20', a: 45, b: 50, c : 49},
			{ date: '2021-02-21', a: 57, b: 50, c : 78},
			{ date: '2021-02-22', a: 78, b: 78, c : 49},
			{ date: '2021-02-23', a: 39, b: 50, c : 45},
			{ date: '2021-02-24', a: 85, b: 50, c : 12},
			{ date: '2021-02-25', a: 87, b: 50, c : 49},
			{ date: '2021-02-26', a: 78, b: 50, c : 78},
			{ date: '2021-02-27', a: 78, b: 78, c : 49},
			{ date: '2021-02-28', a: 89, b: 50, c : 87},
		],
		xkey: 'date',
		ykeys: ['a', 'b', 'c'],
		labels: productsName,
		lineColors: ['#e8c3b9','#3cba9f',"#9a55ff","#3cba9f","#e8c3b9","#9a55ff"],
		lineWidth: '3px',
		resize: true,
		redraw: true
	});
});
</script>
@endsection