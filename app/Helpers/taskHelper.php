<?php
use App\Models\vendorDetail;
use App\Models\SubTask;
use App\Models\Collection;
use App\Models\TaskArea;
use App\Models\collectorDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

function assignMorningTask()
    {       
       $Areas= TaskArea::where('shift','Morning')->get();
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
       $Areas= TaskArea::where('shift', 'Evening')->get();
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
            $eveningTask->collection_date = date('Y-m-d');
            $eveningTask->save();
        }

       }
       return ("Evening Task Initialized");
    }

