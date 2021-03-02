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
            <form method="post" action="{{route('point.submission') }}" enctype="multipart/form-data">
               @csrf 
               
               <div class="form-group row">
                  <label for="point_id" class="col-form-label col-md-2">Collection Point Name</label>
                  <div class="col-md-4">
                     <select class="form-control" name="point_id" id="point_id" required="" autocomplete="off">
                        <option value="">--Collection Point--</option>
                        @foreach ($collectionPoints as $collectionPoint)
                        <option value="{{$collectionPoint->id}}" >{{$collectionPoint->pointName}}</option>
                        @endforeach                            
                     </select>
                  </div>
               </div>
<br><br>
<div class="row">
<div class="col-md-6">
               <div class="form-group row">
                  <label for="totalMilk" class="col-form-label col-md-4">Total Milk</label>
                  <div class="col-md-8">
                     <input type="number" min="1" class="form-control" id="totalMilk" name="totalMilk" required="" autocomplete="off">
                  </div>
               </div>

               <div class="form-group row">
                  <label for="totalFat" class="col-form-label col-md-4">Fat</label>
                  <div class="col-md-8">
                     <input type="number"  class="form-control" id="totalFat" name="totalFat" required="" autocomplete="off">
                  </div>
               </div>

               <div class="form-group row">
                  <label for="totalLactose" class="col-form-label col-md-4">Lactose</label>
                  <div class="col-md-8">
                     <input type="number"  class="form-control" id="totalLactose" name="totalLactose" required="" autocomplete="off">
                  </div>
               </div>               
               </div>
            <div class="col-md-6">
               <div class="form-group row">
                  <label for="totalAsh" class="col-form-label col-md-4">Ash</label>
                  <div class="col-md-8">
                     <input type="number"  class="form-control" id="totalAsh" name="totalAsh" required="" autocomplete="off">
                  </div>
               </div>

               <div class="form-group row">
                  <label for="totalProteins" class="col-form-label col-md-4">Proteins</label>
                  <div class="col-md-8">
                     <input type="number"  class="form-control" id="totalProteins" name="totalProteins" required="" autocomplete="off">
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
      //alert("hello");

        $("#point_id").on('change', function() {			
            var pID = $("#point_id").val();
			 //alert(pID);
            if(pID != null) {
         $.ajax({				
                    url: '/milk-point/check-quantity/'+pID,
                    type: "GET",
                    dataType: "json",
                    success:function(response) { 
                       //console.log(response);                   
                        $("#totalMilk").empty();
                        $("#totalMilk").val(response);
                        $("#totalMilk").attr("max", response);
                    }
                });
 
            }else{
                $("#totalMilk").empty();
            }
        });
    });
</script>


@endsection

