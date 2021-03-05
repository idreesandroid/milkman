@extends('layouts.master')
@section('content')

 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>Collection Point</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/Dashboard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Area List</li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->
<!-- Page Wrapper -->
<div class="row">
   <div class="col-sm-12">
      <div class="card mb-0">
         <div class="card-body">
           
            <div class="table-responsive">
               <table class="datatable table table-stripped mb-0 datatables">
                  <thead>
                     <tr>
                        <th>Area Title</th>
                        <th>Morning Collector</th>
                        <th>Evening Collector</th>
                        <th>Capacity</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($collectionAreas as $collectionArea)
                     <tr>
                         <td>{{$collectionArea->title}}</td>
                        <td>@if($collectionArea->AFM == 0) N/A @elseif($collectionArea->AFM == 1) {{morningCollector($collectionArea->id,'name')}} ({{morningCollector($collectionArea->id,'capacity')}} Ltr) @endif</td>
                        <td>@if($collectionArea->AFE == 0) N/A @elseif($collectionArea->AFE == 1) {{eveningCollector($collectionArea->id,'name')}} ({{eveningCollector($collectionArea->id,'capacity')}} Ltr)@endif</td> 
                        <td>Morning: {{calculateAreaMCapacity($collectionArea->id)}} <br> Evening: {{calculateAreaECapacity($collectionArea->id)}} </td>
                        <td>@if($collectionArea->AFM == 0) <a href="#" id="assignCollectorM_{{$collectionArea->id}}" class='btn btn-outline-primary' data-toggle="modal" data-target="#collectorSelection" onclick="findCollectors({{$collectionArea->id}},'Morning')">Assign For Morning</a> @elseif ($collectionArea->AFM == 1)<a href="#" id="ReassignCollectorM_{{$collectionArea->id}}" class='btn btn-outline-primary' data-toggle="modal" data-target="#collectorReSelection" onclick="ReAssignCollectors({{$collectionArea->id}},'Morning')">Reassign For Morning</a> @endif
                        <br><br> @if($collectionArea->AFE == 0)<a href="#" id="assignCollectorE_{{$collectionArea->id}}" class='btn btn-outline-primary' data-toggle="modal" data-target="#collectorSelection" onclick="findCollectors({{$collectionArea->id}},'Evening')">Assign For Evening</a> @elseif ($collectionArea->AFE == 1) <a href="#" id="ReassignCollectorE_{{$collectionArea->id}}" class='btn btn-outline-primary' data-toggle="modal" data-target="#collectorReSelection" onclick="ReAssignCollectors({{$collectionArea->id}},'Evening')">ReAssign For Evening</a> @endif</td>     
              
                        <td><a href="{{ route('area-base.Collections', $collectionArea->id)}}" class="btn btn-outline-info">Details</a></td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- /Page Wrapper -->
<!------------------------------------------------------------------------------------------------------------- -->
<!--Asim Make model for Assign Collector For Task Selection---->
<div id="collectorSelection" class="modal fade" role="dialog">
               <div class="modal-dialog" id="batch-info">
                  <!-- Modal content-->
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <div class="modal-body">
                        <div class="table-responsive">
                           <form method="post" action="{{route('select.Collector')}}">
                              @csrf 
                              <input type="hidden" name="cArea" id="area"/>
                              <input type="hidden" name="cShift" id="shift"/>

                              <table class="datatable table table-stripped mb-0 fetch_Collector" id="fetch_Collector">
                                 <thead>
                                    <tr>
                                       <th>Select</th>
                                       <th>Name</th>
                                       <th>Phone</th>
                                       <th>Capacity</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                              </table>
                              <button type="submit" class=" form-control btn btn-primary btn-info btn-lg " >Assign</button>
                           </form>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>


<!--Asim Make model for ReAssign Collector For Task Selection---->
<div id="collectorReSelection" class="modal fade" role="dialog">
               <div class="modal-dialog" id="batch-info">
                  <!-- Modal content-->
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <div class="modal-body">
                        <div class="table-responsive">
                           <form method="post" action="{{route('reselect.Collector')}}">
                              @csrf 
                              <input type="hidden" name="reArea" id="rearea"/>
                              <input type="hidden" name="reShift" id="reshift"/>

                              <table class="datatable table table-stripped mb-0 fetch_Collector" id="Refetch_Collector">
                                 <thead>
                                    <tr>
                                       <th>Select</th>
                                       <th>Name</th>
                                       <th>Phone</th>
                                       <th>Capacity</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                              </table>
                              <button type="submit" class=" form-control btn btn-primary btn-info btn-lg " >Assign</button>
                           </form>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>

<!--End Asim Make model for ReAssignTask Selection---->

