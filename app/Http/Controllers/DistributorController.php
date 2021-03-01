<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Role;
use App\Models\State;
use App\Models\City;
use App\Models\bankDetail;
use App\Models\Distributor;
use App\Models\UserAccount;
use App\Models\UserTransaction;
use App\Models\Invoice;
use App\Models\Cart;
use App\Models\Product;

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
            'name'      => 'required|min:3', 
            'email'     => 'required|unique:users',         
            'password'  => 'required|min:6',
            'Confirm'=> 'required_with:password|same:password',
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

       $Did = Auth::id();


         $products = Product::select('id','product_name')->get();
         $totalOrders = [];
         $productids = [];
         $productNames = [];
         foreach($products as $item){

             array_push($productids, $item->id);
             array_push($productNames, $item->product_name);

             $orders = Cart::where('product_id',$item->id)
                             ->where('created_at','>=',date('Y-m-d'))
                             ->sum('product_quantity');
             array_push($totalOrders, $orders);
         }

        $first_day_this_month  = date('Y-m-01');
        $current_day_this_month = date('Y-m-d');

        $periods = createDateRangeArray($first_day_this_month,$current_day_this_month);

        $productsDetail = '[';        

        foreach($periods as $period){
            $pro = '';
            $pro .= '{date:'."'".$period."'".',';
            
            foreach($productids as $key => $productid){

                $total = '';

                $products = Invoice::select('carts.product_id','carts.created_at','products.product_name','invoices.buyer_id')
                                    ->join('carts','invoices.id','=','carts.invoice_id')
                                    ->leftJoin('products','products.id','=','carts.product_id')
                                    ->where('carts.product_id', $productid)
                                    ->where('carts.created_at', 'like', '%' . $period . '%')
                                    ->where('invoices.buyer_id', '=', $Did)
                                    ->get();

                $total = Cart::where('product_id', $productid)
                                ->where('created_at', 'like', '%' . $period . '%')
                                ->sum('product_quantity');

                if(empty($products->count())){
                    $pro .= "'".$productNames[$key]."' : ". $total.",";
                }else{
                    $pro .= "'".$productNames[$key]."' : ". $total.",";
                }
            }
            $newpro='';
            $newpro .= rtrim($pro, ","); 
            $newpro .= '},';
            $productsDetail .= $newpro;
                      
        }        

        $productsDetail .= ']'; 

        $productsDetail = str_replace("},]","}]",$productsDetail);

        $distributorBalance = UserAccount::where('user_id' , $Did)->select('balance')->first();
        $transaction = UserTransaction::where('user_id' , $Did)->count();
    
        return view('dashBoards.distributor', compact('distributorBalance','transaction','productsDetail','productNames'));

    }

    public function destroy(Request $request){
        $Did = Auth::id();
        
        $UserAccount = UserAccount::select('balance')
                                    ->where('user_id','=',$Did)
                                    ->get();

        $totAmount = Invoice::select('total_amount')
                                    ->where('buyer_id','=',$Did)
                                    ->get();            

        $newAmount = $UserAccount[0]->balance + $totAmount[0]->total_amount;

        UserAccount::where('user_id',$Did)
                    ->update([
                        'balance' => $newAmount,
                        'updated_at' => Carbon::now()
                    ]);

        $deleteOrder = Invoice::where('id', $request->id)
                                ->where('buyer_id',$Did)
                                ->delete();
        $delteItems = Cart::where('invoice_id',$request->id)->delete();

        return ($delteItems) ? true : false;
    }
    
}