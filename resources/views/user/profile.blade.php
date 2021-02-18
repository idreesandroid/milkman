@extends('layouts.master')
@section('content')
<!-- Page Header -->
<div class="crms-title row bg-white mb-4">
   <div class="col">
      <h3 class="page-title">
         <span class="page-title-icon bg-gradient-primary text-white mr-2">
         <i class="la la-table"></i>
         </span>
         @if($users->roles[0]->name == 'Distributor')
         <span>Distributor Profile</span>
         @elseif($users->roles[0]->name == 'Collector')
         <span>Collector Profile</span>
         @elseif($users->roles[0]->name == 'Vendor')
         <span>Vendor Profile</span>
         @else
         <span>System User Profile</span>
         @endif
      </h3>
   </div>
   <div class="col text-right">
      <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
         <li class="breadcrumb-item"><a href="/DashBoard">Dashboard</a></li>
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
<div class="row">  
   <div class="col-md-12">
      <div class="card">
         <div class="card-body">
            <!-- <h6 class="card-title">Bottom line justified</h6> -->
            <ul class="nav nav-tabs nav-tabs-bottom nav-justified" >
               <li class="nav-item">
                  <a class="nav-link active" href="#profile" data-toggle="tab">Profile</a>
               </li>
               @if($users->roles[0]->name == 'Distributor')
               <li class="nav-item">
                  <a class="nav-link" href="#orderHistory" data-toggle="tab">Order History</a>
               </li>
               @endif
               @if($users->roles[0]->name == 'Collector')
               <li class="nav-item">
                  <a class="nav-link" href="#taskHistory" data-toggle="tab">Task History</a>
               </li>
               @endif
               @if($users->roles[0]->name == 'Vendor')
               <li class="nav-item">
                  <a class="nav-link" href="#collectionHistory" data-toggle="tab">Collection History</a>
               </li>
               @endif
               @if($users->roles[0]->name != 'Collector')
               <li class="nav-item">
                  <a class="nav-link" href="#paymentHistory" data-toggle="tab">Payment History</a>
               </li>
               @endif
               @if($users->roles[0]->name == 'Collector')
               <li class="nav-item">
                  <a class="nav-link" href="#inventory" data-toggle="tab">Inventory</a>
               </li>
               @endif
            </ul>
            <div class="tab-content">
               <div class="tab-pane show active" id="profile">
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
                                       @if(isset($collectorAssets))
                                       @foreach($collectorAssets as $collectorAsset)
                                          @if(isset($collectorAsset->assetName))
                                          <li>
                                              <div class="title">{{$collectorAsset->assetName}}</div>
                                              <div class="text">{{$collectorAsset->assetCapacity}}</div>
                                          </li>
                                          @endif  
                                       @endforeach 
                                       @endif                 
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           
                           <div class="col-md-6 d-flex">
                              <div class="card profile-box flex-fill">
                                 <div class="card-body">
                                 @if(isset($users->userAcc->userAccount))
                                    <h3 class="card-title">Bank information</h3>
                                 @endif
                                   
                                 @if(isset($users->userAsset->assetName))
                                    <h3 class="card-title">Capabilities</h3>
                                 @endif

                                    <div class="pro-edit bankedit-box"><a data-target="#bankModal" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
                                    <ul class="personal-info">
                                    @if(isset($users->bankDetail->acc_title))
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
                                       @endif
                                       <li>
                                       @if(isset($users->userAcc->userAccount))
                                          <div class="title">User MilkMan Account.</div>                          
                                          <div class="text">{{$users->userAcc->userAccount}}</div>
                                          @endif
                                       </li>
                                       <li>
                                       @if(isset($users->userAcc->balance))
                                          <div class="title">User MilkMan Balance.</div>
                                          <div class="text">{{$users->userAcc->balance}}</div>
                                          @endif
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
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
               </div>
               @if($users->roles[0]->name == 'Distributor')
               <div class="tab-pane" id="orderHistory">
                  <div class="page-header pt-3 mb-0 ">
                     <div class="row">                                       
                        <div class="col text-left">
                           <ul class="pl-0 form-group" id="tab-button-group">
                              <li class="list-inline-item" >
                                 <span>From: </span>
                                 <input onchange="setFromDate()" type="date" id="fromDate" class="form-control" placeholder="From Date">
                              </li>
                              <li class="list-inline-item" >
                                 <span>To: </span>
                                 <input onchange="setToDate()" type="date" id="toDate" class="form-control" placeholder="From Date" >
                              </li>                              
                              <li class="list-inline-item" >
                                 <input onclick="searchDistributorOrderHistory()" class="btn btn-info form-control" type="submit" value="Search">
                              </li>
                              <li class="list-inline-item">
                                 <a onclick="return checkDatesSet();" class="btn btn-info form-control" href="{{route('exportinexcel.order')}}" id="ExportInExcel">Export In Excel</a>
                              </li>
                              <li class="list-inline-item">
                                 <button data-toggle="modal" data-target="#orderNow" class="btn btn-primary form-control">Order Now</button>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>         <!-- Content Starts -->
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card mb-0">
                           <div class="card-body">
                              <div class="table-responsive activity-tables">
                                 <table class="table table-striped table-nowrap custom-table mb-0 datatable" id="distributeOrderHistory">
                                    <thead>
                                       <tr>
                                          <th>Order Date</th>
                                          <th>Total Price</th>
                                          <th>Sold By</th>
                                          <th>Delivery Date</th>             
                                          <th>Order Status</th>
                                       </tr>
                                    </thead>
                                    <tbody id="orderHistorySearchData">
                                       @if(isset($orderHistory))
                                          @foreach($orderHistory as $item)
                                          <tr> 
                                             <td>{{ timeFormat($item->created_at)['date'] }} {{strtoupper(timeFormat($item->created_at)['time']) }}<input type="hidden" id="buyerID" value="{{$item->buyer_id}}"></td>
                                             <td>{{$item->total_amount}}</td>
                                             <td>{{$item->name}}</td>
                                             <td>{{ timeFormat($item->delivery_due_date)['date'] }}</td>
                                             <td>{{$item->flag}}</td>
                                          </tr>
                                          @endforeach
                                       @endif
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>                                 <!-- /Content End -->
               </div>
               @endif
               @if($users->roles[0]->name == 'Collector')
               <div class="tab-pane" id="taskHistory">
                  <div class="page-header pt-3 mb-0 ">
                     <div class="row">                                       
                        <div class="col text-left">
                           <ul class="pl-0 form-group" id="tab-button-group">
                              <li class="list-inline-item" >
                                 <span>From: </span>
                                 <input onchange="setCollectorTaskFromDate()" type="date" id="fromAssignTaskDate" class="form-control" placeholder="From Date">
                              </li>
                              <li class="list-inline-item" >
                                 <span>To: </span>
                                 <input onchange="setCollectorTaskToDate()" type="date" id="toAssignTaskDate" class="form-control" placeholder="From Date" >
                              </li>                              
                              <li class="list-inline-item" >
                                 <input onclick="searchCollectorTaskHistory()" class="btn btn-info form-control" type="submit" value="Search">
                              </li>                             
                              <li class="list-inline-item" >
                                 <a onclick="return checkCollectorTaskDatesSet();" class="btn btn-info form-control" href="{{route('exportinexcel.task')}}" id="CollectorTaskExportInExcel">Export In Excel</a>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div> 
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card mb-0">
                           <div class="card-body">
                              <div class="table-responsive activity-tables">
                                 <table class="table table-striped table-nowrap custom-table mb-0 datatable" id="collectorTaskHistory">
                                    <thead>
                                       <tr>
                                          <th>Assign At</th>
                                          <th>Collectoin Area</th>
                                          <th>Morning/Evening Shift</th>
                                          <th>Assign From</th>
                                          <th>Assign To</th>             
                                          <th>Status</th>                       
                                       </tr>
                                    </thead>
                                    <tbody id="CollectorAssignTask">
                                       @if(isset($TaskArea))
                                          @foreach($TaskArea as $task)
                                          <tr>
                                             <td>                                                
                                                {{ timeFormat($task->created_at)['date'] }} {{timeFormat($task->created_at)['time'] }}
                                                <input type="hidden" id="collectorID" value="{{$task->collector_id}}"></td>
                                             <td>{{$task->title}}</td>
                                             <td>{{$task->shift}}</td>
                                             <td>{{$task->assignFrom}}</td>
                                             <td>{{$task->assignTill}}</td>
                                             <td>{{$task->taskAreaStatus}}</td>
                                          </tr>
                                          @endforeach
                                       @endif
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div> 
               </div>
               @endif
               @if($users->roles[0]->name == 'Vendor')
               <div class="tab-pane" id="collectionHistory">
                  <div class="page-header pt-3 mb-0 ">
                     <div class="row">                                       
                        <div class="col text-left">
                           <ul class="pl-0 form-group" id="tab-button-group">
                              <li class="list-inline-item" >
                                 <span>From: </span>
                                 <input onchange="setVendorCollectionFromDate()" type="date" id="fromVendorCollectionDate" class="form-control" placeholder="From Date">
                              </li>
                              <li class="list-inline-item" >
                                 <span>To: </span>
                                 <input onchange="setVendorCollectionToDate()" type="date" id="toVendorCollectionDate" class="form-control" placeholder="From Date" >
                              </li>                              
                              <li class="list-inline-item" >
                                 <input onclick="searchVendorCollectionHistory()" class="btn btn-info form-control" type="submit" value="Search">
                              </li>                              
                              <li class="list-inline-item" >
                                 <a onclick="return checkVendorCollectionDatesSet();" id="vendorCollectionExportInExcel" class="btn btn-info form-control" href="/downloadvendorcollection">Export In Excel</a>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card mb-0">
                           <div class="card-body">
                              <div class="table-responsive activity-tables">
                                 <table class="table table-striped table-nowrap custom-table mb-0 datatable" id="VendorCollectionHistory">
                                    <thead>
                                       <tr>
                                          <th>Date</th>
                                          <th>Amount</th>
                                          <th>Shift</th>
                                          <th>Fat</th>
                                          <th>Lactose</th>
                                          <th>Ash</th>
                                          <th>Assign To</th>               
                                          <th>Status</th>               
                                       </tr>
                                    </thead>
                                    <tbody id="VendorCollection">
                                       @if(isset($milkCollection))
                                          @foreach($milkCollection as $collection)
                                             <tr>
                                                <td>{{$collection->updated_at}}<input type="hidden" id="vendorID" value="{{$collection->vendor_id}}"></td>
                                                <td><?php echo (isset($collection->milkCollected)) ? $collection->milkCollected.' ltr' : ''; ?></td>
                                                <td>{{$collection->taskShift}}</td>
                                                <td>{{$collection->fat}}</td>
                                                <td>{{$collection->Lactose}}</td>
                                                <td>{{$collection->Ash}}</td>
                                                <td>{{$collection->name}}</td>
                                                <td>{{$collection->status}}</td>
                                             </tr>
                                          @endforeach
                                       @endif                                       
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div> 
               </div>
               @endif
               <div class="tab-pane" id="paymentHistory">
                  <div class="page-header pt-3 mb-0 ">
                     <div class="row">                                       
                        <div class="col text-left">
                           <ul class="pl-0 form-group" id="tab-button-group">
                              <li class="list-inline-item" >
                                 <span>From: </span>
                                 <input onchange="setPaymentFromDate()" type="date" id="fromPaymentDate" class="form-control" placeholder="From Date">
                              </li>
                              <li class="list-inline-item" >
                                 <span>To: </span>
                                 <input onchange="setPaymentToDate()" type="date" id="toPaymentDate" class="form-control" placeholder="From Date" >
                              </li>
                              <li class="list-inline-item" >
                                 <input onclick="searchDistributorPaymentHistory()" class="btn btn-info form-control" type="submit" value="Search">
                              </li>                              
                              <li class="list-inline-item" >
                                 <a onclick="return checkPaymentDatesSet();" class="btn btn-info form-control" id="paymentExportInExcel" href="/downloadpayment">Export In Excel</a>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card mb-0">
                           <div class="card-body">
                              <div class="table-responsive activity-tables">
                                 <table class="table table-striped table-nowrap custom-table mb-0 datatable" id="userPaymentHistory">
                                    <thead>
                                       <tr>
                                          <th>Payment Method</th>
                                          <th>Transection ID</th>
                                          <th>Deposit Time</th>
                                          <th>Amount Paid</th>             
                                          <th>Varified By</th>             
                                          <th>Status</th>                                          
                                       </tr>
                                    </thead>
                                    <tbody id="paymentHistorySearchData">
                                       @if(isset($UserTransaction))
                                          @foreach($UserTransaction as $item)
                                          <tr> 
                                             <td>{{$item->paymentMethod}}<input type="hidden" id="userID" value="{{$item->user_id}}"></td>
                                             <td>{{$item->transactionId}}</td>
                                             <td>{{ timeFormat($item->timeOfDeposit)['date'] }} {{timeFormat($item->timeOfDeposit)['time'] }}</td>
                                             <td>{{$item->amountPaid}}</td>
                                             <td>{{ucfirst($item->name)}}</td>
                                             <td>{{ucfirst($item->status)}}</td>
                                          </tr>
                                          @endforeach
                                       @endif 
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div> 
               </div>
               @if($users->roles[0]->name == 'Collector')              
               <div class="tab-pane" id="inventory">
                  <div class="page-header pt-3 mb-0 ">
                     <div class="row">                                       
                        <div class="col text-left">
                           <ul class="pl-0 form-group" id="tab-button-group">
                              <li class="list-inline-item" >
                                 <span>From: </span>
                                 <input onchange="setCollectorInventoryFromDate()" onchange="" type="date" id="fromInventoryAssignDate" class="form-control" placeholder="From Date">
                              </li>
                              <li class="list-inline-item" >
                                 <span>To: </span>
                                 <input onchange="setCollectorInventoryToDate()" type="date" id="toInventoryAssignDate" class="form-control" placeholder="From Date" >
                              </li>
                              <li class="list-inline-item" >
                                 <input onclick="searchCollectorInventoryAssignHistory()" class="btn btn-info form-control" type="submit" value="Search">
                              </li>                             
                              <li class="list-inline-item" >
                                 <a onclick="return checkCollectorInventoryDatesSet();" id="collectorInventoryExportInExcel" class="btn btn-info form-control" href="/downloadcollectorinventory">Export In Excel</a>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="card mb-0">
                           <div class="card-body">
                              <div class="table-responsive activity-tables">
                                 <table class="table table-striped table-nowrap custom-table mb-0 datatable" id="CollectorInventoryHistory">
                                    <thead>
                                       <tr>
                                          <th>Assign At</th>             
                                          <th>Asset Name</th>             
                                          <th>Asset Type</th>
                                          <th>Capicity</th>
                                          <th>Asset Code</th>                        
                                       </tr>
                                    </thead>
                                    <tbody id="CollectorInventoryAssign">
                                       @if(isset($assets))
                                          @foreach($assets as $asset)
                                             <tr>                                                
                                                <td>                                                   
                                                   {{ timeFormat($asset->updated_at)['date'] }} {{timeFormat($asset->updated_at)['time'] }}
                                                   <input type="hidden" id="collectorID" value="{{$asset->user_id}}"></td>
                                                <td>{{$asset->assetName}}</td>
                                                <td>{{$asset->typeName}}</td>
                                                <td>{{$asset->assetCapacity}}</td>
                                                <td>{{$asset->assetCode}}</td>
                                             </tr>
                                          @endforeach
                                       @endif
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div> 
               </div>
               @endif
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Page Wrapper -->
<div class="page-header pt-3 mb-0"> 
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
   <div class="modal right fade" id="orderDetail" tabindex="-1" role="dialog" aria-modal="true">
      <div class="modal-dialog" role="document">
         <button type="button" class="close md-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close xs-close" data-dismiss="modal">×</button>
               <div class="row w-100">
                  <div class="col-md-7 account d-flex">
                     <div class="company_img">
                        <img src="{{url('UserProfile/collector.jpg')}}" alt="User" id="collectorImage" class="user-image img-fluid"/>
                     </div>
                     <div>
                        <p class="mb-0">Collector Name</p>
                        <span class="modal-title" id="collectionName">Idrees</span>
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
                           <td>Product Name</td>
                           <td>Amount</td>
                           <td>Price</td>
                           <td>Sub Total</td>
                        </tr>
                        <tr>
                           <td>Milk</td>
                           <td>5</td>
                           <td>50</td>
                           <td>250</td>              
                        </tr>                        
                        <tr >
                           <td></td>
                           <td></td>
                           <td style="text-align: right;">Total Amount:</td>
                           <td>250</td>                           
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <!-- modal-content -->
      </div>
      <!-- modal-dialog -->
   </div>  
