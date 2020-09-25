@extends('layouts.master')
@section('content')
   

						<div class="col-md-12">
							<div class="card mb-0">
								<div class="card-body">
								<div class="table-responsive">
									<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="DataTables_Table_0_length"><label>Show <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table class="table table-striped table-nowrap custom-table mb-0 datatable dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
										<thead>
											<tr role="row">
                                            <th class="checkBox sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="
													
													  	
													  	
													
												: activate to sort column descending" style="width: 35px;">
													<label class="container-checkbox">
													  	<input type="checkbox">
													  	<span class="checkmark"></span>
													</label>
												</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Task Name: activate to sort column ascending" style="width: 130px;">Task Time</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Percent Complete Indicator: activate to sort column ascending" style="width: 175px;">Percent Complete Indicator</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Responsible User: activate to sort column ascending" style="width: 114px;">Responsible User</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Due Date: activate to sort column ascending" style="width: 61px;">Due Date</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Task Owner: activate to sort column ascending" style="width: 76px;">Received Qty</th>
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 58px;">Status</th>
                                                
                                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label=": activate to sort column ascending" style="width: 0px;"></th>
                                                <th class="text-right sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending" style="width: 48px;">Actions</th></tr>
										</thead>
										<tbody>
											
											
											
											
											
											
											
                                        @foreach ($task_lists as $task_list)
										<tr role="row" class="odd">
												<td class="checkBox sorting_1">
													<label class="container-checkbox">
													  	<input type="checkbox">
													  	<span class="checkmark"></span>
													</label>
												</td>
												<td>
													<a href="#" class="text-decoration-none" data-toggle="modal" data-target="#task-details-modal">{{ $task_list->task_time }}</a>
												</td>
												<td>
													<div class="progress">
						                                <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 25%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
						                            </div>
												</td>
												<td><a href="#" data-toggle="modal" data-target="#system-user">{{ $task_list->collector_name}}</a></td>
												<td>{{ $task_list->created_time }}</td>
												<td>{{ $task_list->received_qty}}</td>
												<td>
@if($task_list->received_qty)
<label class="badge badge-gradient-success">Collected</label>
@else
<label class="badge badge-gradient-danger">Not Started</label>
@endif												
												
												
												</td>
											
					                            <td class="checkBox">
												@if($task_list->received_qty)
 
												<i class="fa fa-star" aria-hidden="true">
												@endif </i>
												</td>
					                            <td class="text-center">
												<a href="/task_collection/{{ $task_list->task_id }}"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>
												</td>
                                            </tr>
                                            @endforeach
											</tbody>
									</table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 7 of 7 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous"><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item next disabled" id="DataTables_Table_0_next"><a href="#" aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
								</div>
							</div>
							</div>
						</div>
					</div>
 @endsection


@section('scripts')

@endsection