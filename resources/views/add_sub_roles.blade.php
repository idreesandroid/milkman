@extends('layouts.master')
@section('content')
		
			
						
			<!-- Page Wrapper -->
					
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Add Role</h4>
            </div>
            <div class="card-body">
<?php if(isset($msg1)){ echo count($msg1); } ?>
  
 
          
                <form method="post">
                @csrf 
                    <div class="form-group row">
                        <label for="role_title" class="col-form-label col-md-2">Roles</label>
                        <div class="col-md-10">
                            <select  class="form-control" name="role_id" required="">

<option value="">--Roles--</option>


@foreach($roles_list as $roles_l )

<option value="{{ $roles_l->role_id  }}">{{  $roles_l->role_title  }}</option>


@endforeach


                             </select>
                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="role_title" class="col-form-label col-md-2">Sub Role Title</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="sub_role_title" required="">
                        </div>
                    </div>

                
                    <div class="form-group mb-0 row">                
                        <div class="col-md-10">                           
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Add Sub Role</button>
                            </div>                           
                        </div>
                    </div>
                       
                </form>
            </div>
        </div>
        
    </div>

    
</div>
				
			
			<!-- /page Wrapper -->
		
            @endsection