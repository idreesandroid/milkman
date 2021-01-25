<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Collector;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Tasks;

class CollectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('id', '!=',  '6')->where('id', '!=',  '3')->select('name','id')->orderBy('id', 'ASC')->get();
        return view('collector-detail/create',compact('roles'));
    }

    public function collectorDashboard()
    {
        $Cid = Auth::id();
     $totalTask = Tasks::where('collector_id' , $Cid)->count();
     $taskCompleted = Tasks::where('collector_id' , $Cid)->where('status' , 'Collected')->count();
    //  echo "<pre>";
    //  print_r($taskCompleted);
    //  exit;
    return view('dashBoards/collector', compact('taskCompleted','totalTask'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

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
