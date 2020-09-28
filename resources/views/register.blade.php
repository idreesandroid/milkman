@extends('layouts.master')
@section('content')

			
			<!-- Page Wrapper -->
            					
		<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title mb-0">Two Column Vertical Form</h4>
								</div>
								<div class="card-body">
									<form method="post">
                                    @csrf
                                             

											<h4 class="card-title">User Roll</h4>
                      <div class="form-group row">
					  
                    <div class="col-md-6">
                        <select class="form-control" name="user_role" required="" onchange="chk_role(this.value)">
                            <option value="">--User Roll--</option>
                            <?php 
                            foreach ($result as $results) {
                            $role_title     = $results->role_title;
                            $role_id    = $results->id; ?>
                           <option value="<?php echo $role_id;  ?>"><?php echo $role_title;  ?></option> <?php }  ?>                           
                        </select>
                    </div>
                </div>

									
                                    	<h4 class="card-title">Personal Information</h4>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>Full Name</label>
													<input type="text" class="form-control" name="user_name" required=""  autocomplete="off">
												</div>
												

                                                <div class="form-group">
													<label>CNIC</label>
													<input type="text" class="form-control" name="user_cnic" required="" autocomplete="off">
												</div>

                                                <div class="form-group">
													<label>Contact No</label>
													<input type="text" class="form-control" name="user_phone" required="" autocomplete="off">
												</div>											
										
											</div>
											<div class="col-md-6">
												
												<div class="form-group">
													<label>Email (Optional)</label>
													<input type="text" class="form-control" type="email" name="email"  autocomplete="off">
												</div>

												<div class="form-group">
													<label>Password</label>
													<input type="text" class="form-control" id="pass" name="passw" type="password"  >
												</div>
												<div class="form-group">
													<label>Repeat Password</label>
													<input type="text" class="form-control" id="pass1" name="pass1" type="password"   >
												</div>
											</div>
										</div>
										<h4 class="card-title">Address Information</h4>
										<div class="row">
											<div class="col-md-6">
												
                                                <div class="form-group"  type="text" required="" name="user_state" id="user_state">
													<label>State</label>
													   <select class="select  form-control"  name="user_state">
														<option>States</option>
														<?php 
                                                            foreach ($state as $states) {
                                                                 $name     = $states->name;
                                                                 $id    = $states->id; ?>
                                                        <option value="<?php echo $id;  ?>"><?php echo $name;  ?></option><?php }  ?>
														
													</select>
												</div>
                                                                                           
                                                <div class="form-group"      >
													<label>City</label>
													   <select class="select  form-control "  name="user_city">
														<option>Select</option>
														<?php 
                                                            foreach ($city as $cities) {
                                                              $name     = $cities->name;
                                                              $id    = $cities->id; ?>
                                                             <option value="<?php echo $id;  ?>"><?php echo $name;  ?></option><?php }  ?>
													</select>
												</div>



                                                </div>
											<div class="col-md-6">
                                            

                                                <div class="form-group">
													<label>Address</label>
													<textarea rows="5" cols="5" class="form-control" name="user_address"  autocomplete="off"></textarea>
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
		

        @endsection 
