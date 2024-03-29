<?php
use App\Models\vendorDetail;
use App\Models\SubTask;
use App\Models\Collection;
use App\Models\TaskArea;
use App\Models\collectionPointManager;
use App\Models\collectorDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;


use Illuminate\Support\Facades\Auth;

function assignMorningTask()
    {       
       $Areas= TaskArea::where('shift','Morning')->where('taskAreaStatus','Active')->get();
       foreach($Areas as $Area)
       {   
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
       }
    // $time = Carbon::now();
    //    echo "<pre>";
    //    print_r(date("Y-m-d h:i:s"));
    //    print_r($time);
    //    exit;
       return ("Morning Task Initialized");
    }

    function assignEveningTask()
    {       
       $Areas= TaskArea::where('shift', 'Evening')->where('taskAreaStatus','Active')->get();
       foreach($Areas as $Area)
       {
        $vendorDetails = vendorDetail::where('evening_decided_milkQuantity','>', 0)->where('collection_id', $Area->area_id)->get();
        foreach($vendorDetails as $vendorDetail)
        {
            $eveningTask = new SubTask();
            $eveningTask->vendor_id = $vendorDetail->user_id;        
            $eveningTask->task_id = $Area->id;
            $eveningTask->status = 'initialize';
            $eveningTask->taskShift = 'Evening';
            $eveningTask->AssignTo = $Area->collector_id;
            $eveningTask->collection_date = date('Y-m-d h:s');
            $eveningTask->save();
        }
       }
       return ("Evening Task Initialized");
    }

    function calculateAreaMCapacity($id)
    {       
       $AreaMorningCapacities = vendorDetail::where('collection_id', $id)->select('morning_decided_milkQuantity')->get();
       foreach($AreaMorningCapacities as $AreaMorningCapacity)
       {
         $arrayMcapacity[]=$AreaMorningCapacity->morning_decided_milkQuantity;
         $MorningCapacity= array_sum($arrayMcapacity);
       }
       return $MorningCapacity;
    }

    function calculateAreaECapacity($id)
    {       
       $AreaEveningCapacities = vendorDetail::where('collection_id', $id)->select('evening_decided_milkQuantity')->get();
       foreach($AreaEveningCapacities as $AreaEveningCapacity)
       {
         $arrayMcapacity[]=$AreaEveningCapacity->evening_decided_milkQuantity;
         $EveningCapacity= array_sum($arrayMcapacity);
       }
       return $EveningCapacity;
    }


    function morningCollector($id,$type)
    {   
      // echo "<pre>";
      // print_r($id);
      // exit; 
      $tasks = DB::table('task_areas')
      ->select('collector_id')
      ->where('area_id', $id)
      ->where('shift', 'Morning')
      ->where('assignType', 'Permanent') 
      ->first();

      $collector = DB::table('collector_details')
      ->select('user_id','collectorCapacity','name')
      ->where('user_id', $tasks->collector_id)
      ->join('users','user_id','=','users.id')
      ->first();

      $result =''; 

      if($type == 'name')
      {
         $result = $collector->name;
      }

      elseif($type == 'capacity')
      {
         $result = $collector->collectorCapacity;
      }

      elseif($type == 'id')
      {
         $result = $collector->user_id;
      }
       return $result;
    }

    function eveningCollector($id,$type)
    {   
      $tasks = DB::table('task_areas')
      ->select('collector_id')
      ->where('area_id', $id)
      ->where('shift', 'Evening')
      ->where('assignType', 'Permanent') 
      ->first();
      // echo "<pre>";
      // print_r($tasks->collector_id);
      // exit;
      $collector = DB::table('collector_details')
      ->select('user_id','collectorCapacity','name')
      ->where('user_id', $tasks->collector_id)
      ->join('users','user_id','=','users.id')
      ->first();
      $result =''; 

      if($type == 'name')
      {
         $result = $collector->name;
      }

      elseif($type == 'capacity')
      {
         $result = $collector->collectorCapacity;
      }

      elseif($type == 'id')
      {
         $result = $collector->user_id;
      }
       return $result;
    }


    function checkpoint()
    {
            $CMid = Auth::id();
            $CPM = collectionPointManager::where('user_id',$CMid)->where('managerStatus','Active')->first();
            $CPIDs = $CPM->collectionPointId;
            // echo "<pre>";
            // print_r($CPIDs);
            //    exit;
            return $CPIDs;
    }
