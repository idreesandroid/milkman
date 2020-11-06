@extends('layouts.master')
@section('content')
    <!-- ============================================================== -->
    <!-- signup form  -->
    <!-- ============================================================== -->
 
    <form method="post"  class="splash-container">
    
    @csrf 
<div class="card">
    <div class="card-header">
        <h3 class="mb-1">Set Task</h3>
        <p>Assign the task to Collector</p>
 
    </div>
    <div class="card-body">
         
       <?php 
       $today_date = date('Y-m-d')
       ?>

        <div class="form-group">
            <input class="form-control form-control-lg" type="date"  name="task_date" required value="{{ $today_date }}" autocomplete="off">
        </div>
        <div class="form-group">
        <select class="form-control form-control-lg" type="text" required name="collector_id"  >
            <option value="">--Collectors--</option>
            <?php 
            foreach ($collector_list as $collectors) {
                $collector_id     = $collectors->id;
                $collector_name    = $collectors->name; ?>
                <option value="<?php echo $collector_id;  ?>"><?php echo $collector_name;  ?></option>


            <?php }  ?>

            </select> 
        </div>

        <div class="form-group">
        <select class="form-control form-control-lg" type="text" required name="route_id[]" multiple  >
            <option value="">--Venders--</option>
            <?php 
            foreach ($route_list as $route_lists) {
                $rout_id     = $route_lists->rout_id;
                $route_name    = $route_lists->route_name; ?>
                <option value="<?php echo $rout_id;  ?>"><?php echo $route_name;  ?></option>


            <?php }  ?>

            </select> 
        </div>



        
        <div class="form-group">
        <select class="form-control form-control-lg" type="text" required name="task_time" >
        <option value="">--Task Time--</option>
        <option value="morning">Morning</option>
        <option value="evening">Evening</option>
        </select>
        </div>
          
   
        <div class="form-group pt-2">
            <button class="btn btn-block btn-primary" type="submit">Register My Account</button>
        </div>
      
     
     
     <div class="card-footer bg-white">
                <p>Already member? <a href="/login" class="text-secondary">Login Here.</a></p>
     </div>

    </div>      
</div>   


 </form>
 @endsection


@section('scripts')

@endsection