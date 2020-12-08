

@extends('layouts.master')
@section('content')
<!-- Page Wrapper -->
<div class="row">
   <div class="col-sm-9">
      <div class="card mb-0">
         <div class="card-body">
            <div class="form-group mb-0 row">
               <div class="col-md-4">
                  <div class="input-group-append">
                     <a href="/permission/create" class="active"> <button class="btn btn-primary" type="button">Add Permission</button></a>
                     <br><br><br>
                  </div>
               </div>
            </div>
            <div class="table-responsive">
               <table class="datatable table table-stripped mb-0 datatables">
                  <thead>
                     <tr>
                        <th>Serial No</th>
                        <th>Permission Title</th>
                        <th>Permission Tag</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($permissions as $index => $permission)
                     <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$permission->name}}</td>
                        <td>{{$permission->slug}}</td>
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
@endsection