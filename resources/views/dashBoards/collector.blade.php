@extends('layouts.master')

@section('content')
<div class="card" style="width: 18rem;">
  <div class="card-body">
<a href="#"> <h5 class="card-title">My Tasks</h5></a>
  <ul>
  <li><h2 class="card-title">Total Task: {{$totalTask}}</h2></li>
  <li><h2 class="card-title">Completed Task: {{$taskCompleted}}</h2></li>
  </ul>
    <!-- <a href="{{route('my.transaction')}}" class="card-link">My Transaction</a> -->
  </div>
</div>	
@endsection