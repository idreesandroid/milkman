
						<ul>
							<li class="nav-item nav-profile">
				              <a href="#" class="nav-link">
				                <div class="nav-profile-image">
				                  <img src="assets/img/profiles/avatar-17.jpg" alt="profile">
				                  
				                </div>
				                <div class="nav-profile-text d-flex flex-column">
				                  <span class="font-weight-bold mb-2">{{ session()->get('user_name') }}</span>
				                  <span class="text-white text-small">{{ session()->get('role_title') }}</span>
				                </div>
				                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
				              </a>
				            </li>
							<li class="menu-title"> 
								<span>Main</span>
							</li>
							<li class="submenu">
								<a href="javascript:void(0);"><i class="fa fa-tachometer" aria-hidden="true"></i> <span> Dashboard</span> <span class="menu-arrow"></span></a>
								<ul class="sub-menus">
									<li><a href="/register" class="active">Register</a></li>
									<li><a href="/profile">Profile</a></li>
									<li><a href="/user/userList">User List</a></li>
								</ul>
							</li>
							<li> 
								<a href="#"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span>Role</span></a>
								<ul class="sub-menus">
									<li><a href="/Role/create" class="active">Enter Role</a></li>
									<li><a href="/Role/index" class="active">Role List</a></li>
									 
									<li><a href="/add_sub_roles" class="active">Add Sub Roles</a></li>
									 
								</ul>
							</li>





							<li> 
								<a href="#"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span>Vendors</span></a>
								<ul class="sub-menus">
									<li><a href="/VendorDetail/create" class="active">Enter Vendor Detail</a></li>
									<li><a href="/VendorDetail/index" class="active">Vendors List</a></li>
									<li><a href="/vendorLedger" class="active">Vendors Ledger</a></li>
									
									 
								</ul>
							</li>


							
							
							<li> 
								<a href="#"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span>Tasks</span></a>
								<ul class="sub-menus">
									<li><a href="/set_task" class="active">Set Task</a></li>
									<li><a href="/task_list" class="active">Tasks List</a></li>
									 
									
									 
								</ul>
							</li>
							<li> 
								<a href="#"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span>Products</span></a>
								<ul class="sub-menus">
									
									<li><a href="/Product/create" class="active">New Product</a></li>
									<li><a href="/Product/index" class="active">Product List</a></li>
									 
								</ul>
							</li>

							<li> 
								<a href="#"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span>Stock</span></a>
								<ul class="sub-menus">
									
									<li><a href="/ProductStock/create" class="active">New Product</a></li>
									<li><a href="/ProductStock/index" class="active">Product List</a></li>
									 
								</ul>
							</li>
							
							<li> 
								<a href="#"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span>Routs</span></a>
								<ul class="sub-menus">
									
									<li><a href="/VendorRoute/create" class="active">New Rout</a></li>
									<li><a href="/VendorRoute/index" class="active">Routs List</a></li>
									 
								</ul>
							</li>
							<li> 
								<a href="#"><i class="fa fa-check-square-o" aria-hidden="true"></i> <span>Payments</span></a>
								<ul class="sub-menus">
									<li><a href="/payment" class="active">Payment Entry</a></li>
								</ul>
							</li>



							<li class="submenu">
								<a href="javascript:void(0);"><i class="fa fa-retweet" aria-hidden="true"></i> <span>Multi Level</span> <span class="menu-arrow"></span></a>
								<ul class="sub-menus">
									<li class="submenu">
										<a href="javascript:void(0);"> <span>Level 1</span> <span class="menu-arrow"></span></a>
										<ul class="sub-menus">
											<li><a href="javascript:void(0);"><span>Level 2</span></a></li>
											<li class="submenu">
												<a href="javascript:void(0);"> <span> Level 2</span> <span class="menu-arrow"></span></a>
												<ul class="sub-menus">
													<li><a href="javascript:void(0);">Level 3</a></li>
													<li><a href="javascript:void(0);">Level 3</a></li>
												</ul>
											</li>
											<li><a href="javascript:void(0);"> <span>Level 2</span></a></li>
										</ul>
									</li>
									<li>
										<a href="javascript:void(0);"> <span>Level 1</span></a>
									</li>
								</ul>
							</li>
						</ul>