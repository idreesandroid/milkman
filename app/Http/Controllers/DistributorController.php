<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Role;
use App\Models\State;
use App\Models\City;
use App\Models\bankDetail;
use App\Models\Distributor;
use App\Models\UserAccount;
use App\Models\UserTransaction;
use App\Models\Invoice;

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
    $distributorDetails = User::whereHas('roles', function($query) {$query->where('roles.id', 3);})->with('distributorCompany')->get();   
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
            'email'     => 'required|unique:users',         
            'password'  => 'required|min:1',
            'user_cnic' => 'required|min:13|unique:users',
            'user_phone'=> 'required|min:11|unique:users',
            'state'  => 'required',
            'city'  => 'required',
            'user_address'  => 'required|min:1',

            'filenames' => 'required',
            'filenames.*' => 'mimes:jpg,png,jpeg,gif',   

            'companyName'=>'required|min:3',
            'companyOwner'=>'required|min:3', 
            'companyContact' => 'required',
            'companyAddress'=>'required|min:3',
            'companyNTN'=>'required|min:3|unique:distributors', 
            'companyArea' => 'required', 
            'companyLogo' => 'required',           
            'companyLogo.*' => 'mimes:jpg,png,jpeg,gif'       
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
        
        if($request->hasfile('filenames')) {
       
            $name =  time().'.'.$request->file('filenames')->extension();
            $request->file('filenames')->move(public_path().'/UserProfile/', $name);  
            $data = $name; 
    }          
        $distributor_register->filenames=$data;
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
   

        if($request->hasfile('companyLogo')) {
       
            $logoName =  time().'.'.$request->file('companyLogo')->extension();
            $request->file('companyLogo')->move(public_path().'/distributorCompany/', $logoName);      
    }  
        $distributor_details->companyLogo=$logoName;
        $distributor_details->save();

        $distributor_acc = new UserAccount();
        $distributor_acc->user_id = $distributor_register->id;
        $distributor_acc->role_id =3;
        $distributor_acc->userAccount = generateAccNumber();
        $distributor_acc->balance =0;
        $distributor_acc->save();

        
    return redirect('distributor-detail/index');
    }


    public function companyDetailUpdate(Request $request, $id)
    {

        $updatedata = $request->validate([
            'companyName'=>'required|min:3',
            'companyOwner'=>'required|min:3', 
            'companyContact' => 'required',
            'companyAddress'=>'required|min:3',
            'companyNTN'=>'required|min:3', 
                       
       
        ]);
        Distributor::where('user_id', $id)->update($updatedata);
        return redirect()->route('profile.user', [$id]);
    }

        // DashBoard functions------------------------------------------------
    public function myOrders()
    {
        $mid = Auth::id();

        $invoices = Invoice::where('buyer_id' , $mid)->get();
        return view('distributor-detail/myInvoices', compact('invoices'));
       // return $invoices;
       //return view('role/index', compact('roles'));
    }

    public function distributorDashboard()
    {
        $Did = Auth::id();

        $distributorBalance = UserAccount::where('user_id' , $Did)->select('balance')->first();
        $transaction = UserTransaction::where('user_id' , $Did)->count();
    //  echo "<pre>";
    //  print_r($transaction);
    //  exit;
    return view('dashBoards.distributor', compact('distributorBalance','transaction'));

    }
    
}