<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\Collector;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Tasks;
use App\Models\User;
use App\Models\milkmanAsset;
use App\Models\assetsType;

class CollectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       

        $collectorDetails = User::whereHas('roles', function($query) {$query->where('roles.id', 5);})->get();   
        return view('collector-detail/index', compact('collectorDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        //     print_r($assetCount);
        //     print_r($assetCode);
        //     exit;

        $assets = milkmanAsset::where('collector_id', NULL)->get();
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
            DB::update("UPDATE milkman_assets SET collector_id = $collector_register->id  WHERE id	 = $userAsset");            
        } 

        return redirect()->route('index.collector-detail');
    }


    public function collectorDashboard()
    {
        $Cid = Auth::id();
     
     $totalTask = Tasks::where('collector_id' , $Cid)->count();

     $taskCompleted = Tasks::where('collector_id' , $Cid)->where('status' , 'Collected')->count();

     
     //$tasks=Tasks::where('collector_id', $Cid)->get();

     $tasks=DB::table('tasks')
     ->select('tasks.id','name','title','milk_amout','lactometer_reading','milk_taste','shift','duedate','duetime','starttime','endtime','tasks.status')
     ->where('tasks.collector_id', $Cid)
     ->join('users','vendor_id','=','users.id')
     ->join('collections','collection_id','=','collections.id')
     ->get();
           
    //  echo "<pre>";
    //  print_r($vendor);
    //  exit;
     
    //$tasks=Tasks::where('collector_id' , $Cid)->with('collectors')->get();
    $myMorningTask = Tasks::where('collector_id' , $Cid)->where('status', 'Not Started')->where('shift', 'morning')->count();
    $myEveningTask = Tasks::where('collector_id' , $Cid)->where('status', 'Not Started')->where('shift', 'evening')->count();
    return view('dashBoards/collector', compact('taskCompleted','totalTask','myMorningTask','myEveningTask','tasks'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collector  $collector
     * @return \Illuminate\Http\Response
     */
    public function show(Collector $collector)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collector  $collector
     * @return \Illuminate\Http\Response
     */
    public function edit(Collector $collector)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collector  $collector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collector $collector)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collector  $collector
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collector $collector)
    {
        //
    }
}