</div>
<?php
if($users->roles[0]->name == 'Vendor'){
   $latitude = $users->vendorDetail->latitude;
   $longitude = $users->vendorDetail->longitude;
}else if($users->roles[0]->name == 'Distributor'){
   $string = $users->distributorCompany->alotedArea;

   if(strripos($string, '{"type":"MARKER","id":null,"geometry":[')){

      $newstr = explode('{"type":"MARKER","id":null,"geometry":[', $string );

      $lat = explode(']}',$newstr[1]);

      $location = explode(',', $lat[0]);
          
      $latitude = $location[0];
      $longitude = $location[1];

   }else{

      $newstr = explode('[{"type":"POLYGON","id":null,"geometry":[[[', $string );

      $lat = explode('],[',$newstr[1]);

      $location = explode(',', $lat[0]);

      $latitude = $location[0];
      
      $longitude = $location[1];
   }
}else{
   $latitude = '';
   $longitude = '';
}
?>
@if($users->roles[0]->name == 'Distributor')
<!--Collector Assiging-->
<div class="modal right fade" id="orderNow" role="dialog" aria-modal="true">
   <div class="modal-dialog" role="document">
      <button type="button" class="close md-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title text-center">Select Products</h4>
            <button type="button" class="close xs-close" data-dismiss="modal">×</button>
         </div>
         <div class="modal-body">
         <div class="row">
                  <div class="col-md-12">
                     <div class="card mb-0">
                        <div class="card-body">
                           <div class="table-responsive">
                              <table class="table table-striped table-nowrap custom-table mb-0 datatable">
                                 <thead>
                                    <tr>                                  
                                       <th></th>
                                       <th class="text-center">Product Name</th>                                      
                                       <th class="text-center">Unit</th>
                                       <th class="text-center">Quentity/Carton</th>
                                       <th class="text-center">Unit Price</th>
                                       <th class="text-center">Unit Quentity</th>
                                       <th class="text-center">Sub Total</th>
                                       <th class="text-center">Actions</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($products as $product)
                                    <tr class="product_row">
                                       <td class="checkBox">
                                          <label class="container-checkbox">
                                             <input type="checkbox" name="selectedProduct" id="product_{{$product->id}}" value="{{$product->id}}">
                                             <input type="hidden" class="productid" value="{{$product->id}}">
                                             <span class="checkmark"></span>
                                          </label>
                                       </td>
                                       <td class="text-center">{{$product->product_name}}</td>                                       
                                       <td class="text-center">{{$product->product_size}} {{$product->unit}}</td>
                                       <td class="text-center">{{$product->ctn_value}}</td>
                                       <td class="text-center unitprice" id="unitPrice<?php echo $product->id; ?>">{{$product->product_price}}</td>
                                       <td class="text-center">
                                          <input type="submit" value="+" onclick="quentityIncrement(<?php echo $product->id; ?>)">
                                          <input class="productquentity" onchange="quentityUpdate(<?php echo $product->id; ?>)" id="productQuentity{{$product->id}}" onkeypress="return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)))" style="width: 40px">
                                          <input type="submit" value="-" onclick="quentityDecrement(<?php echo $product->id; ?>)">
                                       </td>
                                       <td class="text-center sum_item" id="subTotal{{$product->id}}">00</td>
                                       <td class="text-center">
                                          <a href="" onclick="productDetail(<?php echo $product->id; ?>)" class="btn btn-outline-success">Detail</a>
                                       </td>
                                    </tr>
                                    @endforeach                           
                                 </tbody>
                                 <tfoot>
                                    <tr>
                                       <td><input type="hidden" value="{{$users->id}}" id="distributorID"></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td></td>
                                       <td class="text-right">Total:</td>
                                       <td class="text-center" id="totalPrice">00.00</td>
                                       <td><a onclick="placeOrder()" class="btn btn-outline-info" href="#">Place Order</a></td>
                                    </tr>
                                 </tfoot>
                              </table>
                           </div>
                        </div>
                     </div>      
                  </div>
               </div>
         </div>
      </div>
      <!-- modal-content -->
   </div>
   <!-- modal-dialog -->
