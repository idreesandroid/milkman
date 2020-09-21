@extends('layouts.master')
@section('content')
    <!-- ============================================================== -->
    <!-- signup form  -->
    <!-- ============================================================== -->
    <form method="post"  class="splash-container">
    @csrf 
<div class="card">
    <div class="card-header">
        <h3 class="mb-1">Registrations Form</h3>
        <p>Please enter your user information.</p>
 
    </div>
    <div class="card-body">
        <div class="form-group">
            <select class="form-control form-control-lg" type="text" required name="user_role"  >
            <option value="">--Role--</option>
            <?php 
            foreach ($result as $results) {
                $role_title     = $results->role_title;
                $role_id    = $results->id; ?>
                <option value="<?php echo $role_id;  ?>"><?php echo $role_title;  ?></option>


            <?php }  ?>

            </select>
        </div>

      

        <div class="form-group">
            <input class="form-control form-control-lg" type="text" name="user_name" required="" placeholder="Username" autocomplete="off">
        </div>
        <div class="form-group">
            <input class="form-control form-control-lg" type="email" name="email"  placeholder="E-mail" autocomplete="off">
        </div>
        <div class="form-group">
            <input class="form-control form-control-lg" type="text" name="user_cnic"  placeholder="CNIC" autocomplete="off">
        </div>
        <div class="form-group">
            <input class="form-control form-control-lg" type="text" name="user_phone"   placeholder="Mobile" autocomplete="off">
        </div>
        <div class="form-group">
        <select class="form-control form-control-lg" type="text" name="user_country"   placeholder="Mobile" >
        <option value="0">--Country--</option>
        </select>
        </div>
        <div class="form-group">
        <select class="form-control form-control-lg" type="text" name="user_state"   placeholder="Mobile" >
        <option value="0">--State--</option>
        </select>
        </div>
        <div class="form-group">
        <select class="form-control form-control-lg" type="text" name="user_city"  placeholder="Mobile" >
        <option value="0">--City--</option>
        </select>
        </div>



        <div class="form-group">
            <input class="form-control form-control-lg" id="pass" name="passw" type="password"   placeholder="Password">
        </div>
        <div class="form-group">
            <input class="form-control form-control-lg" id="pass1" name="pass1" type="password"   placeholder="Confirm-Password">
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