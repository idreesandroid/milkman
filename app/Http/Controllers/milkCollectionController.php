<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\milkCollectionPoint;
use App\Models\Collection;
use App\Models\User;
use App\Models\TaskArea;
use App\Models\collectorDetail;
use App\Models\collectionPointManager;
use App\Models\milkmanAsset;
class milkCollectionController extends Controller
{
    public function index()
    {  
        // $collectionPoints=DB::table('milk_collection_points')
        // ->select('milk_collection_points.id','pointName','pointAddress')
        // ->get();
     $collectionPoints = DB::table('milk_collection_points')
     ->select('milk_collection_points.id','pointName','pointAddress','collectionPointId')
     ->leftJoin('collection_point_managers','milk_collection_points.id','=','collection_point_managers.collectionPointId')
     ->get();

    //  echo "<pre>";
    //  print_r($collectionPoints);
    //  exit;
       return view('collectionPoint/index', compact('collectionPoints'));
    }

    public function create() 
    {       
        return view('collectionPoint/create');
    }

    public function store(Request $request)
    {    
        $this->validate($request,[      
            'point_name'=>   'required',
            'point_address'=>'required',
         ]);     
        $points = new milkCollectionPoint();
        $points->pointName = $request->point_name;        
        $points->pointAddress = $request->point_address;
        $points->save();
        return redirect()->route('index.collectionPoint');
    }

    public function edit($id)
    {
        $points = milkCollectionPoint::findOrFail($id);
        return view('collectionPoint/edit', compact('points'));
    }

    public function update(Request $request, $id)
    {
        $updatedata = $request->validate([
            'pointName'=> 'required',
            'pointAddress'=>'required', 
        ]);

        milkCollectionPoint::whereid($id)->update($updatedata);
        return redirect()->route('index.collectionPoint');
    }
    
    public function deleteCollectionPoint($id)
    {
        $points = milkCollectionPoint::findOrFail($id);
        $points->delete();
        return redirect()->route('index.collectionPoint');
    }

//collectionsAtCollection point-----------------------------------------------------------


    public function milkSubmission()
{  
   $collectors = DB::table('collector_details')
   ->select('user_id','name')
   ->where('collectionPoint_id', checkpoint())
   ->join('users','user_id','=','users.id')
   ->get();

//    $collections = DB::table('collections')
//    ->select('id','title')
//    ->where('collectionPoint_id',$CPIDs)
//    ->get();

    //  echo "<pre>";
    //  print_r($collectionManagers);
    //  exit;

    return view('collectionPoint/milkSubmission', compact('collectors'));
}


public function collectorCollections($id)
{  

    // echo "<pre>";
    // print_r($id);
    // exit;

   //$collectionManagers = collectionPointManager::where('managerStatus','inActive')->get();

//    $CMid = Auth::id();
//    $CPM = collectionPointManager::where('user_id',$CMid)->where('managerStatus','Active')->first();
//    $CPIDs = $CPM->collectionPointId;

//    $collectors = DB::table('collector_details')
//    ->select('user_id','name')
//    ->where('collectionPoint_id',$CPIDs)
//    ->join('users','user_id','=','users.id')
//    ->get();

   $today=date('Y-m-d'); 
   $collections = DB::table('sub_tasks')
   ->select('id','task_id','milkCollected','fat','lactose','Ash','totalProteins','totalSolid','status','vendor_id','taskShift','collectedTime')
   ->where('assignTo',$id)
   ->where('status','<>','Submitted')
   ->where('collection_date', $today)
   ->get();
   
    //  echo "<pre>";
    //  print_r($collections);
    //  exit;

     return json_encode($collections);
}

}
