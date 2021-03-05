<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\State;
use App\Models\City;
use App\Models\bankDetail;
use App\Models\vendorDetail;
use App\Models\UserAccount;

use App\Models\SubTask;

use App\Models\Tasks;
use App\Models\CollectionVendor;
use App\Models\Collection;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class VendorDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {       
        $vendorDetails = User::whereHas('roles', function($query) { 
            $query->where('roles.id', 6);
             })->with('vendorDetail')->get();
        return view('vendor-detail/index', compact('vendorDetails'));
    }
    //create view-----------------------------------------------

    public function create() 
    {      
        return view('vendor-detail/create');
    }

    //create--------------------------------------------------------

    public function store(Request $request)
    {
     echo "<pre>";
     print_r($request->all());
     exit; 

        if($request->has('bankDetails')){

            $this->validate($request,[        
                'name'      => 'required|min:3',
                'email'     => 'required|unique:users',
                'password'  => 'required|min:6',
                'Confirm'=> 'required_with:password|same:password',
                'user_cnic' => 'required|min:15|unique:users',
                'user_phone'=> 'required|min:12|unique:users',
                'state'  => 'required',
                'city'  => 'required',
                'user_address'  => 'required|min:1',

                'filenames' => 'required',
                'filenames.*' => 'mimes:jpg,png,jpeg,gif',   

                'bank_name'=> 'required|min:1',
                'branch_name'=>'required|min:1',
                'branch_code'=>'required|min:1', 
                'acc_no'=>'required|min:1|unique:bank_details',
                'acc_title'=>'required|min:1|unique:bank_details',

                'decided_milkQuantity'=>'required|min:0|numeric',
                'decided_rate'=>'required|min:1|numeric', 
                'morning_decided_milkQuantity'=>'required|min:0|numeric',
                'morningTime'=>'required', 
                'evening_decided_milkQuantity'=>'required|min:0|numeric',
                'eveningTime'=>'required', 
  
                'map_detail' => 'required'
           
                ]);

                $vendor_register = new User();
                $vendor_register->name = $request->name;        
                $vendor_register->email = $request->email;
                $vendor_register->password = Hash::make($request->password);
                $vendor_register->user_cnic = $request->user_cnic;
                $vendor_register->user_phone = $request->user_phone;
                $vendor_register->state = $request->state;
                $vendor_register->city = $request->city;
                $vendor_register->user_address = $request->user_address;

                if($request->hasfile('filenames')) {
       
                    $name =  time().'.'.$request->file('filenames')->extension();
                    $request->file('filenames')->move(public_path().'/UserProfile/', $name);  
                    $data = $name; 
                }          
                $vendor_register->filenames=$data;
                $vendor_register->save();
                $vendor_register->roles()->attach(Role::where('id',6)->first());

                $vendor_details = new vendorDetail();
                $vendor_details->user_id = $vendor_register->id;  

                $mapdata = json_decode($request->map_detail);
                $vendor_details->latitude = $mapdata[0]->geometry[0];
                $vendor_details->longitude = $mapdata[0]->geometry[1];
                
                $vendor_details->decided_milkQuantity = $request->decided_milkQuantity;
                $vendor_details->decided_rate = $request->decided_rate; 
                
                $vendor_details->morning_decided_milkQuantity = $request->morning_decided_milkQuantity;
                $vendor_details->evening_decided_milkQuantity = $request->evening_decided_milkQuantity;
                $vendor_details->morningTime = $request->morningTime;
                $vendor_details->eveningTime = $request->eveningTime;
                $vendor_details->save();

                $bankDetails = new bankDetail();
                $bankDetails->user_id = $vendor_register->id;        
                $bankDetails->bank_name = $request->bank_name;
                $bankDetails->branch_name = $request->branch_name;
                $bankDetails->branch_code = $request->branch_code;
                $bankDetails->acc_no = $request->acc_no;
                $bankDetails->acc_title = $request->acc_title;
                $bankDetails->save();

        } else {
            $this->validate($request,[        
                'name'      => 'required|min:3',
                'email'     => 'required|unique:users',
                'password'  => 'required|min:6',
                'Confirm'=> 'required_with:password|same:password',
                'user_cnic' => 'required|min:15|unique:users',
                'user_phone'=> 'required|min:12|unique:users',
                'state'  => 'required',
                'city'  => 'required',
                'user_address'  => 'required|min:1',   
                
                'filenames' => 'required',
                'filenames.*' => 'mimes:jpg,png,jpeg,gif',   

                'decided_milkQuantity'=>'required|min:0|numeric',
                'decided_rate'=>'required|min:1|numeric', 
                'morning_decided_milkQuantity'=>'required|min:0|numeric',
                'morningTime'=>'required', 
                'evening_decided_milkQuantity'=>'required|min:0|numeric',
                'eveningTime'=>'required', 

                'map_detail' => 'required'
               
           
                ]);

            $vendor_register = new User();
            $vendor_register->name = $request->name;        
            $vendor_register->email = $request->email;
            $vendor_register->password = Hash::make($request->password);
            $vendor_register->user_cnic = $request->user_cnic;
            $vendor_register->user_phone = $request->user_phone;
            $vendor_register->state = $request->state;
            $vendor_register->city = $request->city;
            $vendor_register->user_address = $request->user_address;

            
            if($request->hasfile('filenames')) {
   
                $name =  time().'.'.$request->file('filenames')->extension();
                $request->file('filenames')->move(public_path().'/UserProfile/', $name);  
                $data = $name; 
            }          
            $vendor_register->filenames=$data;
            
            $vendor_register->save();
            $vendor_register->roles()->attach(Role::where('id',6)->first());

            $vendor_details = new vendorDetail();
            $mapdata = json_decode($request->map_detail);
            $vendor_details->latitude = $mapdata[0]->geometry[0];
            $vendor_details->longitude = $mapdata[0]->geometry[1];
            $vendor_details->user_id = $vendor_register->id;        
            $vendor_details->decided_milkQuantity = $request->decided_milkQuantity;
            $vendor_details->decided_rate = $request->decided_rate;               

            $vendor_details->morning_decided_milkQuantity = $request->morning_decided_milkQuantity;
            $vendor_details->evening_decided_milkQuantity = $request->evening_decided_milkQuantity;
            $vendor_details->morningTime = $request->morningTime;
            $vendor_details->eveningTime = $request->eveningTime;

            $vendor_details->save();        
        }


        $vendorDetail = vendorDetail::select('user_id','latitude','longitude','collection_id')
                            ->where('user_id','=',$vendor_register->id)
                            ->first();
        $vendorLocations = Collection::select('id','vendors_location')->get();
        $collection_id = '';
        foreach($vendorLocations as $singleLocation){

        $collection_id = $this->getCollectionAreaWhereVendorLies($singleLocation, $vendorDetail);
            if($collection_id){
                break;
            }
        }

        if($collection_id){
            vendorDetail::where('user_id',$vendor_register->id)->update(['collection_id'=>$collection_id]);

            $label_marker_color = CollectionVendor::select('label_marker_color')
                                                    ->where('collection_id','=',$collection_id)
                                                    ->first();
            $vendorInserted = CollectionVendor::insertGetId([        
                    'collection_id' => $collection_id,          
                    'vendor_id'  => $vendor_register->id,
                    'label_marker_color' => $label_marker_color['label_marker_color']         
                ]);
        }

        $vendor_acc = new UserAccount();
        $vendor_acc->user_id = $vendor_register->id;
        $vendor_acc->role_id =6;
        $vendor_acc->userAccount = generateAccNumber();
        $vendor_acc->balance =0;        
        $vendor_acc->save();

        return redirect('vendor-detail/index');
    }


    public function agreementUpdate(Request $request, $id)
    {
        $updatedata = $request->validate([
            'decided_milkQuantity'=>'required|min:0|numeric',
            'morning_decided_milkQuantity'=>'required|min:0|numeric',
            'evening_decided_milkQuantity'=>'required|min:0|numeric',
            'decided_rate'=>'required|min:1|numeric', 
            'morningTime'=>'required',
            'eveningTime'=>'required', 
            
        ]);
        vendorDetail::where('user_id', $id)->update($updatedata);
        return redirect()->route('profile.user', [$id]);
    }

    public function bankDetailsUpdate(Request $request, $id)
    {
        $updatedata = $request->validate([
                'bank_name'=> 'required|min:1',
                'branch_name'=>'required|min:1',
                'branch_code'=>'required|min:1', 
                'acc_no'=>'required|min:1',
                'acc_title'=>'required|min:1',


        ]);
        bankDetail::where('user_id', $id)->update($updatedata);
        return redirect()->route('profile.user', [$id]);
    }


    public function vendorDashboard()
    {
        $Vid = Auth::id();


        $myMilkTransactions=DB::table('sub_tasks')
           ->select('sub_tasks.id','name','milkCollected','collectedTime','taskShift','totalSolid','qualityPic')
           ->where('vendor_id', $Vid)
           ->where('status', 'Complete')
           ->join('users','AssignTo','=','users.id')
           ->get();
        $saleMilk = SubTask::where('vendor_id', $Vid)->where('status', 'Complete')->sum('milkCollected');
        $decided_rate =  vendorDetail::select('decided_rate')
                                        ->where('user_id', $Vid)
                                        ->first();
        $todayMorningQuentity = SubTask::where('vendor_id', $Vid)
                                        ->where('status', 'Complete')
                                        ->where('taskShift', 'Morning')
                                        ->where('created_at','like', '%'.date('Y-m-d').'%')
                                        ->sum('milkCollected');
        $todayEveningQuentity = SubTask::where('vendor_id', $Vid)
                                        ->where('status', 'Complete')
                                        ->where('taskShift', 'Evening')            
                                        ->where('created_at','like', '%'.date('Y-m-d').'%')
                                        ->sum('milkCollected');
        $first_day_this_month  = date('Y-m-01');
        $current_day_this_month = date('Y-m-d');

        $periods = createDateRangeArray($first_day_this_month,$current_day_this_month);

        $MorningMilkDetail = '[';        
        $EveningMilkDetail = '[';        

        foreach($periods as $period){
            $MorningMilkqualityString = '';
            $MorningMilkqualityString .= '{date:'."'".$period."'".',';

            $EveningMilkqualityString = '';
            $EveningMilkqualityString .= '{date:'."'".$period."'".',';  

            $morningMilkQuality = SubTask::select('milkCollected','fat','Lactose','Ash','totalProteins','totalSolid')
                                    ->where('taskShift', 'Morning')
                                    ->where('vendor_id', $Vid)
                                    ->where('status', 'Complete')
                                    ->where('created_at', 'like', '%' . $period . '%')
                                    ->first();

            if(isset($morningMilkQuality)){
                $MorningMilkqualityString.= "'".'milkCollected'."':"."'".$morningMilkQuality->milkCollected."'".",";
                $MorningMilkqualityString.= "'".'fat'."':"."'".$morningMilkQuality->fat."'".",";
                $MorningMilkqualityString.= "'".'Lactose'."':"."'".$morningMilkQuality->Lactose."'".",";
                $MorningMilkqualityString.= "'".'Ash'."':"."'".$morningMilkQuality->Ash."'".",";
            }else{
                $MorningMilkqualityString.= "'".'milkCollected'."':"."'".'0'."'".",";
                $MorningMilkqualityString.= "'".'fat'."':"."'".'0'."'".",";
                $MorningMilkqualityString.= "'".'Lactose'."':"."'".'0'."'".",";
                $MorningMilkqualityString.= "'".'Ash'."':"."'".'0'."'".",";
            }
                         
            $newMorMilk='';
            $newMorMilk .= rtrim($MorningMilkqualityString, ","); 
            $newMorMilk .= '},';
            $MorningMilkDetail .= $newMorMilk; 


            $eveningMilkQuality = SubTask::select('milkCollected','fat','Lactose','Ash','totalProteins','totalSolid')
                                    ->where('taskShift', 'Evening')
                                    ->where('vendor_id', $Vid)
                                    ->where('status', 'Complete')
                                    ->where('created_at', 'like', '%' . $period . '%')
                                    ->first();

            if(isset($eveningMilkQuality)){
                $EveningMilkqualityString.= "'".'milkCollected'."':"."'".$eveningMilkQuality->milkCollected."'".",";
                $EveningMilkqualityString.= "'".'fat'."':"."'".$eveningMilkQuality->fat."'".",";
                $EveningMilkqualityString.= "'".'Lactose'."':"."'".$eveningMilkQuality->Lactose."'".",";
                $EveningMilkqualityString.= "'".'Ash'."':"."'".$eveningMilkQuality->Ash."'".",";
            }else{
                $EveningMilkqualityString.= "'".'milkCollected'."':"."'".'0'."'".",";
                $EveningMilkqualityString.= "'".'fat'."':"."'".'0'."'".",";
                $EveningMilkqualityString.= "'".'Lactose'."':"."'".'0'."'".",";
                $EveningMilkqualityString.= "'".'Ash'."':"."'".'0'."'".",";
            }
                         
            $newEveMilk='';
            $newEveMilk .= rtrim($EveningMilkqualityString, ","); 
            $newEveMilk .= '},';
            $EveningMilkDetail .= $newEveMilk;                     
        }        

        $MorningMilkDetail .= ']'; 

        $MorningMilkDetail = str_replace("},]","}]",$MorningMilkDetail); 

        $EveningMilkDetail .= ']'; 

        $EveningMilkDetail = str_replace("},]","}]",$EveningMilkDetail);

        return view('dashBoards/vendor', compact('saleMilk','myMilkTransactions','decided_rate','todayMorningQuentity','todayEveningQuentity','MorningMilkDetail','EveningMilkDetail'));

    }


    public function getCollectionAreaWhereVendorLies($collectionArea,$locationDetail){

        if (strpos($collectionArea['vendors_location'], 'POLYGON') !== false) {
           $AllLatLngs = substr($collectionArea['vendors_location'], 43, -5);
           $LatLngInArray = explode('],[', $AllLatLngs);
            $allLats = [];
            $allLngs = [];
            foreach($LatLngInArray as $item){
                $singleLatLng = explode(',', $item);
                array_push($allLats, $singleLatLng[0]);
                array_push($allLngs, $singleLatLng[1]);
            }
            $points_polygon = count($allLats);

            echo $locationDetail['latitude'].',  '.$locationDetail['longitude'];
            echo "<br>";
            
            if(isInPolygon($points_polygon,$allLats,$allLngs,$locationDetail['latitude'],$locationDetail['longitude'])){
                return ($collectionArea['id']) ? $collectionArea['id'] : false;
            }
            
        }
    }

}
 