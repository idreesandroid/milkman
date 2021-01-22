@extends('layouts.master')

@section('content')
<div class="row">
<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">User</h5>
    
    @foreach($roles as $index => $role)
        {{$role->name}}  
        {{$userCount[$index]}} 
        <br> 
    @endforeach

  </div>
</div>	
</div>
@endsection