</div>
@endif
<input type="hidden" value="<?php echo $latitude; ?>" id="latitude">
<input type="hidden" value="<?php echo $longitude; ?>" id="longitude">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {  
$("#distributeOrderHistory").DataTable();
$("#CollectorInventoryHistory").DataTable();
$("#userPaymentHistory").DataTable();
$("#VendorCollectionHistory").DataTable();
$("#collectorTaskHistory").DataTable();
var latitude = $("#latitude").val();
var longitude = $("#longitude").val();
initializeMap('ProfielMap','ProfileClearShapes','saveProfleMap','ProfileRestoreMap','addProfileMapData','',latitude,longitude);
   $( "#ProfileRestoreMap" ).trigger( "click" );      
});

function placeOrder(){
   var orderDetail = [];
   var haveQuentity = [];
   $(".product_row").each(function(){
      var items = [];
      var productid = $(this).find('.productid').val();
      items.push(productid);
      var unitprice = $(this).find('.unitprice').text();
      items.push(unitprice);
      var productquentity = $(this).find('.productquentity').val();
      items.push(productquentity);
      if(productquentity == 0){
         haveQuentity.push('product not selected');
      }
      var sum_item = $(this).find('.sum_item').text();
      items.push(sum_item);
      orderDetail.push(items);
   });

   if(haveQuentity.length == orderDetail.length){
      $("#orderNow").modal('hide');
      swal.fire("Error Ordering!", "Please select any product to process", "error").then((result) => {
         if(result.isConfirmed) {
            location.reload(true);
         }
      });
      return false;
   }   
   var totalPrice = $("#totalPrice").text();
   var distributorID = $("#distributorID").val();
   $.ajax({
        url: "{{ route('placeorder') }}",
        type: "POST",
        data: {
            'orderDetail': orderDetail,
            'distributorID' : distributorID,
            'totalPrice' : totalPrice,
            '_token' : "{{ csrf_token() }}"
        },
        success: function (response, status) {
            $('#orderNow').modal('hide');
            if(response){
               swal.fire("Done!", "Order Placed Succesfully!", "success").then((result) => {
                  if(result.isConfirmed) {
                     location.reload(true);
                  }
               });
            }else{
               $('#orderNow').modal('hide');
               swal.fire("Error Order Placeing!", "Your order fails", "error").then((result) => {
                  if(result.isConfirmed) {
                     location.reload(true);
                  }
               });
            }
        },
        error: function () {
            $('#orderNow').modal('hide');
            swal.fire("Error Order Placeing!", "Please try again", "error").then((result) => {
               if(result.isConfirmed) {
                  location.reload(true);
               }
            });
        }
   }); 
}

