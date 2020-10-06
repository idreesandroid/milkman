@extends('layouts.master')
@section('content')
		
			
						
			<!-- Page Wrapper -->
					
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Generate Invoice</h4>
            </div>
            <div class="card-body">
                <form method="post">
                @csrf 

                <div class="form-group row">
                    <label for="buyer_id" class="col-form-label col-md-2">Buyer Name</label>
                    <div class="col-md-4">
                        <select class="form-control" name="buyer_id" required="">
                            <option value="">--Buyer Name--</option>
                            @foreach ($buyers as $buyer)
                             <option value="{{ $buyer->id}}" >{{ $buyer->name}}</option>
                             @endforeach                            
                        </select>
                    </div>
                </div>                  


                    <div class="form-group mb-0 row">                
                        <div class="col-md-4">                           
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Add New Invoice</button>
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