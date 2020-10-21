@extends('layouts.master')
@section('content')

			
			<!-- Page Wrapper -->
            					
		<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title mb-0">Registration Form</h4>
								</div>
								<div class="card-body">

@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif


 
									<form method="post">
                                    @csrf
                                              

											 
                      <div class="form-group row">
					  
                    <div class="col-md-6">
					<label>User Roll</label>
                        <select class="form-control" name="user_role" required="" onchange="chk_role(this.value)">
                            <option value="">--User Roll--</option>
                            <?php 
                            foreach ($roles as $results) {
                            $role_title     = $results->role_title;
                            $role_id    = $results->id; ?>
                           <option value="<?php echo $role_id;  ?>"><?php echo $role_title;  ?></option> <?php }  ?>                           
                        </select>
                    </div>
 
					<div class="col-md-6">
					<label>Designation</label>
                        <select class="form-control" name="designation_id" required="" >
                            <option value="">--Designation--</option>
                            <?php 
                            foreach ($load_designation as $load_des) {
                            $desig_id     = $load_des->id;
                            $designation_title    = $load_des->designation_title; ?>
                           <option value="<?php echo $desig_id;  ?>"><?php echo $designation_title;  ?></option>
						    <?php }  ?>                           
                        </select>
                    </div>


                </div>

									
                                    	<h4 class="card-title">Personal Information</h4>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Full Name</label>
													<input type="text" class="form-control"  minlength="3" name="user_name" required=""  autocomplete="off">
												</div>
												

                                                <div class="form-group">
													<label>CNIC</label>
													<input type="text" class="form-control" name="user_cnic" required="" maxlength="13" autocomplete="off">
												</div>

                                                <div class="form-group">
													<label>Contact No</label>
													<input type="text" class="form-control" name="user_phone" maxlength="11" required="" autocomplete="off">
												</div>											
										
											</div>
											<div class="col-md-6">
												
												<div class="form-group">
													<label>Email (Optional)</label>
													<input type="text" class="form-control" type="email" name="email"   autocomplete="off">
												</div>

												<div class="form-group">
													<label>Password</label>
													<input type="text" class="form-control" id="pass" name="passw" required="" type="password"   minlength="6"  >
												</div>
												<div class="form-group">
													<label>Repeat Password</label>
													<input type="text" class="form-control" id="pass1" name="pass1" required="" type="password"  minlength="6"    >
												</div>
											</div>
										</div>
										<h4 class="card-title">Address Information</h4>
										<div class="row">
											<div class="col-md-6">
												
                                                <div class="form-group"  type="text" required=""  >
													<label>State</label>
													   <select class="select  form-control"  name="user_state" id="user_state">
														<option>States</option>
														<option value="">--- Select State ---</option>
                    									@foreach ($states as $state)
                       									 <option value="{{ $state->id}}">{{ $state->state_name }}</option>
                   										 @endforeach														
													</select>
												</div>
                                                                                           
												 <div class="form-group">
               									 <label for="title">Select City:</label>
               									 <select name="user_city" class="form-control" id="user_city" >
               									 </select>
           										 </div>



                                                </div>
											<div class="col-md-6">
                                            

                                                <div class="form-group">
													<label>Address</label>
													<textarea rows="5" cols="5" class="form-control" name="user_address" minlength="10"  required=""  autocomplete="off"></textarea>
												</div>
                                            										
											</div>
										</div>

					 
									</div>



										<div class="text-right">
											<button type="submit" class="btn btn-primary">Submit</button>
										</div>
									</form>
								</div>							
		</div>
					
					
			<!-- /Page Wrapper -->
		
       <script>
	   function chk_role(id){

		 
		if(id==3){
			$('#vendor_detail').show();
		}else{
			$('#route_id').val('');
			$('#decided_milkQuantity').val('');
			$('#decided_rate').val('');
			$('#vendor_detail').hide();
		}
	   }

	   </script>
		

	<script type="text/javascript">	
    $(document).ready(function() {	


        $("#user_state").on('change', function() {			
            var stateID = $("#user_state").val();
			 
            if(stateID != 0 ) {
         $.ajax({				
                    url: '/register/ajax/'+stateID,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {                    
                        $("#user_city").empty();
                        $.each(data, function(key, value) {
                        $("#user_city").append('<option value="'+value.id +'">'+ value.city_name +'</option>');
                        });
                    }
                });
 
            }else{
                $("#user_city").empty();
            }
        });
    });
</script>





        @endsection 
		