function quentityIncrement(productID){
   var productQuentity = $("#productQuentity"+productID).val();
   if(!productQuentity.length){
      productQuentity = 0;
   }
   $("#productQuentity"+productID).val(parseInt(productQuentity)+1);
   var unitPrice = $("#unitPrice"+productID).text();
   var currentQuentity = $("#productQuentity"+productID).val();
   $("#subTotal"+productID).text((parseInt(currentQuentity) * parseFloat(unitPrice)).toFixed(2));

   var sum = 0;
   $('.sum_item').each(function(){
      var item_val = parseFloat($(this).text());
      if(isNaN(item_val)){
        item_val = 0;
      }
      sum += item_val;
   });
   $('#totalPrice').text(sum.toFixed(2));
}

function quentityDecrement(productID){
   var productQuentity = $("#productQuentity"+productID).val();
   if(!productQuentity.length || productQuentity <= 0){
      productQuentity = 1;
   }
   $("#productQuentity"+productID).val(parseInt(productQuentity)-1);
   var unitPrice = $("#unitPrice"+productID).text();
   var currentQuentity = $("#productQuentity"+productID).val();
   $("#subTotal"+productID).text((parseInt(currentQuentity) * parseFloat(unitPrice)).toFixed(2));  

   var sum = 0;
   $('.sum_item').each(function(){
      var item_val = parseFloat($(this).text());
      if(isNaN(item_val)){
        item_val = 0;
      }
      sum += item_val;
   });
   $('#totalPrice').text(sum.toFixed(2));
}

