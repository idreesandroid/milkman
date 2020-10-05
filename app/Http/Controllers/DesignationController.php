<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DesignationController extends Controller
{
    
    public function load_designation()
    {
        
         
       return view('add_designation');
      

    }
    public function add_designation(Request $request)
    {
        
          $designation_title = $request->input('designation_title');
         
$add_desig = " insert into designations (designation_title) values ('$designation_title') ";
$add_desig_res =  DB::insert($add_desig);

       return redirect('add_designation');
      

    }





}