<!------------------------------------------------------------------------------------------------------------- -->
<!-- Asim work on Assign Collector Java Script ----------------------------------------------------------------->
<script type="text/javascript">
   function findCollectors(id , value)
   { 
      if(value == 'Morning')
      {
         $("#shift").val(value);
         $("#area").val(id);

         if(id != null)
         {

            $.ajax({
            url: '/assign/Area/'+value+'/'+id,
               type: "GET",
               dataType: "json",
               success:function(response)
                {
                  var len = 0;
                  $('#fetch_Collector tbody').empty();     
                  if(response.length > 0)
                  {
                     len = response.length;

                     for(var i=0; i<len; i++)
                     {  
                   var cid = response[i].id;                
                   var collector_name = response[i].name;
                   var collector_Phone = response[i].user_phone;  
                   var collector_Capacity = response[i].collectorCapacity;

                   //console.log(collector_Capacity);    

                   var tr_str = "<tr>" +
                   "<td >" + "<input type='radio' value='"+cid+"'  name='select_collector' id='select_collector"+cid+"'/>" + "</td>" +
                     "<td >" + collector_name + "</td>" +    
                     "<td >" + collector_Phone + "</td>" +   
                     "<td >" + collector_Capacity + "</td>" +       
                   "</tr>";
                   $("#fetch_Collector tbody").append(tr_str);
                     }   
                  }
                  else
                  {
                     alert("There is no collector Available");
                  }
                }                              
               });
         }
      }

      else if(value == 'Evening')
      { 
         $("#shift").val(value);
         $("#area").val(id);
         if(id != null)
         {
            $.ajax({
            url: '/assign/Area/'+value+'/'+id,
               type: "GET",
               dataType: "json",
               success:function(response) 
               {
                  var len = 0;
                  $('#fetch_Collector tbody').empty();     
                  if(response.length > 0)
                  {
                     len = response.length;
                     for(var i=0; i<len; i++)
                     {  
                   var cid = response[i].id;                
                   var collector_name = response[i].name;
                   var collector_Phone = response[i].user_phone;  
                   var collector_Capacity = response[i].collectorCapacity;

                   console.log(collector_Capacity);    

                   var tr_str = "<tr>" +
                     "<td >" + "<input type='radio' value='"+cid+"'  name='select_collector' id='select_collector"+cid+"'/>" + "</td>" +
                     "<td >" + collector_name + "</td>" +    
                     "<td >" + collector_Phone + "</td>" +   
                     "<td >" + collector_Capacity + "</td>" +             
                   "</tr>";
                   $("#fetch_Collector tbody").append(tr_str);
                     }   
                  }
                  else
                  {
                     alert("There is no collector Available");
                  }
                }
                                            
                  });
         }
      }      
   }
</script>


<script type="text/javascript">
   function ReAssignCollectors(id , value)
      { 
          if(value == 'Morning')
            {
             $("#reshift").val(value);
             $("#rearea").val(id);
               if(id != null)
                {
                 $.ajax({
                 url: '/assign/Area/'+value+'/'+id,
                 type: "GET",
                 dataType: "json",
                 success:function(response)
                 {
                  var len = 0;
                  $('#Refetch_Collector tbody').empty();     
                  if(response.length > 0)
                  {
                     len = response.length;
                     for(var i=0; i<len; i++)
                     {  
                   var cid = response[i].id;                
                   var collector_name = response[i].name;
                   var collector_Phone = response[i].user_phone;  
                   var collector_Capacity = response[i].collectorCapacity;

                   //console.log(collector_Capacity);    

                   var tr_str = "<tr>" +
                   "<td >" + "<input type='radio' value='"+cid+"'  name='reselect_collector' id='select_collector"+cid+"'/>" + "</td>" +
                     "<td >" + collector_name + "</td>" +    
                     "<td >" + collector_Phone + "</td>" +   
                     "<td >" + collector_Capacity + "</td>" +       
                   "</tr>";
                   $("#Refetch_Collector tbody").append(tr_str);
                     }   
                  }
                  else
                  {
                     alert("There is no collector Available");
                  }
                  }                              
                       });
                }
               }

      else if(value == 'Evening')
      { 
         $("#reshift").val(value);
         $("#rearea").val(id);
         if(id != null)
         {
            $.ajax({
            url: '/assign/Area/'+value+'/'+id,
               type: "GET",
               dataType: "json",
               success:function(response) 
               {
                  var len = 0;
                  $('#Refetch_Collector tbody').empty();     
                  if(response.length > 0)
                  {
                     len = response.length;
                     for(var i=0; i<len; i++)
                     {  
                   var cid = response[i].id;                
                   var collector_name = response[i].name;
                   var collector_Phone = response[i].user_phone;  
                   var collector_Capacity = response[i].collectorCapacity;

                   console.log(collector_Capacity);    

                   var tr_str = "<tr>" +
                     "<td >" + "<input type='radio' value='"+cid+"'  name='reselect_collector' id='select_collector"+cid+"'/>" + "</td>" +
                     "<td >" + collector_name + "</td>" +    
                     "<td >" + collector_Phone + "</td>" +   
                     "<td >" + collector_Capacity + "</td>" +             
                   "</tr>";
                   $("#Refetch_Collector tbody").append(tr_str);
                     }   
                  }
                  else
                  {
                     alert("There is no collector Available");
                  }
                }                                            
            });
         }
      }      
   }

</script>


@endsection