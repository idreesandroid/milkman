
						<?php 
						
						$date_form = '2020-07-01';
						$date_to = date('Y-m-d');
						?>
						
				 
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
					 