<?php

namespace App\Http\Controllers;

use App\Models\vendorDetail;
use App\Models\Tasks;
use App\Models\User;
use App\Models\Collection;
use App\Models\TaskArea;
use App\Models\SubTask;
use App\Models\collectorDetail;
use App\Models\UserAccount;
use App\Models\collectionPointManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        // $tasks = Tasks::select('tasks.*','tasks.collection_id',                            
        //                         'vn.name AS vendor_name',
        //                         'cn.name AS collector_name','cln.title')
        //             ->leftJoin('users AS vn', 'vn.id', '=', 'tasks.vendor_id')
        //             ->leftJoin('users AS cn','cn.id','=','tasks.collector_id')
        //             ->rightJoin('collections AS cln','cln.id','=','tasks.collection_id')
        //             ->get();

        //dd($tasks);

        $tasks = Collection::select('collections.*','cn.name AS collector_name')
                    ->where('collections.collector_id','!=',0)
                    ->leftJoin('users AS cn','cn.id','=','collections.collector_id')
                    ->get();
        $collectors = User::select('users.*')
                    ->join('role_user', 'role_user.user_id', '=', 'users.id')
                    ->where('role_user.role_id', '=', 5)
                    ->get();

        $vendors = User::select('users.*')
                    ->join('role_user', 'role_user.user_id', '=', 'users.id')
                    ->where('role_user.role_id', '=', 6)
                    ->get(); 

        $collections = Collection::all();


        return view('task/listing',compact('tasks','collectors','vendors','collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $taskID = Tasks::insertGetId([       
                'vendor_id' => $request->vendor_id,          
                'collector_id'  => $request->collector_id,           
                'collection_id'  => $request->collectionID,           
                'duedate'  => $request->duedate,           
                'duetime'  => $request->duetime,           
                'shift'  => $request->shift,           
                'priority'  => $request->priority,
                'status' => 'Not Started'          
            ]);
        return ($taskID) ? true : false;         
    }

   
    public function show(Request $request)
    {
        $tasks = Tasks::select('tasks.*',                                
                                'vn.name AS vendor_name',
                                'cn.name AS collector_name','cn.filenames')
                    ->join('users AS vn', 'vn.id', '=', 'tasks.vendor_id')
                    ->join('users AS cn','cn.id','=','tasks.collector_id')
                    ->where('tasks.collection_id','=',$request->id)                 
                    ->get();
        return view('task/detail', compact('tasks'));
    }


    public function edit(Tasks $tasks)
    {
        //
    }


    public function update(Request $request)
    {
        date_default_timezone_set("Asia/Karachi");
        Tasks::where('id','=',$request->taskId)->update([
            'milk_amout' => $request->milkAmout,
            'lactometer_reading' => $request->lactometerReading,
            'milk_taste' => $request->milkTaste,
            'endtime' => date('Y-m-d H:i:s'),
            'status' => 'Collected'
        ]);        
    }

    public function destroy(Tasks $tasks, Request $request)
    {
        $taskDeleted = Tasks::where('id',$request->id)->delete();
        return ($taskDeleted) ? true : false;
    }


    public function start(Request $request)
    {
        date_default_timezone_set("Asia/Karachi");
        Tasks::where('id', $request->id)->update([
            'starttime' => date('Y-m-d H:i:s'),
            'status' => 'Started'
        ]);
        return true;
        
    }

// Asim work on Task as---------------------------------------------------------------


