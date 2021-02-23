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
            <h4 class="card-title mb-0">Milk Submit</h4>
         </div>
         <div class="card-body">
         @if ($errors->any())
            @foreach ($errors->all() as $error)
               <div>{{$error}}</div>
            @endforeach
         @endif
            <form method="post" action="{{route('collection.Submission') }}" enctype="multipart/form-data">
               @csrf 
               
               <div class="form-group row">
                  <label for="collector_id" class="col-form-label col-md-2">Collector Name</label>
                  <div class="col-md-4">
                     <select class="form-control" name="collector_id" id="collector_id" required="" autocomplete="off">
                        <option value="">--Collector Name--</option>
                        @foreach ($collectors as $collector)
                        <option value="{{$collector->user_id}}" >{{$collector->name}}</option>
                        @endforeach                            
                     </select>
                  </div>
               </div>
               <div class="table-responsive">
                         
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
                                       <th>Proteins</th>
                                       <th>Lactose</th>
                                       <th>Solids</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                                 <tfoot>
                                 </tfoot>
                              </table>
                        </div>  
<br><br>
<div class="row">
<div class="col-md-6">
               <div class="form-group row">
                  <label for="totalMilk" class="col-form-label col-md-4">Total Milk</label>
                  <div class="col-md-8">
                     <input type="number" step="0.001" class="form-control" id="totalMilk" name="totalMilk" required="" autocomplete="off">
                  </div>
               </div>

               <div class="form-group row">
                  <label for="totalFat" class="col-form-label col-md-4">Fat</label>
                  <div class="col-md-8">
                     <input type="number" step="0.000001" class="form-control" id="totalFat" name="totalFat" required="" autocomplete="off">
                  </div>
               </div>

               <div class="form-group row">
                  <label for="totalLactose" class="col-form-label col-md-4">Lactose</label>
                  <div class="col-md-8">
                     <input type="number" step="0.000001" class="form-control" id="totalLactose" name="totalLactose" required="" autocomplete="off">
                  </div>
               </div>               
               </div>
            <div class="col-md-6">
               <div class="form-group row">
                  <label for="totalAsh" class="col-form-label col-md-4">Ash</label>
                  <div class="col-md-8">
                     <input type="number" step="0.000001" class="form-control" id="totalAsh" name="totalAsh" required="" autocomplete="off">
                  </div>
               </div>

               <div class="form-group row">
                  <label for="totalProteins" class="col-form-label col-md-4">Proteins</label>
                  <div class="col-md-8">
                     <input type="number" step="0.000001" class="form-control" id="totalProteins" name="totalProteins" required="" autocomplete="off">
                  </div>
               </div>

               <div class="form-group row">
                  <label for="D_Shot" class="col-form-label col-md-4">Device ScreenShot</label>
                  <div class="col-md-8">
                  <input type="file" class="form-control" name="D_Shot" id="D_Shot" required=""  autocomplete="off" >
                  </div>
               </div>

            </div></div>

            <input type="hidden" id="subTask_id" name="subTask_id">
                        <button type="submit" class="btn btn-info btn-lg " >Collected</button>           
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
                                                                     $('#fetchCollection tfoot').empty(); 

                                                                     $("#totalMilk").val('');
                                                                     $("#totalFat").val('');
                                                                     $("#totalAsh").val('');
                                                                     $("#totalProteins").val('');
                                                                     $("#totalLactose").val('');

                                                                     if(response.length > 0){
                                                                     len = response.length;
                                                                     var TMQ = [];
                                                                     var TF = [];
                                                                     var TA = [];
                                                                     var TP = [];
                                                                     var TS = [];
                                                                     var TL = [];
                                                                     for(var i=0; i<len; i++){
                                                                                                var task_id = response[i].id;                
                                                                                                var vendor_name = response[i].name;
                                                                                                var task_status = response[i].status;  
                                                                                                var task_shift = response[i].taskShift;
                                                                                                var task_collectionTime = response[i].collectedTime; 
                                                                                                var task_milkQuantity = response[i].milkCollected;
                                                                                                var task_Fat = response[i].fat;  
                                                                                                var task_Ash = response[i].Ash;
                                                                                                var task_lactose = response[i].lactose;
                                                                                                var task_Proteins = response[i].totalProteins; 
                                                                                                var task_totalSolids = response[i].totalSolid; 
                                                                                                var t_id = response[i].task_id;             
   
                                                                                                var tr_str = "<tr>" +                                                                                                
                                                                                                "<td>" + vendor_name + "</td>" +
                                                                                                "<td>" + task_status + "</td>" +    
                                                                                                "<td>" + task_shift + "</td>" +
                                                                                                "<td>" +task_collectionTime + "</td>" +
                                                                                                "<td>" + task_milkQuantity + "</td>" +    
                                                                                                "<td>" + task_Fat + "</td>" +
                                                                                                "<td>" + task_Ash + "</td>" +
                                                                                                "<td>" + task_Proteins + "</td>" +  
                                                                                                "<td>" + task_lactose + "</td>" +  
                                                                                                "<td>" + task_totalSolids + "</td>" +
                                                                                                "<td >"+"<input type='checkbox' style='display:none' value='"+task_id+"' name='collectionIds[]' id='collection_ids_"+task_id+"'/>"+" </td>"+
                                                                                                            "</tr>";
                                                                                                   $("#fetchCollection tbody").append(tr_str);
                                                                                                   if(task_status == "Collected" || task_status == "Rejected" )
                                                                                                   {
                                                                                                      $("#subTask_id").val(t_id);
                                                                                                      $("#collection_ids_"+task_id).attr("checked", true);
                                                                                                   }

                                                                                                   if(task_status == "Collected")
                                                                                                   {
                                                                                                      TMQ[i] = task_milkQuantity;
                                                                                                      TF[i] = task_Fat;
                                                                                                      TA[i] = task_Ash;
                                                                                                      TP[i] = task_Proteins;
                                                                                                      TS[i] = task_totalSolids;
                                                                                                      TL[i] = task_lactose;
                                                                                                   }
                                                                                             }

                                                                                                      var sumMilk = TMQ.reduce((a, b) => { return a + b;}); 
                                                                                                      var averageFat = TF.reduce((a, b) => { return (a + b)/TF.length;});
                                                                                                      var averageAsh = TA.reduce((a, b) => { return (a + b)/TA.length;});
                                                                                                      var averageProteins = TP.reduce((a, b) => { return (a + b)/TP.length;});
                                                                                                      var averagesSolids = TS.reduce((a, b) => { return (a + b)/TS.length;}); 
                                                                                                      var averagesLactose = TL.reduce((a, b) => { return (a + b)/TL.length;});   
                                                                                                      var tr_foot_str = "<tr>" +
                                                                                                            "<td>" +" " + "</td>" +
                                                                                                            "<td>" +" " + "</td>" +
                                                                                                            "<td>" +" " + "</td>" +
                                                                                                            "<td>" +" " + "</td>" +
                                                                                                            "<td>" +sumMilk  + "</td>" +
                                                                                                            "<td>" +averageFat+ "</td>" +
                                                                                                            "<td>" + averageAsh + "</td>" +
                                                                                                            "<td>" + averageProteins+ "</td>" +
                                                                                                            "<td>" + averagesLactose+ "</td>" +
                                                                                                            "<td>" + averagesSolids + "</td>" +
                                                                                                                     "</tr>";
                                                                                                            $("#fetchCollection tfoot").append(tr_foot_str);
                                                                                                            $("#totalMilk").val(sumMilk);
                                                                                                            $("#totalFat").val(averageFat);
                                                                                                            $("#totalAsh").val(averageAsh);
                                                                                                            $("#totalProteins").val(averageProteins);
                                                                                                            $("#totalLactose").val(averagesLactose);
                                                                                                            
                                                                                             }
                                                                     }
                                       });
                                 }
                                           });
                           });
</script>

@endsection

