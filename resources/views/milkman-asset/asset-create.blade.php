@extends('layouts.master')
@section('content')
 <!-- Page Header -->
 <div class="crms-title row bg-white mb-4">
            <div class="col">
               <h3 class="page-title">
                  <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="la la-table"></i>
                  </span> <span>Asset</span>
               </h3>
            </div>
            <div class="col text-right">
               <ul class="breadcrumb bg-white float-right m-0 pl-0 pr-0">
                  <li class="breadcrumb-item"><a href="/DashBoard">Dashboard</a></li>
                  <li class="breadcrumb-item active">Add Asset</li>
               </ul>
            </div>
         </div>
         <!-- /Page Header -->
<!-- Page Wrapper -->
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-header">
            <h4 class="card-title mb-0">Add Asset</h4>
         </div>
         <div class="card-body">
         @if ($errors->any())
            <div class="alert alert-danger">
               <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
               </ul>
            </div>
            @endif
            <form method="post" action="{{ route('store.asset') }}"  id="type">
               @csrf
               <div class="form-group row">
                  <label id="assetName" for="assetName" class="col-form-label col-md-2"> Asset Name: </label>
                  <div class="col-md-4">
                     <input type="text" class="form-control" name="assetName" id="assetName" autocomplete="off">
                  </div>
               </div>
               
               <div class="form-group row">
                  <label for="type_id" class="col-form-label col-md-2">Asset Type:</label>
                  <div class="col-md-4">
                     <select class="form-control" name="type_id" id="type_id" required="" autocomplete="off">
                        <option value="">--Asset Type--</option>
                        @foreach ($types as $type)
                        <option value="{{ $type->id}}" >{{$type->typeName}}</option>
                        @endforeach                            
                     </select>
                  </div>
               </div>               

               <div class="form-group row">
                  <label for="assign_to" class="col-form-label col-md-2">Assigne To:</label>
                  <div class="col-md-4">
                     <select class="form-control" name="assign_to" id="assign_to" required="" autocomplete="off">
                        <option value="">--Assigne To--</option>
                        @foreach ($collectors as $collector)
                        <option value="{{ $collector->id}}" >{{$collector->name}}</option>
                        @endforeach                            
                     </select>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="assign_at" class="col-form-label col-md-2">Assigne At:</label>
                  <div class="col-md-4">
                     <select class="form-control" name="assign_at" id="assign_at" required="" autocomplete="off">
                        <option value="">--Assigne At--</option>
                        @foreach ($collectionPoints as $collectionPoint)
                        <option value="{{ $collectionPoint->id}}" >{{$collectionPoint->pointName}}</option>
                        @endforeach                            
                     </select>
                  </div>
               </div>

               <div class="form-group row">
                  <label style="display:none" id="L_assetNumber" for="assetNumber" class="col-form-label col-md-2"> Registration No:</label>
                  <div class="col-md-4">
                     <input type="text" class="form-control" style="display:none" name="assetNumber" id="assetNumber" autocomplete="off">
                  </div>
               </div>

               <div class="form-group row">
                  <label for="assetCapacity" id="L_assetCapacity" class="col-form-label col-md-2"> Capacity:</label>
                  <div class="col-md-4">
                     <input type="number" class="form-control" name="assetCapacity" id="assetCapacity" min="0" autocomplete="off">
                  </div>
               </div>

               <div class="form-group row">
                  <label for="numberOfAsset" class="col-form-label col-md-2"> Number Of Asset:</label>
                  <div class="col-md-4">
                     <input type="number" class="form-control" name="numberOfAsset" id="numberOfAsset" min="1" value="1" required="" autocomplete="off">
                  </div>
               </div>

               <div class="form-group mb-0 row">
                  <div class="col-md-10">
                     <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Add Asset</button>
                     </div>
                  </div>
               </div>               
            </form>
         </div>
      </div>
   </div>
</div>
<!-- /page Wrapper -->


<script type="text/javascript">	
    $(document).ready(function() {

        $("#type_id").on('change', function() {			
            
          var typeValue = $("#type_id").val();
          if (typeValue == 1)
           {
         $('#L_assetNumber').show();
         $('#assetNumber').show();
         $("#assetNumber").attr("required", true);

         $('#L_assetCapacity').hide();
         $('#assetCapacity').hide();
         $("#assetCapacity").attr("required", false);

         $("#numberOfAsset").attr("max", 1);

           }
         else if(typeValue == 2)
           {
         $('#L_assetCapacity').show();
         $('#assetCapacity').show();
         $("#assetCapacity").attr("required", true);

         $('#L_assetNumber').hide();
         $('#assetNumber').hide();
         $("#assetNumber").attr("required", false);

         $("#numberOfAsset").attr("max", '');
           }
           else if(typeValue == 3)
           {
			$('#L_assetNumber').hide();
         $('#assetNumber').hide();
         $("#assetNumber").attr("required", false);

         $('#L_assetCapacity').hide();
         $('#assetCapacity').hide();
         $("#assetCapacity").attr("required", false);
         $("#numberOfAsset").attr("max", '');
           }
        });
    });
</script>
@endsection

