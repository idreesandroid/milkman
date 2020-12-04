@extends('layouts.master')
@section('content')				
			<!-- Page Wrapper -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Add Permission</h4>
            </div>
            <div class="card-body">
                <form method="post">
                @csrf 
                    <div class="form-group row">
                        <label for="role_title" class="col-form-label col-md-2">Permission Title</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="name" required="" autocomplete="off" min="2">
                        </div>
                    </div>
                    <div class="form-group mb-0 row">                
                        <div class="col-md-4">                           
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Add Permission</button>
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