public function AssignArea($shift , $id)
    {   
        $vendorCap =  array();
        $recommendedCollector = array();
     $vendorsCapacities = vendorDetail::where('collection_id', $id)->get();
     if($shift == 'Morning')
     {
        foreach($vendorsCapacities as $vendorsCapacity)
            {
                $vendorCap[] = $vendorsCapacity->morning_decided_milkQuantity;
            }
            $areaCapacity= array_sum($vendorCap);
            // find Morning collector------------------------
        $collectorCapacities = collectorDetail::where('collectorMorStatus','Free')->get();
        foreach($collectorCapacities as $collector)
        {
            $collectorCap = $collector->collectorCapacity;
            if($areaCapacity < $collectorCap)
            {
               $recommendedCollector[]=DB::table('collector_details')
               ->select('users.id','name','user_phone','collectorCapacity')
               ->where('collector_details.user_id', $collector->user_id)
               ->join('users','user_id','=','users.id')
               ->first();
            }     
        }
     }  
     elseif($shift == 'Evening')
     {
        foreach($vendorsCapacities as $vendorsCapacity)
        {
         $vendorCap[] = $vendorsCapacity->evening_decided_milkQuantity;
        }
        $areaCapacity= array_sum($vendorCap);
        // find Evening collector------------------------
        $collectorCapacities = collectorDetail::where('collectorEveStatus','Free')->get();
        foreach($collectorCapacities as $collector)
        {
        $collectorCap = $collector->collectorCapacity;
         if($areaCapacity < $collectorCap )
            {
           $recommendedCollector[]=DB::table('collector_details')
           ->select('users.id','name','user_phone','collectorCapacity')
           ->where('collector_details.user_id', $collector->user_id)
           ->join('users','user_id','=','users.id')
           ->first();
            }     
        }
     }

    
    // echo "<pre>";
    // print_r($recommendedCollector);
    // exit;
     return json_encode($recommendedCollector);
     //return response()->json([$recommendedCollector]);
    }


    public function selectCollector(Request $request)
    {
        
        $this->validate($request,[        
            'cArea'      => 'required', 
            'cShift'     => 'required',         
            'select_collector'  => 'required',
        ]);

        $select_collector = new TaskArea();
        $select_collector->area_id = $request->cArea;        
        $select_collector->shift = $request->cShift;
        $select_collector->collector_id = $request->select_collector;
        $select_collector->assignType = 'Permanent';
        $select_collector->taskAreaStatus = 'Active';
        $select_collector->save();

        if($request->cShift == 'Morning')
        {
            $assign = DB::update("UPDATE collector_details SET `collectorMorStatus` = 'Have Task'  WHERE user_id = '$request->select_collector'");
            $areaAssignStatus = DB::update("UPDATE collections SET `AFM` = 1  WHERE id = '$request->cArea'");
        }
        elseif($request->cShift == 'Evening')
        {
            $assign = DB::update("UPDATE collector_details SET `collectorEveStatus` = 'Have Task'  WHERE user_id = '$request->select_collector'");
            $areaAssignStatus = DB::update("UPDATE collections SET `AFE` = 1  WHERE id = '$request->cArea'");
        }

        return redirect()->route('index.collection');
    } 


    public function ReselectCollector(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // exit;

        $this->validate($request,[        
            'reArea'      => 'required', 
            'reShift'     => 'required',         
            'reselect_collector'  => 'required',
        ]);

        $area = $request->reArea;
        $shift = $request->reShift;
        $collector = $request->reselect_collector;
    // echo "<pre>";
    // print_r($collector);
    // exit;

        DB::update("UPDATE task_areas SET `collector_id` = $collector  WHERE area_id = $area and  shift = '$shift'");
       
        if($request->reShift == 'Morning')
        {
            DB::update("UPDATE collector_details SET `collectorMorStatus` = 'Have Task'  WHERE user_id = '$collector'");
            DB::update("UPDATE collections SET `AFM` = 1  WHERE id = '$area'");
        }
        elseif($request->reShift == 'Evening')
        {
            DB::update("UPDATE collector_details SET `collectorEveStatus` = 'Have Task'  WHERE user_id = '$collector'");
            DB::update("UPDATE collections SET `AFE` = 1  WHERE id = '$area'");
        }
        
        return redirect()->route('index.collection');
    } 

    public function startTask($id)
    {
        DB::update("UPDATE sub_tasks SET `status` = 'inProcess'  WHERE id = '$id'");
        return redirect()->route('user.dashBoard');
    }


    public function completeTask(Request $request)
    {
        $this->validate($request,[ 
            'req_id'             => 'required',        
            'milkCollected'      => 'required', 
            'fat'                => 'required',         
            'Lactose'            => 'required',
            'Ash'                => 'required', 
            'totalProteins'      => 'required',         
            'qualityPic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

      
        $id=$request->req_id;
        
        $currentTime = date('Y-m-d h:m');
        $select_collector = SubTask::find($id);

        $select_collector->milkCollected = $request->milkCollected;        
        $select_collector->fat = $request->fat;
        $select_collector->Lactose = $request->Lactose;        
        $select_collector->Ash = $request->Ash;        
        $select_collector->totalProteins = $request->totalProteins;
        $select_collector->totalSolid = $request->totalProteins + $request->Ash + $request->Lactose + $request->fat;
        $select_collector->collectedTime = $currentTime;

        $imageName = time().'.'.$request->qualityPic->extension();    
        $request->qualityPic->move(public_path('milkQuality_img'), $imageName);
        $select_collector->qualityPic = $imageName;        
        $select_collector->status = 'Complete';
        $select_collector->save();

        $findVendors = SubTask::where('id', $id)->where('status','Complete')->select('vendor_id')->first();
        $vendorIs= $findVendors['vendor_id'];

        $findBalances = UserAccount::where('user_id', $vendorIs)->select('balance')->first();
        $findDecidedRate = vendorDetail::where('user_id', $vendorIs)->select('decided_rate')->first();


        $decidedRate=$findDecidedRate['decided_rate'];
        $preBalance = $findBalances['balance'];
        $newBalance = $preBalance+($decidedRate*$request->milkCollected);
        // echo "<pre>";
        // print_r($newBalance);
        // exit;
        $addBalance = DB::update("UPDATE user_accounts SET `balance` = $newBalance  WHERE user_id = '$vendorIs'");
        return redirect()->route('user.dashBoard');
    } 


    public function TaskArea()
    {   
        $arrangedArray = array();
        $areaTasks=DB::table('task_areas')
           ->select('task_areas.id','name','title','shift')
           ->join('collections','area_id','=','collections.id')
           ->join('users','task_areas.collector_id','=','users.id')
           ->orderBy('id', 'DESC')
           ->get();
     
           foreach($areaTasks as $areaTask)
          {
             $areaIds = $areaTask->id;
             $areaTitle = $areaTask->title;
             $areaShift = $areaTask->shift;
             $areaCollector = $areaTask->name;

             $taskComplete = SubTask::where('status', 'complete')->where('task_id',$areaIds)->select('milkCollected')->count();
             $taskExpired = SubTask::where('status', 'Expired')->where('task_id',$areaIds)->select('milkCollected')->count();
             $areaCollections = SubTask::where('task_id',$areaIds)->where('taskShift',$areaShift)->select('milkCollected')->get();
               foreach($areaCollections as $areaCollection)
               {
                $arrayMilk[] = $areaCollection->milkCollected;
                $totalCollection=array_sum($arrayMilk);
               }
               $arrangedArray[] = array(
                   'id' => $areaIds,
                   'areaTitle' => $areaTitle,
                   'collectorName' => $areaCollector,
                   'areashift' => $areaShift,
                   'taskCo' => $taskComplete,
                   'taskEx' => $taskExpired,
               );
          }
     
    //echo "<pre>";
    // print_r($arrangedArray);
     //exit;

    return view('task/AreaTask', compact('arrangedArray'));
    }

    public function TaskAreaDetails($id)
    { 
        $taskDetails = SubTask::select('sub_tasks.*','name')
        ->join('users', 'sub_tasks.vendor_id', '=', 'users.id')
        ->where('task_id', $id)
        ->get();
        return view('task/taskAreaDetails', compact('taskDetails'));
    }

    public function GenerateMorningTask()
    { 
        $roleArray= auth()->user()->roles()->pluck('roles.id')->toArray();
        if(in_array(2, $roleArray))
        {
            $evening_tasks= array();
            $morning_tasks= array();
        $Cid = Auth::id();
        $CPM = collectionPointManager::where('user_id',$Cid)->where('managerStatus','Active')->first();
       
        // echo "<pre>";
        // print_r($CPM->collectionPointId);
        // exit;
            if(!empty($CPM))
            {
        $CPIDs = Collection::where('collectionPoint_id', $CPM->collectionPointId)->get();
        
        foreach($CPIDs as $CPID)
        {
        $morning_tasks[] = DB::table('task_areas')
        ->select('task_areas.id','shift','area_id','task_areas.collector_id','assignType','taskAreaStatus','assignFrom','assignTill','reasonForAssignTemporary','name','title')
        ->where('shift','Morning')
        ->where('taskAreaStatus','Active')
        ->where('area_id',$CPID->id)
        ->leftJoin('users','collector_id','=','users.id')
        ->Join('collections','area_id','=','collections.id')
        ->first();
        }
        foreach($CPIDs as $CPID)
        {
        $evening_tasks[] = DB::table('task_areas')
        ->select('task_areas.id','shift','area_id','task_areas.collector_id','assignType','taskAreaStatus','assignFrom','assignTill','reasonForAssignTemporary','name','title')
        ->where('shift','Evening')
        ->where('taskAreaStatus','Active')
        ->where('area_id',$CPID->id)
        ->leftJoin('users','collector_id','=','users.id')
        ->Join('collections','area_id','=','collections.id')
        ->first();
        }
         
        $eveningTasks=array_filter($evening_tasks);
        $morningTasks=array_filter($morning_tasks);
      
        return view('task.generateTask', compact('morningTasks','eveningTasks'));
        }
    else {return "sorry you have not collection point";}
    
    }

    }

    public function StoreMorningTask(Request $request)
    { 
     if($request->input('morTask'))
     {
        $morning_tasks = $request['morTask'];

         foreach($morning_tasks as $morning_task)
            {
                $Area = TaskArea::where('id',$morning_task)->first();

                $vendorDetails = vendorDetail::where('morning_decided_milkQuantity', '>', 0)->where('collection_id', $Area->area_id)->get();
                foreach($vendorDetails as $vendorDetail)
                {
                    $morningTask = new SubTask();
                    $morningTask->vendor_id = $vendorDetail->user_id;        
                    $morningTask->task_id = $Area->id;
                    $morningTask->status = 'initialize';
                    $morningTask->taskShift = 'Morning';
                    $morningTask->AssignTo = $Area->collector_id;
                    $morningTask->collection_date = date('Y-m-d');
                    $morningTask->save();
                }

                // echo "<pre>";
                // print_r($morning_task);   
            }
                //exit;
     }
     //return ("ok");
     return redirect()->route('user.dashBoard');
    }



    public function StoreEveningTask(Request $request)
    { 
        if($request->input('eveTask'))
     {
        $morning_tasks = $request['eveTask'];

         foreach($morning_tasks as $morning_task)
            {
                $Area = TaskArea::where('id',$morning_task)->first();

                $vendorDetails = vendorDetail::where('evening_decided_milkQuantity','>', 0)->where('collection_id', $Area->area_id)->get();
                foreach($vendorDetails as $vendorDetail)
                {
                    $morningTask = new SubTask();
                    $morningTask->vendor_id = $vendorDetail->user_id;        
                    $morningTask->task_id = $Area->id;
                    $morningTask->status = 'initialize';
                    $morningTask->taskShift = 'Evening';
                    $morningTask->AssignTo = $Area->collector_id;
                    $morningTask->collection_date = date('Y-m-d');
                    $morningTask->save();
                }

                // echo "<pre>";
                // print_r($morning_task);   
            }
                //exit;

                //return ("ok");
     }
    
     return redirect()->route('user.dashBoard');
    }

    public function ExpireMorningTask()
    { 
        $findTasks = SubTask::where('status','initialize')->where('taskShift','Morning')->get();
        foreach($findTasks as $findTask)
        {
            $var = $findTask->id;
            //  echo "<pre>";
            // print_r($var);
            // exit;
            DB::update("UPDATE sub_tasks SET `status` = 'Expired'  WHERE id = '$var'"); 
        }
    }

    public function ExpireEveningTask()
    { 
        $findTasks = SubTask::where('status','initialize')->where('taskShift','Evening')->get();
        foreach($findTasks as $findTask)
        {
            $var = $findTask->id;
            DB::update("UPDATE sub_tasks SET `status` = 'Expired'  WHERE id = '$var'"); 
        }
    }

    public function assignTemporaryTask($id)
    { 
        $findTasks = TaskArea::select('collections.id','collections.title','task_areas.id','task_areas.shift','task_areas.collector_id','users.name','users.id','area_id')
        ->join('collections','task_areas.area_id','=','collections.id')
        ->join('users','task_areas.collector_id', '=', 'users.id')
        ->where('task_areas.collector_id', $id)
        ->where('assignType', 'Permanent')
        ->get();

        //    echo "<pre>";
        //    print_r($findTasks);
        //    exit;
        
        $morningCollectors = collectorDetail::select('collectorMorStatus','collectorEveStatus','collectorCapacity','users.name','users.id')
        ->join('users','collector_details.user_id', '=', 'users.id')
        ->where('collector_details.collectorMorStatus', 'Free')
        ->get();

        $eveningCollectors = collectorDetail::select('collectorMorStatus','collectorEveStatus','collectorCapacity','users.name','users.id')
        ->join('users','collector_details.user_id', '=', 'users.id')
        ->where('collector_details.collectorEveStatus', 'Free')
        ->get();
        
        return view('task/assignTemporaryTask', compact('findTasks','morningCollectors','eveningCollectors'));
    }

    public function StoreTemporaryTask(Request $request)
    {     
        //    echo "<pre>";
        //    print_r($request->all());
        //    exit;
        $this->validate($request,[ 
            'area_id'            => 'required',        
            'collector'          => 'required', 
            'fromDate'           => 'required',         
            'endDate'            => 'required',
            'new_collector_id'   => 'required', 
        ]);


        $task_area_ids = $request['area_id'];
        $task_collector_ids = $request['collector'];
        $task_from_date = $request['fromDate'];
        $task_end_date = $request['endDate'];
        $task_new_collectorId = $request['new_collector_id'];
        $task_shifts = $request['shifts'];

        foreach($task_area_ids as $index => $task_area_id)
        {
            DB::update("UPDATE task_areas SET `taskAreaStatus` = 'InActive'  WHERE area_id = $task_area_id AND collector_id = $task_collector_ids[$index] AND assignType = 'Permanent'");  
       
            $taskArea = new TaskArea();
            $taskArea->area_id = $task_area_ids[$index];
            $taskArea->collector_id = $task_new_collectorId[$index];
            $taskArea->assignType = 'Temporary';
            $taskArea->taskAreaStatus = 'Active';
            $taskArea->assignFrom = $task_from_date[$index];
            $taskArea->assignTill = $task_end_date[$index];
            $taskArea->shift = $task_shifts[$index];
            $taskArea->reasonForAssignTemporary = 'no Reason';  
            $taskArea->save();
        }
        return redirect()->route('user.dashBoard');
    }

    public function Activate($id)
    { 
        $findTasks = TaskArea::where('collector_id', $id)->where('assignType','permanent')->get();
        foreach($findTasks as $findTask)
        {
            DB::update("UPDATE task_areas SET `taskAreaStatus` = 'Active'  WHERE area_id = $findTask->area_id AND collector_id = $id AND assignType = 'Permanent'"); 
            DB::update("UPDATE task_areas SET `taskAreaStatus` = 'Blocked' WHERE area_id = $findTask->area_id AND assignType = 'Temporary'"); 
        }
        return redirect()->route('user.dashBoard');
    }


    
}
