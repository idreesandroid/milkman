@extends('layouts.master')
@section('content')
    <!-- ============================================================== -->
    <!-- signup form  -->
    <!-- ============================================================== -->
 


    <form method="post"  action="/task_collection" class="splash-container" >
      @csrf 
    <input type="hidden" name="task_id" value="<?php echo $task_id; ?>" />
  
<div class="card">
    <div class="card-header">
        <h3 class="mb-1">Collection</h3>
        <p>Collect milk from vendor</p>
  
    </div>
    <div class="card-body">
         
    <div class="form-group">
        <select class="form-control form-control-lg" type="text" required name="vendor_id"   >
            <option value="">--Venders--</option>
            <?php 
            foreach ($vendor_list as $vendors) {
                $vendor_id     = $vendors->user_id;
                $vendors_name    = $vendors->name; ?>
                <option value="<?php echo $vendor_id;  ?>"><?php echo $vendors_name;  ?></option>


            <?php }  ?>

            </select> 
        </div>
        
        <div class="form-group">
        <input class="form-control form-control-lg" type="text" required name="received_qty" placeholder="Received Quantity"  />
         
        </div>
     
        <div class="form-group">
        <input class="form-control form-control-lg" type="text" required name="milk_quality" placeholder="Milk Quality"  />
         
        </div>
     
        <div class="form-group">
        <input class="form-control form-control-lg" type="text" required name="fat" placeholder="Fat"  />
         
        </div>  
        <div class="form-group">
        <input class="form-control form-control-lg" type="text" required name="protine" placeholder="Protine"  />
         
        </div>  
        
        <div class="form-group">
        <input class="form-control form-control-lg" type="text" required name="calcium" placeholder="Caluium"  />
         
        </div>
        

        
       

         


        
        <div class="form-group pt-2">
            <button class="btn btn-block btn-primary" type="submit">Received</button>
        </div>
      
     
   
    </div>      
</div>   


 </form>
 @endsection


@section('scripts')

@endsection