@extends('layouts.master')
@section('content')
  
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Dashboard</h5>
                                <div class="card-body">
                                    <div class="table-responsive">
                                    
<!-- __________________________________________________________________________________-->


                                    
                                    <div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
      <div class="alert alert-primary" role="alert"> 
        <h3  >Today's Tasks</h3>
        </div>
<?php 

$percent = round(($task_completed*100)/1,2);

?>

<div class="progress">
<div class="progress-bar bg-gradient-success" role="progressbar" style="width: <?php echo $percent; ?>%" 
aria-valuenow="{{ $task_completed }}" aria-valuemin="0" aria-valuemax="{{ $task_total }}"></div>
</div>

                <table style="width:100%;">

                            <tr  style="text-align:center;">
                                <th style="width:33.33%;">Total</th>
                                <th style="width:33.33%;">Completed</th>
                                <th style="width:33.33%;">Pending</th>
                            </tr>
                            
                            <tr style="text-align:center;">
                                <td> {{ $task_total }}</td>
                                <td>{{ $task_completed }}</td>
                                <td>{{ $task_pending }}</td>
                            </tr>


                </table>

        <a href="#" class="btn btn-primary">Detail</a>
      </div>
    </div>
  </div>



  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
      <div class="alert alert-primary" role="alert"> 
        <h3  >Previous Tasks</h3>
        </div>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Detail</a>
      </div>
    </div>
  </div>
</div>



<!-- __________________________________________________________________________________-->
                                    </div>
                                </div>
                            </div>
    </div>
                    <!-- ============================================================== -->
                    <!-- end basic table -->
                    <!-- ============================================================== -->
                </div>
@endsection