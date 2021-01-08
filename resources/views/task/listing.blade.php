@extends('layouts.master')
@section('content')

		
			
			
			<!-- Page Wrapper -->
            
			
				<!-- Page Content -->
                <div class="content container-fluid">

                	<div class="crms-title row bg-white">
                		<div class="col  p-0">
                			<h3 class="page-title m-0">
			                <span class="page-title-icon bg-gradient-primary text-white mr-2">
			                  <i class="fa fa-check-square-o" aria-hidden="true"></i>
			                </span> Tasks </h3>
                		</div>
                		<div class="col p-0 text-right">
                			<ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
								<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
								<li class="breadcrumb-item active">Task</li>
							</ul>
                		</div>
                	</div>
					
					<!-- Page Header -->
					<div class="page-header pt-3 mb-0 ">
						<div class="row">
							<div class="col">
								<div class="dropdown">
									<a class="dropdown-toggle recently-viewed" href="#" role="button" data-toggle="dropdown" aria-expanded="false"> All Tasks </a>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="#">Items I'm following</a>
			                        	<a class="dropdown-item" href="#">All Completed Tasks</a>
			                        	<a class="dropdown-item" href="#">My Delegated Tasks</a>
			                        	<a class="dropdown-item" href="#">My Completed Tasks</a>
			                        	<a class="dropdown-item" href="#">My Open Tasks</a>
			                        	<a class="dropdown-item" href="#">My Tasks</a>
			                        	<a class="dropdown-item" href="#">All Tasks</a>
									</div>
								</div>
							</div>
							<div class="col text-right">
								<ul class="list-inline-item pl-0">
					                <li class="nav-item dropdown list-inline-item add-lists">
					                    <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
					                        <div class="nav-profile-text">
					                          <i class="fa fa-th" aria-hidden="true"></i>
					                        </div>
					                    </a>
					                    <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
					                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#add-new-list">Add New List View</a>
					                    </div>
					                </li>
					                <li class="list-inline-item">
					                    <button class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" id="add-task" data-toggle="modal" data-target="#add_task">New Task</button>
					                </li>
					            </ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->


					<!-- Content Starts -->
					<div class="row">
						<div class="col-md-12">
							<div class="card mb-0">
								<div class="card-body">
								<div class="table-responsive">
									<table class="table table-striped table-nowrap custom-table mb-0 datatable">
										<thead>
											<tr>
												<th class="checkBox">
													<label class="container-checkbox">
													  	<input type="checkbox">
													  	<span class="checkmark"></span>
													</label>
												</th>
												<th>Task Name</th>
												<th>Percent Complete Indicator</th>
												<th>Responsible User</th>
												<th>Due Date</th>
												<th>Task Owner</th>
												<th>Status</th>
												<th></th>
												<th></th>
												<th class="text-right">Actions</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="checkBox">
													<label class="container-checkbox">
													  <input type="checkbox">
													  <span class="checkmark"></span>
													</label>
												</td>
												<td>
													<a href="#" class="text-decoration-none" data-toggle="modal" data-target="#task-details-modal">Personalize your account</a>
												</td>
												<td>
													<div class="progress">
						                                <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
						                            </div>
												</td>
												<td><a href="#" data-toggle="modal" data-target="#system-user">David cravo</a></td>
												<td>02, Jan 2020</td>
												<td>David cravo</td>
												<td><label class="badge badge-gradient-danger">Not Started</label></td>
												<td>
					                              <label class="container-checkbox">
													  	<input type="checkbox">
													  	<span class="checkmark"></span>
													</label>
					                            </td>
					                            <td class="checkBox"><i class="fa fa-star" aria-hidden="true"></i></td>
					                            <td class="text-center">
													<div class="dropdown dropdown-action">
														<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="#">Edit this task</a>
							                                <a class="dropdown-item" href="#">Complete This Task</a>
							                                <a class="dropdown-item" href="#">Complete Task &amp; Clone</a>
							                                <a class="dropdown-item" href="#">Change Record Owner</a>
							                                <a class="dropdown-item" href="#">Delete This Tasks</a>
							                                <a class="dropdown-item" href="#">Clone This Tasks</a>
							                                <a class="dropdown-item" href="#">Print This Tasks</a>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td class="checkBox">
													<label class="container-checkbox">
													  	<input type="checkbox">
													  	<span class="checkmark"></span>
													</label>
												</td>
												<td>
													<a href="#" class="text-decoration-none" data-toggle="modal" data-target="#task-details-modal">Add your customers</a>
												</td>
												<td>
													<div class="progress">
						                                <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 25%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
						                            </div>
												</td>
												<td><a href="#" data-toggle="modal" data-target="#system-user">John Doe</a></td>
												<td>02, Jan 2020</td>
												<td>John Doe</td>
												<td><label class="badge badge-gradient-success">Not Started</label></td>
												<td>
					                              <label class="container-checkbox">
													  	<input type="checkbox">
													  	<span class="checkmark"></span>
													</label>
					                            </td>
					                            <td class="checkBox"><i class="fa fa-star" aria-hidden="true"></i></td>
					                            <td class="text-center">
													<div class="dropdown dropdown-action">
														<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="#">Edit this task</a>
							                                <a class="dropdown-item" href="#">Complete This Task</a>
							                                <a class="dropdown-item" href="#">Complete Task &amp; Clone</a>
							                                <a class="dropdown-item" href="#">Change Record Owner</a>
							                                <a class="dropdown-item" href="#">Delete This Tasks</a>
							                                <a class="dropdown-item" href="#">Clone This Tasks</a>
							                                <a class="dropdown-item" href="#">Print This Tasks</a>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td class="checkBox">
													<label class="container-checkbox">
													  	<input type="checkbox">
													  	<span class="checkmark"></span>
													</label>
												</td>
												<td>
													<a href="#" class="text-decoration-none" data-toggle="modal" data-target="#task-details-modal">Invite your team</a>
												</td>
												<td>
													<div class="progress">
						                                <div class="progress-bar bg-gradient-info" role="progressbar" style="width: 50%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
						                            </div>
												</td>
												<td><a href="#" data-toggle="modal" data-target="#system-user">James amen</a></td>
												<td>02, Jan 2020</td>
												<td>James amen</td>
												<td><label class="badge badge-gradient-info">Not Started</label></td>
												<td>
					                             <label class="container-checkbox">
													  	<input type="checkbox">
													  	<span class="checkmark"></span>
													</label>
					                            </td>
					                            <td class="checkBox"><i class="fa fa-star" aria-hidden="true"></i></td>
					                            <td class="text-center">
													<div class="dropdown dropdown-action">
														<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="#">Edit this task</a>
							                                <a class="dropdown-item" href="#">Complete This Task</a>
							                                <a class="dropdown-item" href="#">Complete Task &amp; Clone</a>
							                                <a class="dropdown-item" href="#">Change Record Owner</a>
							                                <a class="dropdown-item" href="#">Delete This Tasks</a>
							                                <a class="dropdown-item" href="#">Clone This Tasks</a>
							                                <a class="dropdown-item" href="#">Print This Tasks</a>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td class="text-left checkbox">
													<label class="container-checkbox">
													  	<input type="checkbox">
													  	<span class="checkmark"></span>
													</label>
												</td>
												<td>
													<a href="#" class="text-decoration-none" data-toggle="modal" data-target="#task-details-modal">Save your emails</a>
												</td>
												<td>
													<div class="progress">
						                                <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
						                            </div>
												</td>
												<td><a href="#" data-toggle="modal" data-target="#system-user">Williams</a></td>
												<td>02, Jan 2020</td>
												<td>Williams</td>
												<td><label class="badge badge-gradient-warning">Not Started</label></td>
												<td>
					                              <label class="container-checkbox">
													  	<input type="checkbox">
													  	<span class="checkmark"></span>
													</label>
					                            </td>
					                            <td class="checkBox"><i class="fa fa-star" aria-hidden="true"></i></td>
					                            <td class="text-center">
													<div class="dropdown dropdown-action">
														<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="#">Edit this task</a>
							                                <a class="dropdown-item" href="#">Complete This Task</a>
							                                <a class="dropdown-item" href="#">Complete Task &amp; Clone</a>
							                                <a class="dropdown-item" href="#">Change Record Owner</a>
							                                <a class="dropdown-item" href="#">Delete This Tasks</a>
							                                <a class="dropdown-item" href="#">Clone This Tasks</a>
							                                <a class="dropdown-item" href="#">Print This Tasks</a>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td class="text-left checkbox">
													<label class="container-checkbox">
													  	<input type="checkbox">
													  	<span class="checkmark"></span>
													</label>
												</td>
												<td>
													<a href="#" class="text-decoration-none" data-toggle="modal" data-target="#task-details-modal">Connect to your files</a>
												</td>
												<td>
													<div class="progress">
						                                <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
						                            </div>
												</td>
												<td><a href="#" data-toggle="modal" data-target="#system-user">John Smith</a></td>
												<td>02, Jan 2020</td>
												<td>John Smith</td>
												<td><label class="badge badge-gradient-warning">Not Started</label></td>
												<td>
					                              <label class="container-checkbox">
													  	<input type="checkbox">
													  	<span class="checkmark"></span>
													</label>
					                            </td>
					                            <td class="checkBox"><i class="fa fa-star" aria-hidden="true"></i></td>
					                            <td class="text-center">
													<div class="dropdown dropdown-action">
														<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="#">Edit this task</a>
							                                <a class="dropdown-item" href="#">Complete This Task</a>
							                                <a class="dropdown-item" href="#">Complete Task &amp; Clone</a>
							                                <a class="dropdown-item" href="#">Change Record Owner</a>
							                                <a class="dropdown-item" href="#">Delete This Tasks</a>
							                                <a class="dropdown-item" href="#">Clone This Tasks</a>
							                                <a class="dropdown-item" href="#">Print This Tasks</a>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td class="checkBox">
													<label class="container-checkbox">
													  <input type="checkbox">
													  <span class="checkmark"></span>
													</label>
												</td>
												<td>
													<a href="#" class="text-decoration-none" data-toggle="modal" data-target="#task-details-modal">Personalize your account</a>
												</td>
												<td>
													<div class="progress">
						                                <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
						                            </div>
												</td>
												<td><a href="#" data-toggle="modal" data-target="#system-user">David cravo</a></td>
												<td>02, Jan 2020</td>
												<td>David cravo</td>
												<td><label class="badge badge-gradient-danger">Not Started</label></td>
												<td>
					                              <label class="container-checkbox">
													  	<input type="checkbox">
													  	<span class="checkmark"></span>
													</label>
					                            </td>
					                            <td class="checkBox"><i class="fa fa-star" aria-hidden="true"></i></td>
					                            <td class="text-center">
													<div class="dropdown dropdown-action">
														<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="#">Edit this task</a>
							                                <a class="dropdown-item" href="#">Complete This Task</a>
							                                <a class="dropdown-item" href="#">Complete Task &amp; Clone</a>
							                                <a class="dropdown-item" href="#">Change Record Owner</a>
							                                <a class="dropdown-item" href="#">Delete This Tasks</a>
							                                <a class="dropdown-item" href="#">Clone This Tasks</a>
							                                <a class="dropdown-item" href="#">Print This Tasks</a>
														</div>
													</div>
												</td>
											</tr>
											<tr>
												<td class="text-left checkbox">
													<label class="container-checkbox">
													  	<input type="checkbox">
													  	<span class="checkmark"></span>
													</label>
												</td>
												<td>
													<a href="#" class="text-decoration-none" data-toggle="modal" data-target="#task-details-modal">Customers Meeting</a>
												</td>
												<td>
													<div class="progress">
						                                <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
						                            </div>
												</td>
												<td><a href="#" data-toggle="modal" data-target="#system-user">John Smith</a></td>
												<td>02, Jan 2020</td>
												<td>John Smith</td>
												<td><label class="badge badge-gradient-warning">Not Started</label></td>
												<td>
					                              <label class="container-checkbox">
													  	<input type="checkbox">
													  	<span class="checkmark"></span>
													</label>
					                            </td>
					                            <td class="checkBox"><i class="fa fa-star" aria-hidden="true"></i></td>
					                            <td class="text-center">
													<div class="dropdown dropdown-action">
														<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
														<div class="dropdown-menu dropdown-menu-right">
															<a class="dropdown-item" href="#">Edit this task</a>
							                                <a class="dropdown-item" href="#">Complete This Task</a>
							                                <a class="dropdown-item" href="#">Complete Task &amp; Clone</a>
							                                <a class="dropdown-item" href="#">Change Record Owner</a>
							                                <a class="dropdown-item" href="#">Delete This Tasks</a>
							                                <a class="dropdown-item" href="#">Clone This Tasks</a>
							                                <a class="dropdown-item" href="#">Print This Tasks</a>
														</div>
													</div>
												</td>
											</tr>
											
										</tbody>
									</table>
								</div>
							</div>
							</div>
						</div>
					</div>
					<!-- /Content End -->
					
                </div>
				<!-- /Page Content -->
				
           
			<!-- /Page Wrapper -->
			
        



@endsection