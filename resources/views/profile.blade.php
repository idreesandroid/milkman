@extends('layouts.master')
@section('content')
  
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Dashboard</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                <div class="row graphs">
                                        <div class="col-md-6">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <h3 class="card-title">Completed Tasks</h3>
                                                    <canvas id="mixed-chart" width="800" height="450"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end basic table  -->
                    <!-- ============================================================== -->
                </div>
@endsection