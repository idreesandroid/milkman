<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\User;
use App\Models\Role;
use App\Models\State;
use App\Models\City;
use App\Models\bankDetail;
use App\Models\Distributor;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DistributorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {       
    $distributorDetails = User::whereHas('roles', function($query) {
        $query->where('roles.id', 3); 
    })->with('distributorCompany')->get();   
    
    return view('distributor-detail/index', compact('distributorDetails'));
    }

    //create view-----------------------------------------------

    public function create() 
    {      
        return view('distributor-detail/create');
    }

//create--------------------------------------------------------

    public function store(Request $request)
    {  
        
        $this->validate($request,[        
            'name'      => 'required|min:1',          
            'password'  => 'required|min:1',
            'user_cnic' => 'required|min:13|unique:users',
            'user_phone'=> 'required|min:11|unique:users',
            'state'  => 'required',
            'city'  => 'required',
            'user_address'  => 'required|min:1',
            'companyName'=>'required|min:3',
            'companyOwner'=>'required|min:3', 
            'companyContact' => 'required',
            'companyAddress'=>'required|min:3',
            'companyNTN'=>'required|min:3', 
            'companyArea' => 'required',            
            'filenames.*' => 'mimes:jpg,png,jpeg,gif'       
        ]);

        $distributor_register = new User();
        $distributor_register->name = $request->name;        
        $distributor_register->email = $request->email;
        $distributor_register->password = Hash::make($request->password);
        $distributor_register->user_cnic = $request->user_cnic;
        $distributor_register->user_phone = $request->user_phone;
        $distributor_register->state = $request->state;
        $distributor_register->city = $request->city;
        $distributor_register->user_address = $request->user_address;
        $distributor_register->save();
        $distributor_register->roles()->attach(Role::where('id',3)->first());

        $distributor_details = new Distributor();
        $distributor_details->user_id = $distributor_register->id;        
        $distributor_details->companyName = $request->companyName;
        $distributor_details->alotedArea = $request->alotedArea;
        $distributor_details->companyOwner = $request->companyOwner;
        $distributor_details->companyContact = $request->companyContact;
        $distributor_details->companyAddress = $request->companyAddress;
        $distributor_details->companyNTN = $request->companyNTN;
        $distributor_details->companyArea = $request->companyArea;
               

        if($request->hasfile('filenames'))
             {
                  $count= 1;
                foreach($request->file('filenames') as $file)
                {
                    $name =  $count.''.time().'.'.$file->extension();
                    $file->move(public_path().'/distributorCompany/', $name);  
                    $data[] = $name; 
                    $count++;  
                }
            }
             
        $distributor_details->filenames=json_encode($data);
        $distributor_details->save();

    return redirect('distributor-detail/index');
    }
}