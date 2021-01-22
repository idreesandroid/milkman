

@extends('layouts.master')
@section('content')
<!-- Page Header -->
<div class="crms-title row bg-white mb-4">
   <div class="col">
      <h3 class="page-title">
         <span class="page-title-icon bg-gradient-primary text-white mr-2">
         <i class="la la-table"></i>
         </span> <span>MilkMan Dashboard</span>
      </h3>
   </div>
   <div class="col text-right">
      <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
         <li class="breadcrumb-item"><a href="/">User</a></li>
         <li class="breadcrumb-item active">Profile</li>
      </ul>
   </div>
</div>
<!-- /Page Header -->
@if ($errors->any())
@foreach ($errors->all() as $error)
<div>{{$error}}</div>
@endforeach
@endif
<!-- Page Wrapper -->
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
                              <div class="small doj text-muted">Date of Join : {{timeFormat($users->created_at)['date']}}</div>
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
                              <!-- <li>
                                 <div class="title">Reports to:</div>
                                 <div class="text">
                                    <div class="avatar-box">
                                 	  <div class="avatar avatar-xs">
                                 		 <img src="assets/img/profiles/avatar-16.jpg" alt="">
                                 	  </div>
                                    </div>
                                   
                                 		here will be the area manager may be
                                 	
                                 </div>
                                 </li> -->
                           </ul>
                        </div>                        
                     </div>
                  </div>
                  @can('Edit-User')
                  <div class="pro-edit"><a data-target="#userModal" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
                  @endcan
                  @can('Edit-Personal-Profile')
                  <div ><a data-target="#passwordChange" data-toggle="modal"  href="#">Change Password</a></div>
                  @endcan
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
                     @can('Edit-Company-Detail')
                     @if(isset($users->distributorCompany->companyName))
                     <h3 class="card-title">Company Informations <a href="#" class="edit-icon" data-toggle="modal" data-target="#companyModal"><i class="fa fa-pencil"></i></a></h3>
                     @endif
                     @endcan
                     @can('Edit-Agreement-Detail')
                     @if(isset($users->vendorDetail->decided_milkQuantity))
                     <h3 class="card-title">Deals Information <a href="#" class="edit-icon" data-toggle="modal" data-target="#dealModal"><i class="fa fa-pencil"></i></a></h3>
                     @endif
                     @endcan
                     <ul class="personal-info">
                        @if(isset($users->distributorCompany->companyName))
                        <li>
                           <div class="title">Logo.</div>
                           <div class="text company-logo"><img src="{{asset('/distributorCompany/'.$users->distributorCompany->companyLogo)}}" alt="Logo" class="img-thumbnail"></div>
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
                           <div class="title">Decided Quantity</div>
                           <div class="text">{{$users->vendorDetail->decided_milkQuantity}}</div>
                        </li>
                        @endif
                        @if(isset($users->vendorDetail->morning_decided_milkQuantity))
                        <li>
                           <div class="title">Morning Quantity</div>
                           <div class="text">{{$users->vendorDetail->morning_decided_milkQuantity}}</div>
                        </li>
                        @endif
                        @if(isset($users->vendorDetail->evening_decided_milkQuantity))
                        <li>
                           <div class="title">Evening Quantity</div>
                           <div class="text">{{$users->vendorDetail->evening_decided_milkQuantity}}</div>
                        </li>
                        @endif
                        @if(isset($users->vendorDetail->decided_rate))
                        <li>
                           <div class="title">Decided Rate</div>
                           <div class="text">{{$users->vendorDetail->decided_rate}}</div>
                        </li>
                        @endif
                        @if(isset($users->vendorDetail->morningTime))
                        <li>
                           <div class="title">Morning Time</div>
                           <div class="text">{{$users->vendorDetail->morningTime}}</div>
                        </li>
                        @endif
                        @if(isset($users->vendorDetail->eveningTime))
                        <li>
                           <div class="title">Evening Time</div>
                           <div class="text">{{$users->vendorDetail->eveningTime}}</div>
                        </li>
                        @endif
                     </ul>
                  </div>
               </div>
            </div>
            @if(isset($users->bankDetail->acc_title))
            <div class="col-md-6 d-flex">
               <div class="card profile-box flex-fill">
                  <div class="card-body">
                     <h3 class="card-title">Bank information</h3>
                     <div class="pro-edit bankedit-box"><a data-target="#bankModal" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
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
         @endif
      </div>
   </div>
   @if(isset($location))
   <div class="map" id="ProfielMap"></div>
   <div class="row">
      <div class="col-md-12">
         <div class="form-group">                        
            <input type="text" class="form-control" id="addProfileMapData" name="vendors_location" value="{{$location}}" readonly>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-2">
         <div class="form-group">                        
            <input type="button" disabled  class="form-control btn btn-info"  value="Add Map" id="saveProfleMap">
         </div>
      </div>
      <div class="col-md-2">
         <div class="form-group">                        
            <input type="button" class="form-control btn btn-danger"  value="Clear Map" id="ProfileClearShapes">
         </div>
      </div>
      <div class="col-md-4">
         <div class="form-group">                        
            <input type="button" id="ProfileRestoreMap" class="form-control btn btn-primary"  value="Restore Map">
         </div>
      </div>     
   </div>
   @endif
   <!-- /Profile Info Tab -->
   <!-- User Model-->
   <div id="userModal" class="modal fade" role="dialog">
      <div class="modal-dialog" >
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
               <div class="table-responsive">
                  <form method="post"  action="{{ route('update.userList' , $users->id) }}">
                     @csrf 
                     <div class="form-group row">
                        <label for="name" class="col-form-label col-md-2">Name</label>
                        <div class="col-md-10">
                           <input type="text" class="form-control" name="name" value="{{ $users->name }}" required="">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="email" class="col-form-label col-md-2">Email</label>
                        <div class="col-md-10">
                           <input type="email" class="form-control" name="email" value="{{ $users->email }}" required="">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="user_cnic" class="col-form-label col-md-2">CNIC</label>
                        <div class="col-md-10">
                           <input type="text" class="form-control" name="user_cnic" value="{{ $users->user_cnic }}" required="">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="user_phone" class="col-form-label col-md-2">Phone</label>
                        <div class="col-md-10">
                           <input type="text" class="form-control" name="user_phone" value="{{ $users->user_phone }}" required="">
                        </div>
                     </div>
                     <!--Role List-->
                     <!--/ Role List-->
                     <div class="form-group row">
                        <label for="user_address" class="col-form-label col-md-2">Address</label>
                        <div class="col-md-10">
                           <input type="text" class="form-control" name="user_address" value="{{ $users->user_address }}" required="">
                        </div>
                     </div>
                     <div class="form-group mb-0 row">
                        <div class="col-md-10">
                           <div class="input-group-append">
                              <button class="btn btn-primary" type="submit">Update</button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
   <!-- / User Model -->	
   @can('Edit-Company-Detail')
   @if(isset($users->distributorCompany->companyName))
   <!-- Company Model-->
   <div id="companyModal" class="modal fade" role="dialog">
      <div class="modal-dialog" >
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
               <div class="table-responsive">
                  <form method="post"  action="{{ route('companyDetail.distributor' , $users->id) }}">
                     @csrf 
                     <div class="form-group row">
                        <label for="companyOwner" class="col-form-label col-md-2">Owner</label>
                        <div class="col-md-10">
                           <input type="text" class="form-control" name="companyOwner" value="{{ $users->distributorCompany->companyOwner }}" required="">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="companyName" class="col-form-label col-md-2">Company Name</label>
                        <div class="col-md-10">
                           <input type="text" class="form-control" name="companyName" value="{{ $users->distributorCompany->companyName }}" required="">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="companyContact" class="col-form-label col-md-2">Company Contact</label>
                        <div class="col-md-10">
                           <input type="text" class="form-control" name="companyContact" value="{{ $users->distributorCompany->companyContact }}" required="">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="companyNTN" class="col-form-label col-md-2">Company NTN</label>
                        <div class="col-md-10">
                           <input type="text" class="form-control" name="companyNTN" value="{{ $users->distributorCompany->companyNTN }}" required="">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="companyAddress" class="col-form-label col-md-2">Company Address</label>
                        <div class="col-md-10">
                           <input type="text" class="form-control" name="companyAddress" value="{{ $users->distributorCompany->companyAddress }}" required="">
                        </div>
                     </div>
                     <div class="form-group mb-0 row">
                        <div class="col-md-10">
                           <div class="input-group-append">
                              <button class="btn btn-primary" type="submit">Update</button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
   <!-- / Company Model -->
   @endif
   @endcan
   @can('Edit-Agreement-Detail')
   @if(isset($users->vendorDetail->decided_milkQuantity))				
   <!-- Deal Model-->
   <div id="dealModal" class="modal fade" role="dialog">
      <div class="modal-dialog" >
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
               <div class="table-responsive">
                  <form method="post"  action="{{ route('agreementUpdate.vendor' , $users->id) }}">
                     @csrf 
                     <div class="form-group row">
                        <label for="decided_milkQuantity" class="col-form-label col-md-2">Agreed Quantity</label>
                        <div class="col-md-10">
                           <input type="number" class="form-control" name="decided_milkQuantity" value="{{ $users->vendorDetail->decided_milkQuantity }}" required="">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="morning_decided_milkQuantity" class="col-form-label col-md-2">Morning Quantity</label>
                        <div class="col-md-10">
                           <input type="number" class="form-control" name="morning_decided_milkQuantity" value="{{ $users->vendorDetail->morning_decided_milkQuantity }}" required="">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="evening_decided_milkQuantity" class="col-form-label col-md-2">Evening Quantity</label>
                        <div class="col-md-10">
                           <input type="number" class="form-control" name="evening_decided_milkQuantity" value="{{ $users->vendorDetail->evening_decided_milkQuantity }}" required="">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="decided_rate" class="col-form-label col-md-2">Agreed Rate</label>
                        <div class="col-md-10">
                           <input type="number" class="form-control" name="decided_rate" value="{{ $users->vendorDetail->decided_rate }}" required="">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="morningTime" class="col-form-label col-md-2">Morning Time</label>
                        <div class="col-md-10">
                           <input type="time" class="form-control" name="morningTime" value="{{ $users->vendorDetail->morningTime }}" required="">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="eveningTime" class="col-form-label col-md-2">Evening Time</label>
                        <div class="col-md-10">
                           <input type="time" class="form-control" name="eveningTime" value="{{ $users->vendorDetail->eveningTime }}" required="">
                        </div>
                     </div>
                     <div class="form-group mb-0 row">
                        <div class="col-md-10">
                           <div class="input-group-append">
                              <button class="btn btn-primary" type="submit">Update</button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
   <!-- / Deal Model -->
   @endif
   @endcan
   @can('Edit-Bank-Detail')
   @if(isset($users->bankDetail->user_id))
   <!-- bank Model-->
   <div id="bankModal" class="modal fade" role="dialog">
      <div class="modal-dialog" >
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
               <div class="table-responsive">
                  <form method="post"  action="{{ route('detailsUpdate.bank' , $users->id) }}">
                     @csrf 
                     <div class="form-group row">
                        <label for="bank_name" class="col-form-label col-md-2">Owner</label>
                        <div class="col-md-10">
                           <input type="text" class="form-control" name="bank_name" value="{{ $users->bankDetail->bank_name }}" required="">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="branch_name" class="col-form-label col-md-2">Company Name</label>
                        <div class="col-md-10">
                           <input type="text" class="form-control" name="branch_name" value="{{ $users->bankDetail->branch_name }}" required="">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="branch_code" class="col-form-label col-md-2">Company Contact</label>
                        <div class="col-md-10">
                           <input type="text" class="form-control" name="branch_code" value="{{ $users->bankDetail->branch_code }}" required="">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="acc_no" class="col-form-label col-md-2">Company NTN</label>
                        <div class="col-md-10">
                           <input type="text" class="form-control" name="acc_no" value="{{ $users->bankDetail->acc_no }}" required="">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="acc_title" class="col-form-label col-md-2">Company Address</label>
                        <div class="col-md-10">
                           <input type="text" class="form-control" name="acc_title" value="{{ $users->bankDetail->acc_title }}" required="">
                        </div>
                     </div>
                     <div class="form-group mb-0 row">
                        <div class="col-md-10">
                           <div class="input-group-append">
                              <button class="btn btn-primary" type="submit">Update</button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
   <!-- / bankInfo Model -->
   @endif
   @endcan
   @can('Edit-Personal-Profile')
   <!-- password Change Model-->
   <div id="passwordChange" class="modal fade" role="dialog">
      <div class="modal-dialog" >
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
               <div class="table-responsive">
                  <form method="post" action="{{ route('update.personal.profile') }}" >
                     @csrf 
                     <!-- <input type="hidden" id="userId" class="form-control" name="userId" value="{{$users->id}}"> -->
                     <div class="form-group row">
                        <label for="oldPassword" class="col-form-label col-md-2">Old Password</label>
                        <div class="col-md-10">
                           <input type="password" class="form-control" name="oldPassword" required="" autocomplete="off">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="newPassword" class="col-form-label col-md-2">New Password</label>
                        <div class="col-md-10">
                           <input type="password" class="form-control" name="newPassword"  required="" autocomplete="off">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="oldPassword" class="col-form-label col-md-2">Repeat Password</label>
                        <div class="col-md-10">
                           <input type="password" class="form-control" name="confirmPassword"  required="" autocomplete="off">
                        </div>
                     </div>
                     <div class="form-group mb-0 row">
                        <div class="col-md-10">
                           <div class="input-group-append">
                              <button class="btn btn-primary" type="submit" >Update</button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
   <!-- / password Change Model -->
   @endcan
</div>
<script type="text/javascript">
   
 $(document).ready(function() {  
   initializeMap('ProfielMap','ProfileClearShapes','saveProfleMap','ProfileRestoreMap','addProfileMapData');
   $( "#ProfileRestoreMap" ).trigger( "click" );      
   });
</script>
@endsection