function quentityUpdate(productID){
   var unitPrice = $("#unitPrice"+productID).text();
   var currentQuentity = $("#productQuentity"+productID).val();
   $("#subTotal"+productID).text((parseInt(currentQuentity) * parseFloat(unitPrice)).toFixed(2));
      var sum = 0;
      $('.sum_item').each(function(){
      var item_val = parseFloat($(this).text());
      if(isNaN(item_val)){
        item_val = 0;
      }
      sum += item_val;
   });
   $('#totalPrice').text(sum.toFixed(2));
}

function checkCollectorInventoryDatesSet(){
   var fromDate = $("#fromInventoryAssignDate").val();
   var toDate = $("#toInventoryAssignDate").val();
   if(!fromDate.length || !toDate.length)
   {
      alert('Please select From and To Date');
      return false;
   }
}

function setCollectorInventoryFromDate(){
   var fromDate = $("#fromInventoryAssignDate").val();
   var toDate = $("#toInventoryAssignDate").val();
   var collectorID = $("#collectorID").val();
   if(!fromDate.length)
   {
      var d = new Date();
      var old_day = d.getDate();
      var old_month = d.getMonth();
      var old_year = d.getFullYear()-1;
      fromDate = old_year + "-" + old_month + "-" + old_day;     
   }
   if(!toDate.length)
   {
      var d = new Date();
      var curr_day = d.getDate();
      var curr_month = d.getMonth() + 1;
      var curr_year = d.getFullYear();
      toDate = curr_year + "-" + curr_month + "-" + curr_day;
   }
   var href = '/downloadcollectorinventory?fromDate='+fromDate+'&toDate='+toDate+'&collectorID='+collectorID;
   $("#collectorInventoryExportInExcel").attr("href",href);
}


