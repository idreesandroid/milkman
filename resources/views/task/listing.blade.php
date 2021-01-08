@extends('layouts.master')
@section('content')
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
					<a class="recently-viewed" href="#" role="button" data-toggle="dropdown" aria-expanded="false"> All Tasks </a>					
				</div>
			</div>
			<div class="col text-right">
				<ul class="list-inline-item pl-0">	                
	                <li class="list-inline-item">
	                    <button class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded" id="add-task" data-toggle="modal" data-target="#createCustomTask">Create Custom Task</button>
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
								<th>Collector</th>								
								<th>Vendor</th>
								<th>Due Date & Time</th>								
								<th>Status</th>	
								<th style="text-align: center;">Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr>								
								<td>
									<a href="#" class="text-decoration-none" data-toggle="modal">Idrees</a>
								</td>								
								<td><a href="#" data-toggle="modal" data-target="#system-user">Kafeel Ahmed</a></td>
								<td>08, Jan 2021 9:30AM</td>								
								<td><label class="badge badge-gradient-danger">Missed</label></td>
								<td style="text-align: center;">
									<a href="#" class="btn btn-primary">Start</a>
									<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#completedtask">Complete</a>
									<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#taskDetial">Detail</a>
								</td>
							</tr>
							<tr>
								<td>
									<a href="#" class="text-decoration-none" data-toggle="modal">Idrees</a>
								</td>
								<td><a href="#" data-toggle="modal" data-target="#system-user">Asim Javaid</a></td>
								<td>02, Jan 2021 8:30AM</td>								
								<td><label class="badge badge-gradient-success">Collected</label></td>
								<td style="text-align: center;">
									<a href="#" class="btn btn-primary">Start</a>
									<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#completedtask">Complete</a>
									<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#taskDetial">Detail</a>
								</td>
							</tr>
							<tr>								
								<td>
									<a href="#" class="text-decoration-none" data-toggle="modal">Idrees</a>
								</td>
								<td><a href="#" data-toggle="modal" data-target="#system-user">Zeeshan</a></td>
								<td>08, Jan 2021 4:00PM</td>								
								<td><label class="badge badge-gradient-info">Not Started</label></td>
								<td style="text-align: center;">
									<a href="#" class="btn btn-primary">Start</a>
									<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#completedtask">Complete</a>
									<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#taskDetial">Detail</a>
								</td>
							</tr>													
						</tbody>
					</table>
				</div>
			</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal right fade" id="createCustomTask" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog" role="document">
        <button type="button" class="close md-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close xs-close" data-dismiss="modal">×</button>
            <div class="row w-100">
            	<div class="col-md-7 account d-flex">
                  	<div class="company_img">
                  		<img src="assets/img/task.png" alt="User" class="user-image" class="img-fluid" />
              		</div>
              		<div>
              			<p class="mb-0">Task</p>
              			<span class="modal-title">Assign a custom Task</span>
                		<span class="rating-star"><i class="fa fa-star" aria-hidden="true"></i></span>
                		<span class="lock"><i class="fa fa-lock" aria-hidden="true"></i></span>
              		</div>

             	 </div>
            </div>
           
          </div>

          <div class="modal-body">
					<div class="row">
				        <div class="col-md-12">
				            <form>
				            	<h4>Task Details</h4>
				                <div class="form-group row">
									<div class="col-sm-6">
										 <label class="col-form-label">Collector<span class="text-danger">*</span></label>
		                            	<select class="form-control">
		                            		<option>collector name -- capacity</option>
			                                <option>anees collector -- 20kg</option>
			                                <option>kafeel collector -- 10kg</option>
			                                <option>asim collector -- 25kg</option>
			                            </select>
									</div>
									<div class="col-sm-6">
										<label class="col-form-label">Vendor Name</label>
			                            <select class="form-control">
			                                <option>Zeeshan</option>
			                                <option>Qadri</option>
			                                <option>Kareem</option>
			                            </select>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-6">
										<label class="col-form-label">Priority</label>
			                            <select class="form-control">
			                                <option>Low</option>
			                                <option>Medium</option>
			                                <option>High</option>
			                             </select>
									</div>
									<div class="col-sm-6">
										<label class="col-form-label">Due Date & Time <span class="text-danger">*</span></label>
		                                <div class="cal-icon"><input class="form-control datetimepicker" type="datetime-local" placeholder="MM/DD/YY"></div>
									</div>
								</div>
				                <div class="text-center py-3">
				                	<button type="button" class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Create Custom Task</button>&nbsp;&nbsp;
				                	<button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal">Cancel</button>
				                </div>
				            </form>
				        </div>
					</div>
				</div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->
