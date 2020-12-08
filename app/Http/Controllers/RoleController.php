<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Str;
use DB;
class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        
       return view('role/index', compact('roles'));
    }


    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all(); 
        return view('role/create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[      
            'name'=> 'required|unique:roles|min:3',
            'permissionName'=>'required'             
             ]);
                
        $roles = new Role();
        $roles->name = $request->name;
        $roles->slug = Str::slug($request->name);
        $roles->save();

        $permission_names = $request['permissionName'];
        foreach($permission_names as $permission_name)
        {
            $roles->allowTo(Permission::where('id', $permission_name)->first());            
        }       
        return redirect('role/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::with('permissions')->findOrFail($id);
        $permissions=Permission::select('name','id')->get();
        return view('role/edit', compact('roles','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)     
    {
              
        $updatedata = $request->validate([

            'name'=> 'required',
            'permissionName'=>'required'
                     
            ]);

        Role::whereid($id)->update(array(
            'name' => $request->name
        ));
        DB::delete('delete from permission_role where role_id = ?',[$id]);

        $permission_names = $request['permissionName'];
        foreach($permission_names as $permission_name)
        {

        DB::insert('insert into permission_role (permission_id, role_id) values (?, ?)', [$permission_name, $id]);
        }

        return redirect('role/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteRole($id)
    {
        $roles = Role::findOrFail($id);
        $roles->delete();
        return redirect('role/index');
    }
}
