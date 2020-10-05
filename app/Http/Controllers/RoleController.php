<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Role;
class RoleController extends Controller
{
    public function index()
    {
        
       $roles = Role::all();    
       return view('Role/index', compact('roles'));
      

    }

    //create view-------------------------

    public function create() 
    {        
        return view('Role/create');  
    }

//create-------------------------


public function store(Request $request)
{
$this->validate($request,[      
    'role_title'=> 'required|unique:roles|min:3',
      
     ]);


$roles = new Role();
$roles->role_title = $request->role_title;
$roles->save();
return redirect('Role/index');

}

public function load_roles(Request $request)
{   
     
    
    $roles_que="SELECT role_id, role_title FROM roles order by role_id";
    $roles_list =  DB::select($roles_que);
 
   
    $show_roles =" SELECT 
    b.role_id AS main_role_id , 
    b.role_title AS main_role_title,
    a.`id` AS sub_role_id  ,
    sub_role_title 
    FROM `sub_roles` a
    INNER JOIN roles b ON b.`role_id`=a.`role_id` ";
    $show_roles_data =  DB::select($show_roles);
    return view('add_sub_roles', compact('roles_list','show_roles_data') ); 
}


 







public function add_sub_roles(Request $request)
{

   $role_id = $request->input('role_id');
   $sub_role_title = $request->input('sub_role_title');

    $roles_que_i="insert into sub_roles (role_id, sub_role_title) values ('$role_id','$sub_role_title') ";
 
   $sup_role_key = DB::insert($roles_que_i);
if(isset($sup_role_key)){
    $msg1 = [ 'msg'  => 'Success: Sub role inserted successfully' ];
}else{
    $msg1 = [ 'msg'  => 'Failed: Sub role not inserted' ];
}
   
 
     
 return redirect('add_sub_roles'); 
}

}
