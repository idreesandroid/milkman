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
         <li class="breadcrumb-item active">Asset List</li>
      </ul>
   </div>
</div>
<!-- /Page Header -->
<div class="page-header  mb-0 ">
   <div class="row">
      <div class="col">
         <h3>Asset</h3>
      </div>
      @can('Create-Asset')
      <div class="col text-right">
         <ul class="list-inline-item pl-0">
            <li class="list-inline-item">
               <a  href="{{ route('create.asset')}}"class="add btn btn-gradient-primary font-weight-bold text-white todo-list-add-btn btn-rounded">Add Asset</a>
            </li>
         </ul>
      </div>
      @endcan
   </div>
</div>
<!-- Page Wrapper -->
<div class="row">
   <div class="col-sm-12">
      <div class="card mb-0">
         <div class="card-body">
            <div class="table-responsive">
               <table class="datatable table table-stripped mb-0 datatables" id="assetListing">
                  <thead>
                     <tr>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Capacity</th>
                        <th>Collection Point</th>
                        <th>Assign To</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($Assets as $Asset)
                     <tr>
                        <td>{{$Asset->typeName}}</td>
                        <td>{{$Asset->assetName}}</td>
                        <td>{{$Asset->assetCode}}</td>
                        <td>{{number_format($Asset->assetCapacity)}} {{$Asset->assetUnit}}</td>
                        <td>{{$Asset->pointName}}</td>
                        <td>{{$Asset->name}}</td>
                        <td>
                           <a href="{{ route('edit.asset', $Asset->id)}}" class="btn btn-primary">Edit</a>
                           <form action="{{ route('delete.asset', $Asset->id)}}" method="post" style="display: inline-block">
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

<script>
   $(document).ready( function () {
      $('#assetListing').DataTable();
   });
</script>
<!-- /Page Wrapper -->
@endsection

