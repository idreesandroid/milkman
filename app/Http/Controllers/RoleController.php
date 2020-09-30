<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
