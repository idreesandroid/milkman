<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\User;
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
        $tasks = Tasks::select('tasks.*',                                
                                'vn.name AS vendor_name',
                                'cn.name AS collector_name')
                    ->leftJoin('users AS vn', 'vn.id', '=', 'tasks.vendor_id')
                    ->leftJoin('users AS cn','cn.id','=','tasks.collector_id')                    
                    ->get();
        $collectors = User::select('users.*')
                    ->join('role_user', 'role_user.user_id', '=', 'users.id')
                    ->where('role_user.role_id', '=', 5)
                    ->get();

        $vendors = User::select('users.*')
                    ->join('role_user', 'role_user.user_id', '=', 'users.id')
                    ->where('role_user.role_id', '=', 6)
                    ->get(); 
                   
        return view('task/listing',compact('tasks','collectors','vendors'));
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
        //$task = Tasks::find($request->id);
        $task = Tasks::select('tasks.*',                                
                                'vn.name AS vendor_name',
                                'cn.name AS collector_name','cn.filenames')
                    ->join('users AS vn', 'vn.id', '=', 'tasks.vendor_id')
                    ->join('users AS cn','cn.id','=','tasks.collector_id')
                    ->where('tasks.id','=',$request->id)                 
                    ->first();
        return $task;
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
}
