
						<?php 
						
						$date_form = '2020-07-01';
						$date_to = date('Y-m-d');
						?>
						
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
								<li><a href="/profile">Profile</a></li>
									<li><a href="/vendorLedgerDetail/{{session()->get('u_id') }}/{{$date_form}}/{{$date_to}}" class="active">Payment Detail</a></li>
									
									 
								</ul>
							</li>
							</ul>