function setCollectorInventoryToDate(){
   var fromDate = $("#fromInventoryAssignDate").val();
   var toDate = $("#toInventoryAssignDate").val();
   var collectorID = $("#collectorID").val();
   if(!fromDate.length)
   {
      var d = new Date();
      var old_day = d.getDate();
      var old_month = d.getMonth();
      var old_year = d.getFullYear()-1;
      fromDate = old_year + "-" + old_month + "-" + old_day;      
   }
   if(!toDate.length)
   {
      var d = new Date();
      var curr_day = d.getDate();
      var curr_month = d.getMonth() + 1;
      var curr_year = d.getFullYear();
      toDate = curr_year + "-" + curr_month + "-" + curr_day;
   }
   var href = '/downloadcollectorinventory?fromDate='+fromDate+'&toDate='+toDate+'&collectorID='+collectorID;
   $("#collectorInventoryExportInExcel").attr("href",href);
}

function checkVendorCollectionDatesSet(){
   var fromDate = $("#fromVendorCollectionDate").val();
   var toDate = $("#toVendorCollectionDate").val();
   if(!fromDate.length || !toDate.length)
   {
      alert('Please select From and To Date');
      return false;
   }
}

function setVendorCollectionFromDate(){
   var fromDate = $("#fromVendorCollectionDate").val();
   var toDate = $("#toVendorCollectionDate").val();
   var vendorID = $("#vendorID").val();
   if(!fromDate.length)
   {
      var d = new Date();
      var old_day = d.getDate();
      var old_month = d.getMonth();
      var old_year = d.getFullYear()-1;
      fromDate = old_year + "-" + old_month + "-" + old_day;     
   }
   if(!toDate.length)
   {
      var d = new Date();
      var curr_day = d.getDate();
      var curr_month = d.getMonth() + 1;
      var curr_year = d.getFullYear();
      toDate = curr_year + "-" + curr_month + "-" + curr_day;
   }
   var href = '/downloadvendorcollection?fromDate='+fromDate+'&toDate='+toDate+'&vendorID='+vendorID;
   $("#vendorCollectionExportInExcel").attr("href",href);
}


function setVendorCollectionToDate(){
   var fromDate = $("#fromVendorCollectionDate").val();
   var toDate = $("#toVendorCollectionDate").val();
   var vendorID = $("#vendorID").val();
   if(!fromDate.length)
   {
      var d = new Date();
      var old_day = d.getDate();
      var old_month = d.getMonth();
      var old_year = d.getFullYear()-1;
      fromDate = old_year + "-" + old_month + "-" + old_day;      
   }
   if(!toDate.length)
   {
      var d = new Date();
      var curr_day = d.getDate();
      var curr_month = d.getMonth() + 1;
      var curr_year = d.getFullYear();
      toDate = curr_year + "-" + curr_month + "-" + curr_day;
   }
   var href = '/downloadvendorcollection?fromDate='+fromDate+'&toDate='+toDate+'&vendorID='+vendorID;
   $("#vendorCollectionExportInExcel").attr("href",href);
}

function checkPaymentDatesSet(){
   var fromDate = $("#fromPaymentDate").val();
   var toDate = $("#toPaymentDate").val();
   if(!fromDate.length || !toDate.length)
   {
      alert('Please select From and To Date');
      return false;
   }
}

function setPaymentFromDate(){
   var fromDate = $("#fromPaymentDate").val();
   var toDate = $("#toPaymentDate").val();
   var userID = $("#userID").val();
   if(!fromDate.length)
   {
      var d = new Date();
      var old_day = d.getDate();
      var old_month = d.getMonth();
      var old_year = d.getFullYear()-1;
      fromDate = old_year + "-" + old_month + "-" + old_day;     
   }
   if(!toDate.length)
   {
      var d = new Date();
      var curr_day = d.getDate();
      var curr_month = d.getMonth() + 1;
      var curr_year = d.getFullYear();
      toDate = curr_year + "-" + curr_month + "-" + curr_day;
   }
   var href = '/downloadpayment?fromDate='+fromDate+'&toDate='+toDate+'&userID='+userID;
   $("#paymentExportInExcel").attr("href",href);
}


function setPaymentToDate(){
   var fromDate = $("#fromPaymentDate").val();
   var toDate = $("#toPaymentDate").val();
   var userID = $("#userID").val();
   if(!fromDate.length)
   {
      var d = new Date();
      var old_day = d.getDate();
      var old_month = d.getMonth();
      var old_year = d.getFullYear()-1;
      fromDate = old_year + "-" + old_month + "-" + old_day;      
   }
   if(!toDate.length)
   {
      var d = new Date();
      var curr_day = d.getDate();
      var curr_month = d.getMonth() + 1;
      var curr_year = d.getFullYear();
      toDate = curr_year + "-" + curr_month + "-" + curr_day;
   }
   var href = '/downloadpayment?fromDate='+fromDate+'&toDate='+toDate+'&userID='+userID;
   $("#paymentExportInExcel").attr("href",href);
}


function checkCollectorTaskDatesSet(){
   var fromDate = $("#fromAssignTaskDate").val();
   var toDate = $("#toAssignTaskDate").val();  
   if(!fromDate.length || !toDate.length)
   {
      alert('Please select From and To Date');
      return false;
   }
}

function setCollectorTaskFromDate(){
   var fromDate = $("#fromAssignTaskDate").val();
   var toDate = $("#toAssignTaskDate").val();
   var collectorID = $("#collectorID").val();
   if(!fromDate.length)
   {
      var d = new Date();
      var old_day = d.getDate();
      var old_month = d.getMonth();
      var old_year = d.getFullYear()-1;
      fromDate = old_year + "-" + old_month + "-" + old_day;     
   }
   if(!toDate.length)
   {
      var d = new Date();
      var curr_day = d.getDate();
      var curr_month = d.getMonth() + 1;
      var curr_year = d.getFullYear();
      toDate = curr_year + "-" + curr_month + "-" + curr_day;
   }
   var href = '/downloadtask?fromDate='+fromDate+'&toDate='+toDate+'&collectorID='+collectorID;
   $("#CollectorTaskExportInExcel").attr("href",href);
}


