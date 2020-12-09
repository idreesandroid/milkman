@extends('layouts.master')
@section('content')

<!-- Main Wrapper -->

			
			<!-- Page Wrapper -->
         
                           			
				<!-- Page Content -->
              
					
					<!-- Page Header -->
					<div class="page-header pt-3 mb-0">
						<div class="card ">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="profile-view">
										<div class="profile-img-wrap">
											<div class="profile-img">
												<img alt="" src="{{asset('/UserProfile/'.$users->filenames)}}">
											</div>
										</div>
										<div class="profile-basic">
											<div class="row">
												<div class="col-md-5">
													<div class="profile-info-left">
														<h3 class="user-name m-t-0 mb-0">{{$users->name}}</h3>
                                                      
                                                         @foreach ($users->roles as $role)
														<h6 class="text-muted">{{$role->name}}</h6>
														@endforeach
														<div class="staff-id">CNIC : {{$users->user_cnic}}</div>
														<div class="small doj text-muted">Date of Join : {{$users->created_at}}</div>
														<div class="staff-msg"><a class="btn" href="#" style="visibility:hidden;">$nbsp;</a></div>
													</div>
												</div>
												<div class="col-md-7">
													<ul class="personal-info">
														<li>
															<div class="title">Phone:</div>
															<div class="text">{{$users->user_phone}}</div>
														</li>
														<li>
															<div class="title">Email:</div>
															<div class="text"><a href="">{{$users->email}}</a></div>
														</li>
														
														<li>
															<div class="title">Address:</div>
															<div class="text">{{$users->user_address}}</div>
														</li>
														<li>
															<div ></div>
															<div class="text"></div>
														</li>
														<li>
															<div class="title">Reports to:</div>
															<div class="text">
															   <div class="avatar-box">
																  <div class="avatar avatar-xs">
																	 <img src="assets/img/profiles/avatar-16.jpg" alt="">
																  </div>
															   </div>
															  
																	here will be the area manager may be
																
															</div>
														</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="pro-edit"><a data-target="#profile_info" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="tab-content p-0">
					
						<!-- Profile Info Tab -->
                        
						<div id="emp_profile" class="pro-overview tab-pane fade show active">
							<div class="row">
								<div class="col-md-6 d-flex">
									<div class="card profile-box flex-fill">
										<div class="card-body">
										@if(isset($users->distributorCompany->companyName))
										<h3 class="card-title">Company Informations <a href="#" class="edit-icon" data-toggle="modal" data-target="#personal_info_modal"><i class="fa fa-pencil"></i></a></h3>
										@endif
										@if(isset($users->vendorDetail->decided_milkQuantity))
										<h3 class="card-title">Company Informations <a href="#" class="edit-icon" data-toggle="modal" data-target="#personal_info_modal"><i class="fa fa-pencil"></i></a></h3>
										@endif

                                            <ul class="personal-info">
                                            @if(isset($users->distributorCompany->companyName))
                                            <li>
													<div class="title">Logo.</div>
                                                    <div class="text">logo here</div>
												</li>
                                                @endif
                                                @if(isset($users->distributorCompany->companyName))
                                                <li>
													<div class="title">Name.</div>
													<div class="text">{{$users->distributorCompany->companyName}}</div>
												</li>
                                                @endif
                                                @if(isset($users->distributorCompany->companyOwner))
												<li>
													<div class="title">Owner.</div>
													<div class="text">{{$users->distributorCompany->companyOwner}}</div>
												</li>
                                                @endif
                                                @if(isset($users->distributorCompany->companyContact))
												<li>
													<div class="title">Tel</div>
													<div class="text">{{$users->distributorCompany->companyContact}}</div>
												</li>
                                                @endif
                                                @if(isset($users->distributorCompany->companyNTN))
                                                <li>
													<div class="title">NTN</div>
													<div class="text">{{$users->distributorCompany->companyNTN}}</div>
												</li>
                                                @endif
                                                @if(isset($users->distributorCompany->companyAddress))
												<li>
													<div class="title">Address</div>
													<div class="text">{{$users->distributorCompany->companyAddress}}</div>
												</li>
                                                @endif

                                                @if(isset($users->vendorDetail->decided_milkQuantity))
												<li>
													<div class="title">Address</div>
													<div class="text">{{$users->vendorDetail->decided_milkQuantity}}</div>
												</li>
                                                @endif

                                                @if(isset($users->vendorDetail->decided_rate))
												<li>
													<div class="title">Address</div>
													<div class="text">{{$users->vendorDetail->decided_rate}}</div>
												</li>
                                                @endif

											</ul>
										</div>
									</div>
								</div>

								<div class="col-md-6 d-flex">
									<div class="card profile-box flex-fill">
										<div class="card-body">
											<h3 class="card-title">Bank information</h3>
											<ul class="personal-info">
        
												<li>
													<div class="title">Account Holder.</div>
                                                    @if(isset($users->bankDetail->acc_title))
													<div class="text">{{$users->bankDetail->acc_title}}</div>
                                                    @endif
												</li>
												<li>
													<div class="title">Bank account No.</div>
                                                    @if(isset($users->bankDetail->acc_no))
													<div class="text">{{$users->bankDetail->acc_no}}</div>
                                                    @endif
												</li>
												<li>
													<div class="title">Bank Name.</div>
                                                    @if(isset($users->bankDetail->bank_name))
													<div class="text">{{$users->bankDetail->bank_name}}</div>
                                                    @endif
												</li>
												<li>
													<div class="title">Branch Name.</div>
                                                    @if(isset($users->bankDetail->branch_name))
													<div class="text">{{$users->bankDetail->branch_name}}</div>
                                                    @endif
												</li>
                                                <li>
													<div class="title">Branch Code.</div>
                                                    @if(isset($users->bankDetail->branch_code))
													<div class="text">{{$users->bankDetail->branch_code}}</div>
                                                    @endif
												</li>
                                               
											</ul>
										</div>
									</div>
								</div>

							</div>
							
							
							<div class="row">
	
							</div>
							
						</div>
						<!-- /Profile Info Tab -->
						
						
						
						
						
					</div>

					</div>
					<!-- /Page Header -->
					
					
                </div>
				<!-- /Page Content -->
				
          
			<!-- /Page Wrapper -->
			
		<!-- /Main Wrapper -->

		@endsection