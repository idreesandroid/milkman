@extends('layouts.master')

@section('content')
<div class="card" style="width: 18rem;">
  <div class="card-body">
<a href="#"> <h5 class="card-title">My Tasks</h5></a>
  <ul>
  <li><h2 class="card-title">Total Milk Sale: {{$saleMilk}} Ltr</h2></li>
  </ul>
    <!-- <a href="{{route('my.transaction')}}" class="card-link">My Transaction</a> -->
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
</div>
@endsection