function setCollectorTaskToDate(){
   var fromDate = $("#fromAssignTaskDate").val();
   var toDate = $("#toAssignTaskDate").val();
   var collectorID = $("#collectorID").val();
   if(!fromDate.length)
   {
      var d = new Date();
      var old_day = d.getDate();
      var old_month = d.getMonth();
      var old_year = d.getFullYear()-1;
      fromDate = old_year + "-" + old_month + "-" + old_day;      
   }
   if(!toDate.length)
   {
      var d = new Date();
      var curr_day = d.getDate();
      var curr_month = d.getMonth() + 1;
      var curr_year = d.getFullYear();
      toDate = curr_year + "-" + curr_month + "-" + curr_day;
   }
   var href = '/downloadtask?fromDate='+fromDate+'&toDate='+toDate+'&collectorID='+collectorID;
   $("#CollectorTaskExportInExcel").attr("href",href);
}

function checkDatesSet(){
   var fromDate = $("#fromDate").val();
   var toDate = $("#toDate").val();   
   if(!fromDate.length || !toDate.length)
   {
      alert('Please select From and To Date');
      return false;
   }
}

function setFromDate(){
   var fromDate = $("#fromDate").val();
   var toDate = $("#toDate").val();
   var buyerID = $("#buyerID").val();
   if(!fromDate.length)
   {
      var d = new Date();
      var old_day = d.getDate();
      var old_month = d.getMonth();
      var old_year = d.getFullYear()-1;
      fromDate = old_year + "-" + old_month + "-" + old_day;     
   }
   if(!toDate.length)
   {
      var d = new Date();
      var curr_day = d.getDate();
      var curr_month = d.getMonth() + 1;
      var curr_year = d.getFullYear();
      toDate = curr_year + "-" + curr_month + "-" + curr_day;
   }
   var href = '/download?fromDate='+fromDate+'&toDate='+toDate+'&buyerID='+buyerID;
   $("#ExportInExcel").attr("href",href);
}


function setToDate(){
   var fromDate = $("#fromDate").val();
   var toDate = $("#toDate").val();
   var buyerID = $("#buyerID").val();
   if(!fromDate.length)
   {
      var d = new Date();
      var old_day = d.getDate();
      var old_month = d.getMonth();
      var old_year = d.getFullYear()-1;
      fromDate = old_year + "-" + old_month + "-" + old_day;      
   }
   if(!toDate.length)
   {
      var d = new Date();
      var curr_day = d.getDate();
      var curr_month = d.getMonth() + 1;
      var curr_year = d.getFullYear();
      toDate = curr_year + "-" + curr_month + "-" + curr_day;
   }
   var href = '/download?fromDate='+fromDate+'&toDate='+toDate+'&buyerID='+buyerID;
   $("#ExportInExcel").attr("href",href);
}



function searchCollectorInventoryAssignHistory(){
   var fromDate = $("#fromInventoryAssignDate").val();
   var toDate = $("#toInventoryAssignDate").val();
   var collectorID = $("#collectorID").val();

   if(!fromDate.length){
      $("#fromInventoryAssignDate").focus();
      alert('Please insert the from Date');            
      return false;
   }

   if(!toDate.length){
      $("#toInventoryAssignDate").focus();
      alert('Please insert the to Date');            
      return false;
   } 

   jQuery.ajax({
        url: "{{route('search.searchCollectorInventoryAssign')}}",
        type: "POST",
        data: {
            fromDate: fromDate,
            toDate: toDate,
            collectorID: collectorID,
            '_token' : "{{ csrf_token() }}"
        },
        success: function (response, status) {        
         $("#CollectorInventoryAssign").text('');
           var items = '';
           $.each( response, function( key, val ) {
             items += '<tr>';
             items+= '<td>'+getDateFromJsonString(val.updated_at).replace(/,/g,"") +'</td>';
             items+= '<td>'+val.assetName+'</td>';
             items+= '<td>'+val.typeName+'</td>';
             items+= '<td>'+val.assetCapacity+'</td>';
             items+= '<td>'+val.assetCode+'</td>';
             items+='<tr>';
           });
           $("#CollectorInventoryAssign").append(items);
        },
        error: function () {
         swal.fire("Error Searching!", "Please try again", "error").then((result) => {
            if(result.isConfirmed) {
               location.reload(true);
            }
         });
        
      }
   });
}




function searchCollectorTaskHistory(){
   var fromDate = $("#fromAssignTaskDate").val();
   var toDate = $("#toAssignTaskDate").val();
   var collectorID = $("#collectorID").val();

   if(!fromDate.length){
      $("#fromAssignTaskDate").focus();
      alert('Please insert the from Date');            
      return false;
   }

   if(!toDate.length){
      $("#toAssignTaskDate").focus();
      alert('Please insert the to Date');            
      return false;
   } 

   jQuery.ajax({
        url: "{{route('search.searchCollectorTask')}}",
        type: "POST",
        data: {
            fromDate : fromDate,
            toDate : toDate,
            collectorID : collectorID,
            '_token' : "{{ csrf_token() }}"
        },
        success: function (response, status) {        
         $("#CollectorAssignTask").text('');
           var items = '';
           $.each( response, function( key, val ) {
             items += '<tr>';
             items+= '<td>'+getDateFromJsonString(val.created_at).replace(/,/g,"") +'</td>';
             items+= '<td>'+val.title+'</td>';
             items+= '<td>'+val.shift+'</td>';
             items+= '<td>'+val.assignFrom+'</td>';
             items+= '<td>'+val.assignTill+'</td>';
             items+= '<td>'+val.taskAreaStatus+'</td>';
             items+='<tr>';
           });
           $("#CollectorAssignTask").append(items);
        },
        error: function () {
         swal.fire("Error Searching!", "Please try again", "error").then((result) => {
            if(result.isConfirmed) {
               location.reload(true);
            }
         });
        
      }
   });
}



