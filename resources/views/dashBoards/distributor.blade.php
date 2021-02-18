@extends('layouts.master')

@section('content')
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
@endsection