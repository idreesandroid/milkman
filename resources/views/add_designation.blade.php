@extends('layouts.master')
@section('content')
		
			
						
			<!-- Page Wrapper -->
		 			
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Add Designation</h4>
            </div>
            <div class="card-body">
<?php if(isset($msg1)){ echo count($msg1); } ?>
  
 
          
                <form method="post">
                @csrf 
                   



                    <div class="form-group row">
                        <label for="role_title" class="col-form-label col-md-2">Designation</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="designation_title" required="">
                        </div>
                    </div>

                
                    <div class="form-group mb-0 row">                
                        <div class="col-md-10">                           
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Add Designation</button>
                            </div>                           
                        </div>
                    </div>
                       
                </form>
            </div>

           
       <hr/>

 <table class="datatable table table-stripped mb-0 datatables ">
<thead>
<tr>
<th>Serial No.</th>
    <th>Designation ID</th>
    <th>Designation Title</th>
</tr>
</thead>

<tbody>
 
@foreach($load_designation as  $index =>  $load_design)

<tr>
    <td>{{$index+1}}</td>
    <td>{{$load_design->id}}</td>
    <td>{{$load_design->designation_title}}</td>
 
</tr>

@endforeach
 
</tbody>

 
          </table> 
          </div>
    </div>

    
</div>
				
			
			<!-- /page Wrapper -->
		
            @endsection