@extends('layouts.master')
@section('content')
  
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Profile</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                        <tr> 
                                                <td class="sorting_1">Name</td>
                                                <td>Email</td>
                                                <td>CNIC</td>
                                                <td>Phone</td>
                                                 
                                                <td>State</td>
                                                <td>City</td>
                                            </tr>
                                
                                @foreach ($profile_result as $u_profile)
                                
                                

                                <tr role="row" >
                                                <td
                                                >{{ $u_profile->name }}</td>
                                                <td>{{ $u_profile->email }}</td>
                                                <td>{{ $u_profile->user_cnic }}</td>
                                                <td>{{ $u_profile->user_phone }}</td>
                                                 
                                                <td>{{ $u_profile->state_id }}</td>
                                                <td>{{ $u_profile->city_id }}</td>
                                            </tr>

                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                           
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end basic table  -->
                    <!-- ============================================================== -->
                </div>
@endsection