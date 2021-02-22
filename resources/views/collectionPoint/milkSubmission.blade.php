@extends('layouts.master')
@section('content')
 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>Milk Submission</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/DashBoard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Submission Form</li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->
<!-- Page Wrapper -->
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-header">
            <h4 class="card-title mb-0">Add Product</h4>
         </div>
         <div class="card-body">
         @if ($errors->any())
            @foreach ($errors->all() as $error)
               <div>{{$error}}</div>
            @endforeach
         @endif
            <form method="post">
               @csrf 
               
               <div class="form-group row">
                  <label for="collector_id" class="col-form-label col-md-2">Collector</label>
                  <div class="col-md-4">
                     <select class="form-control" name="collector_id" id="collector_id" required="" autocomplete="off">
                        <option value="">--Collector Name--</option>
                        @foreach ($collectors as $collector)
                        <option value="{{$collector->user_id}}" >{{$collector->name}}</option>
                        @endforeach                            
                     </select>
                  </div>
               </div>
               
               <!-- <div class="form-group row">
               <div class="col-md-4">
                     <input type="radio" name="shift" required="" autocomplete="off">
                     <label>Morning</label>

                     <input type="radio" name="shift" required="" autocomplete="off">
                     <label>Evening</label>                     
                  </div>
               </div> -->
               <div class="table-responsive">
                           <form method="post">
                              @csrf 
                              <table class="datatable table table-stripped mb-0 fetchCollection" id="fetchCollection">
                                 <thead>
                                    <tr>
                                       <th>Vendor Name</th>
                                       <th>Status</th>
                                       <th>Shift</th>
                                       <th>Collected Time</th>
                                       <th>Milk Quantity</th>
                                       <th>Fat</th>
                                       <th>Ash</th>
                                       <th>Total Proteins</th>
                                       <th>Total Solids</th>
                                       <th>Quality Pic</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                              </table>
                              <button type="button"  name="action" class="btn btn-info btn-lg " >Add</button>
                           </form>
                        </div>             
               
            </form>
         </div>
      </div>
   </div>
</div>
<!-- /page Wrapper -->

<script type="text/javascript">

$(document).ready(function() {	
$("#collector_id").on('change', function() {			
    var selectCollector = $("#collector_id").val();
  
    if(selectCollector != null) {
                                 $.ajax({
                                          url: '/collectors/collections/'+selectCollector,
                                          type: "GET",
                                          dataType: "json",
                                          success:function(response){
                                             console.log(response);
                                                                     var len = 0;
                                                                     $('#fetchCollection tbody').empty();     
                                                                     if(response.length > 0){
                                                                     len = response.length;
                                                                     for(var i=0; i<len; i++){
                                                                                                var task_id = response[i].id;                
                                                                                                var vendor_name = response[i].vendor_id;
                                                                                                var task_status = response[i].status;  
                                                                                                var task_shift = response[i].taskShift;
                                                                                                var task_collectionTime = response[i].collectedTime; 
                                                                                                var task_milkQuantity = response[i].milkCollected;
                                                                                                var task_Fat = response[i].fat;  
                                                                                                var task_Ash = response[i].Ash;
                                                                                                var task_Proteins = response[i].totalProteins; 
                                                                                                var task_totalSolids = response[i].totalSolid;             
   
                                                                                                var tr_str = "<tr>" +
                                                                                                "<td>" + vendor_name + "</td>" +
                                                                                                "<td>" + task_status + "</td>" +    
                                                                                                "<td>" + task_shift + "</td>" +
                                                                                                "<td>" + task_collectionTime + "</td>" +
                                                                                                "<td>" + task_milkQuantity + "</td>" +    
                                                                                                "<td>" + task_Fat + "</td>" +
                                                                                                "<td>" + task_Ash + "</td>" +
                                                                                                "<td>" + task_Proteins + "</td>" +    
                                                                                                "<td>" + task_totalSolids + "</td>" +
                                                                                                            "</tr>";
                                                                                                   $("#fetchCollection tbody").append(tr_str);
                                                                                             }



                                                                                             }
                                                                     }
                                 


                                       });
                                 }

                           
                                           });
                           });

</script>

@endsection