function searchVendorCollectionHistory(){
   var fromDate = $("#fromVendorCollectionDate").val();
   var toDate = $("#toVendorCollectionDate").val();
   var vendorID = $("#vendorID").val();

   if(!fromDate.length){
      $("#fromVendorCollectionDate").focus();
      alert('Please insert the from Date');            
      return false;
   }

   if(!toDate.length){
      $("#toVendorCollectionDate").focus();
      alert('Please insert the to Date');            
      return false;
   } 

   jQuery.ajax({
        url: "{{route('search.searchVendorCollection')}}",
        type: "POST",
        data: {
            fromDate: fromDate,
            toDate: toDate,
            vendorID: vendorID,
            '_token' : "{{ csrf_token() }}"
        },
        success: function (response, status) {        
         $("#VendorCollection").text('');
           var items = '';
           $.each( response, function( key, val ) {
             items += '<tr>';
             items+= '<td>'+getDateFromJsonString(val.updated_at).replace(/,/g,"") +'</td>';
             items+= '<td>'+val.milkCollected+'</td>';
             items+= '<td>'+val.taskShift+'</td>';
             items+= '<td>'+val.fat+'</td>';
             items+= '<td>'+val.Lactose+'</td>';
             items+= '<td>'+val.Ash+'</td>';
             items+= '<td>'+val.collectorName+'</td>';
             items+= '<td>'+val.status+'</td>';
             items+='<tr>';
           });
           $("#VendorCollection").append(items);
        },
        error: function () {
         swal.fire("Error Searching!", "Please try again", "error").then((result) => {
            if(result.isConfirmed) {
               location.reload(true);
            }
         });
        
      }
   });
}

function searchDistributorPaymentHistory(){
   var fromDate = $("#fromPaymentDate").val();
   var toDate = $("#toPaymentDate").val();
   var userID = $("#userID").val();

   if(!fromDate.length){
      $("#fromPaymentDate").focus();
      alert('Please insert the from Date');            
      return false;
   }

   if(!toDate.length){
      $("#toPaymentDate").focus();
      alert('Please insert the to Date');            
      return false;
   } 

   jQuery.ajax({
        url: "{{route('search.payment')}}",
        type: "POST",
        data: {
            fromDate: fromDate,
            toDate: toDate,
            userID: userID,
            '_token' : "{{ csrf_token() }}"
        },
        success: function (response, status) {
        
         $("#paymentHistorySearchData").text('');
           var items = '';
           $.each( response, function( key, val ) {
             items += '<tr>';
             items+= '<td>'+val.paymentMethod+'</td>';
             items+= '<td>'+val.transactionId+'</td>';
             items+= '<td>'+ getDateFromJsonString(val.timeOfDeposit).replace(/,/g,"") + '</td>';
             items+= '<td>'+val.amountPaid+'</td>';
             items+= '<td>'+val.name+'</td>';
             items+= '<td>'+val.status+'</td>';
             items+='<tr>';
           });
           $("#paymentHistorySearchData").append(items);
        },
        error: function () {
         swal.fire("Error Searching!", "Please try again", "error").then((result) => {
            if(result.isConfirmed) {
               location.reload(true);
            }
         });
        
      }
   });
}


function searchDistributorOrderHistory(){

   var fromDate = $("#fromDate").val();
   var toDate = $("#toDate").val();
   var buyerID = $("#buyerID").val();

   if(!fromDate.length){
      $("#fromDate").focus();
      alert('Please insert the from Date');            
      return false;
   }

   if(!toDate.length){
      $("#toDate").focus();
      alert('Please insert the to Date');            
      return false;
   } 

   jQuery.ajax({
        url: "{{route('search.order')}}",
        type: "POST",
        data: {
            fromDate: fromDate,
            toDate: toDate,
            buyerID: buyerID,
            '_token' : "{{ csrf_token() }}"
        },
        success: function (response, status) {

         $("#orderHistorySearchData").text('');
           var items = '';
           $.each( response, function( key, val ) {
             items += '<tr>';
             items+= '<td>'+ getDateFromJsonString(val.created_at).replace(/,/g,"") + '</td>';
             items+= '<td>'+val.total_amount+'</td>';
             items+= '<td>'+val.saler+'</td>';
             items+= '<td>'+ val.delivery_due_date +'</td>';
             items+= '<td>'+val.flag+'</td>';
             items+='<tr>';
           });
           $("#orderHistorySearchData").append(items);
        },
        error: function () {
         swal.fire("Error Searching!", "Please try again", "error").then((result) => {
            if(result.isConfirmed) {
               location.reload(true);
            }
         });
        
      }
   });
}

function getDateFromJsonString(dateString){
   var dateObj = new Date(dateString).toLocaleString();
   return dateObj;
}

</script>
@endsection

