
@extends('layouts.master')
@section('content')
			
<!-- Page Wrapper -->
           

					

    <div class="row">
        <div class="col-sm-6">
            <div class="card mb-0">
                
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="datatable table table-stripped mb-0 datatables">
                            <thead>
                                <tr>
                                <th>Serial No</th>
                                
                                <th>Role Title</th>                                                           
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $index => $role)
                            <tr>
                            <td>{{$index+1}}</td>
                            
                            <td>{{$role->role_title}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
				
				
			<!-- /Page Wrapper -->
 @endsection

		       

	