<div class="modal right fade" id="completedtask" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog" role="document">
        <button type="button" class="close md-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close xs-close" data-dismiss="modal">×</button>
            <div class="row w-100">
            	<div class="col-md-7 account d-flex">
                  	<div class="company_img">
                  		<img src="assets/img/task.png" alt="User" class="user-image" class="img-fluid" />
              		</div>
              		<div>
              			<p class="mb-0">Complete Task</p>
              			<span class="modal-title">After collection of Milk</span>
                		<span class="rating-star"><i class="fa fa-star" aria-hidden="true"></i></span>
                		<span class="lock"><i class="fa fa-lock" aria-hidden="true"></i></span>
              		</div>

             	 </div>
            </div>
           
          </div>

          <div class="modal-body">
					<div class="row">
				        <div class="col-md-12">
				            <form>
				            	<h4>Task Details</h4>
				                <div class="form-group row">
									<div class="col-sm-6">
										<label class="col-form-label">Milk Amount<span class="text-danger">*</span></label>
		                            	<input class="form-control" type="text" name="task-name" id="task-name" placeholder="Milk Amount in KG">
									</div>
									<div class="col-sm-6">
										<label class="col-form-label">Lactometer Reading</label>
			                            <input class="form-control" type="text" name="task-name" id="task-name" placeholder="Lactometer Reading">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-6">
										<label class="col-form-label">Milk Taste</label>
			                            <select class="form-control">
			                                <option>Select the Taste you Observe</option>
			                                <option>Poor</option>
			                                <option>Normal</option>
			                                <option>Good</option>
			                             </select>
									</div>									
								</div>
				                <div class="text-center py-3">
				                	<button type="button" class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Save</button>&nbsp;&nbsp;
				                	<button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal">Cancel</button>
				                </div>
				            </form>
				        </div>
					</div>
				</div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->

<!--system users Modal -->
<div class="modal right fade" id="taskDetial" tabindex="-1" role="dialog" aria-modal="true">
  <div class="modal-dialog" role="document">
    <button type="button" class="close md-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close xs-close" data-dismiss="modal">×</button>
        <div class="row w-100">
          <div class="col-md-7 account d-flex">
          	<div class="company_img">
          		<img src="assets/img/system-user.png" alt="User" class="user-image" class="img-fluid" />
      		</div>
      		<div>
      			<p class="mb-0">Collector Name</p>
      			<span class="modal-title">Idrees</span>
        		<span class="rating-star"><i class="fa fa-star" aria-hidden="true"></i></span>
        		<span class="lock"><i class="fa fa-lock" aria-hidden="true"></i></span>
      		</div>

          </div>
        </div>
       
      </div>
      <div class="modal-body">
        <div class="task-infos">
        	<table class="table">
                                <tbody>                                  
                                  <tr>
                                    <td class="border-0">Vendor Name:</td>
                                    <td class="border-0">Kafeel Ahmed</td>
                                  </tr>
                                  <tr>
                                    <td>Start Time:</td>
                                    <td>10:05 PM</td>
                                  </tr>
                                  <tr>
                                    <td>End Time:</td>
                                    <td>10:12 AM</td>
                                  </tr>
                                  <tr>
                                    <td>Milk Taste:</td>
                                    <td>Good</td>
                                  </tr>
                                  <tr>
                                    <td>Lactometer Reading:</td>
                                    <td>30</td>
                                  </tr>
                                  <tr>
                                    <td>Milk Amount:</td>
                                    <td>50kg</td>
                                  </tr>
                                  <tr>
                                    <td>Priority:</td>
                                    <td>High</td>
                                  </tr>
                                  <tr>
                                    <td>Status:</td>
                                    <td>Collected</td>
                                  </tr>
                                </tbody>
                            </table>
      </div>
    </div>

    </div><!-- modal-content -->
  </div><!-- modal-dialog -->
</div><!-- modal -->	
@endsection