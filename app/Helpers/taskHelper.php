<?php
use App\Models\vendorDetail;
use App\Models\SubTask;
use App\Models\Collection;
use App\Models\TaskArea;
use App\Models\collectorDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


function assignMorningTask()
    {       
       $Areas= TaskArea::where('shift', 'Morning')->get();
       foreach($Areas as $Area)
       {

        $vendorDetails = vendorDetail::where('morning_decided_milkQuantity', '>', 0)->where('collection_id', $Area->area_id)->get();
        foreach($vendorDetails as $vendorDetail)
        {
            $morningTask = new SubTask();
            $morningTask->vendor_id = $vendorDetail->user_id;        
            $morningTask->task_id = $Area->id;
            $morningTask->status = 'initialize';
            $morningTask->save();
        }

       }

       return ("Morning Task Initialized");
    }

    function assignEveningTask()
    {       
       $Areas= TaskArea::where('shift', 'Evening')->get();
       foreach($Areas as $Area)
       {

        $vendorDetails = vendorDetail::where('morning_decided_milkQuantity','>', 0)->where('collection_id', $Area->area_id)->get();
        foreach($vendorDetails as $vendorDetail)
        {
            $morningTask = new SubTask();
            $morningTask->vendor_id = $vendorDetail->user_id;        
            $morningTask->task_id = $Area->id;
            $morningTask->status = 'initialize';
            $morningTask->save();
        }

       }
       return ("Evening Task Initialized");
    }

