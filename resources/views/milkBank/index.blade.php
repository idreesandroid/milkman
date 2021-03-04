@extends('layouts.master')
@section('content')
 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>Milk Bank</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/DashBoard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Milk Bank List</li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->
<!-- Page Wrapper -->
<div class="row">
   <div class="col-sm-12">
      <div class="card mb-0">
         <div class="card-body">
            @can('Create-Product')
            <div class="form-group mb-0 row">
               <div class="col-md-4">
                  <div class="input-group-append">
                     <a href="/milkBank/create" class="active"> <button class="btn btn-primary" type="button">Add Milk Bank</button></a>
                  </div>
               </div>
            </div>
            @endcan
            
            <div class="table-responsive">
               <table class="datatable table table-stripped mb-0 datatables">
                  <thead>
                     <tr>
 
                        <th>Milk Bank Name</th>
                        <th>Milk Bank Address</th>
                        <th>Available Milk</th>
                        @can('Assign-Milk-Bank-Manager')   
                        <th>Milk Bank Head</th>
                        @endcan 
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($milkBanks as $milkBank)
                     <tr>
                        <td>{{$milkBank->bankName}}</td>
                        <td>{{$milkBank->bankAddress}}</td>
                        <td>{{$milkBank->milkAvailable}} Ltr</td>
                        @can('Assign-Milk-Bank-Manager')
                        <td><button type="button" id="point_{{$milkBank->id}}" onclick="getCId({{$milkBank->id}})" class="btn btn-primary" data-toggle="modal" data-target="#findManager">Assign</button></td>
                        @endcan 
                          <td>  <a href="{{ route('edit.milkBank', $milkBank->id)}}" class="btn btn-primary">Edit</a>
                           <form action="{{ route('delete.milkBank', $milkBank->id)}}" method="post" style="display: inline-block">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                           </form>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>

            </div>
         </div>
      </div>
   </div>
</div>


<!-- model -->
<div id="findManager" class="modal fade" role="dialog">
               <div class="modal-dialog" id="find-asset">
                  <!-- Modal content-->
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                     </div>
                     <div class="modal-body">
                        <div class="table-responsive">
                           <form method="post" action="{{ route('assignManager.milkBank') }}">
                              @csrf 
                              <input type="hidden" id="pId" name="pId" value="">
                              <table class="datatable table table-stripped mb-0 find_manager" id="find_manager">
                                 <thead>
                                    <tr>
                                       <th>Select Any</th>
                                       <th>Name</th>
                                       <th>Milk Bank</th>
                                       <th>Manager Phone</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                              </table>
                              <button type="submit" class=" form-control btn btn-sm- btn-info" >Add</button>
                           </form>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>
<!-- model -->



<!-- /Page Wrapper -->
@endsection

<script type="text/javascript">
var pointId ='';
   function getCId(id)
      {
      pointId =id;
      $("#pId").val(id);
      $.ajax({
         url: '/get/milkBank-Head/'+id,
         type: "GET",
         success:function(response) { 
            //console.log(data);
                              console.log(response);

                                    var len = 0;
                                    $('#find_manager tbody').empty();     
                                    if(response.length > 0){
                                    len = response.length;
                                    for(var i=0; i<len; i++){
                                                          var manager_id = response[i].user_id;
                                                          var manager_name = response[i].name;  
                                                          var milkBank = response[i].bankName;
                                                          var user_phone = response[i].user_phone;  
                                                         
                                                          var tr_str = "<tr>" +
                                                          "<td >"+"<input type='radio' value='"+manager_id+"' name='manager_id' id='manager_id"+manager_id+"'/>"+" </td>"+
                                                         "<td>" + manager_name + "</td>" +  
                                                         "<td >" + milkBank  + "</td>" +  
                                                         "<td >" + user_phone  + "</td>" +                                                                        
                                                         "</tr>";
                                                         $("#find_manager tbody").append(tr_str);
                                                         if(milkBank != null)
                                                         {
                                                            $("#manager_id"+manager_id).attr("checked", true);
                                                         }
                                                            }
                                                          }
                                                          else
                                                             {
                                                                var tr_str = "<tr>" +
                                                                "<td align='center' colspan='4'>No record found.</td>" +
                                                                "</tr>";
                                                                $("#find_manager tbody").append(tr_str);
                                                            }
                                 }                                           
            });   
      }

      
</script>
