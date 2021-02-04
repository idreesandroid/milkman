<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use App\Models\Collector;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Tasks;
use App\Models\User;
use App\Models\milkmanAsset;
use App\Models\assetsType;
use App\Models\TaskArea;
use App\Models\SubTask;
use App\Models\collectorDetail;

class CollectorController extends Controller
{
   
    public function index()
    {
       

        $collectorDetails = User::whereHas('roles', function($query) {$query->where('roles.id', 5);})->get();   
        return view('collector-detail/index', compact('collectorDetails'));
    }

 
    public function create()
    {
        // $assetTypes = assetsType::get();
        // foreach($assetTypes as $assetType)
        // {
        // $typeId=$assetType->id;
            
        // $assets = milkmanAsset::where('type_id',$typeId)->where('collector_id', NULL)->get();
        // foreach($assets as $index => $asset)
        // {  
        // $assetCode [] = $assets[$index]->assetCode;
        // $assetCount[] = $typeId;
        // }
        // }
        //     echo "<pre>";
        //     print_r($assetCode);
        //     exit;

        $assets = milkmanAsset::where('user_id', NULL)->get();
        return view('collector-detail/create', compact('assets'));
    }

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
            'userAsset'=>'required',
        ]);

        $collector_register = new User();
        $collector_register->name = $request->name;        
        $collector_register->email = $request->email;
        $collector_register->password = Hash::make($request->password);
        $collector_register->user_cnic = $request->user_cnic;
        $collector_register->user_phone = $request->user_phone;
        $collector_register->state = $request->state;
        $collector_register->city = $request->city;
        $collector_register->user_address = $request->user_address;
        
        if($request->hasfile('filenames')) { 
            $name =  time().'.'.$request->file('filenames')->extension();
            $request->file('filenames')->move(public_path().'/UserProfile/', $name);  
            $data = $name; 
    }          
        $collector_register->filenames=$data;
        $collector_register->save();
        $collector_register->roles()->attach(Role::where('id',5)->first());

        $userAssets = $request['userAsset'];
        
        foreach($userAssets as $userAsset)
        {
            DB::update("UPDATE milkman_assets SET user_id = $collector_register->id  WHERE id	 = $userAsset");            
        } 

        $collectorCaps = milkmanAsset::where('user_id' , $collector_register->id)->where('type_id' , 2)->get();
        foreach($collectorCaps as $collectorCap)
        {
        $collectorcap[]=$collectorCap->assetCapacity;
        }
        $collectorcap1=array_sum($collectorcap);

            // echo "<pre>";
            // print_r($assetCode);
            // exit;

        $collector_detail = new collectorDetail();
        $collector_detail->user_id = $collector_register->id;        
        $collector_detail->collectorCapacity = $collectorcap1;
        $collector_detail->collectorStatus = 'Free';
        $collector_detail->save();


        return redirect()->route('index.collector-detail');
    }


    public function collectorDashboard()
    {
        $Cid = Auth::id();
     
     $totalTask = SubTask::where('AssignTo' , $Cid)->count();
     $taskCompleted = SubTask::where('AssignTo' , $Cid)->where('status','Complete')->count();
    
    $today=date('Y-m-d');
    $newTasks = DB::table('sub_tasks')
    ->select('sub_tasks.id','status','taskShift','morning_decided_milkQuantity','evening_decided_milkQuantity','morningTime','eveningTime','name','vendor_details.longitude','vendor_details.latitude')
    ->where('sub_tasks.AssignTo', $Cid)
    ->where('status','<>','Expired')
    ->where('status','<>','Complete')
    ->where('sub_tasks.collection_date', $today)
    ->join('vendor_details','vendor_id','=','vendor_details.user_id')
    ->join('users','vendor_id','=','users.id')
    ->get();

    //  echo "<pre>";
    //  print_r($newTasks);
    //  exit;
      
    //$myMorningTask = SubTask::where('AssignTo' , $Cid)->where('status', 'Not Started')->where('shift', 'morning')->count();
    //$myEveningTask = SubTask::where('AssignTo' , $Cid)->where('status', 'Not Started')->where('shift', 'evening')->count();
    return view('dashBoards/collector', compact('taskCompleted','totalTask','newTasks'));
    
    }

    public function MyTask()
    { 
        //$taskDetails = SubTask::where('task_id', $id)->with('vendorAsTask')->get();
        $Cid = Auth::id();
        $taskDetails = SubTask::select('sub_tasks.*','name')
        ->join('users', 'sub_tasks.vendor_id', '=', 'users.id')
        ->where('AssignTo', $Cid)
        ->orderBy('collection_date', "DESC")
        ->get();
        return view('collector-detail/myTaskDetails', compact('taskDetails'));
    }


 
    public function show(Collector $collector)
    {
        //
    }


    public function edit(Collector $collector)
    {
        //
    }


    public function update(Request $request, Collector $collector)
    {
        //
    }

 
    public function destroy(Collector $collector)
    {
        //
    }
}
