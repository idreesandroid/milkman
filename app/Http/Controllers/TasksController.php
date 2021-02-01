<?php

namespace App\Http\Controllers;

use App\Models\vendorDetail;
use App\Models\Tasks;
use App\Models\User;
use App\Models\Collection;
use App\Models\TaskArea;
use App\Models\collectorDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function edit(Tasks $tasks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tasks $tasks, Request $request)
    {
        $taskDeleted = Tasks::where('id',$request->id)->delete();
        return ($taskDeleted) ? true : false;
    }

    /**
     * To start a task.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
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
     $vendorsCapacities = vendorDetail::where('collection_id', $id)->get();
     if($shift == 'Morning')
     {
        foreach($vendorsCapacities as $vendorsCapacity)
            {
                $vendorCap[] = $vendorsCapacity->morning_decided_milkQuantity;
            }
            $areaCapacity= array_sum($vendorCap);
     }  
     elseif($shift == 'Evening')
     {
        foreach($vendorsCapacities as $vendorsCapacity)
        {
         $vendorCap[] = $vendorsCapacity->evening_decided_milkQuantity;
        }
        $areaCapacity= array_sum($vendorCap); 
     }

    $collectorCapacities = collectorDetail::where('collectorStatus','Free')->get();
    $recommendedCollector = array();
    foreach($collectorCapacities as $collector)
    {
        $collectorCap = $collector->collectorCapacity;
        if($areaCapacity < $collectorCap && $collectorCap <= $areaCapacity+100)
        {
           $recommendedCollector[]=DB::table('collector_details')
           ->select('users.id','name','user_phone','collectorCapacity')
           ->where('collector_details.user_id', $collector->user_id)
           ->join('users','user_id','=','users.id')
           ->first();
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
        $select_collector->save();

    }


}
