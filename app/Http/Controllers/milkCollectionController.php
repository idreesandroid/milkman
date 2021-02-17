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


public function getCollectionManager()
{  
   //$collectionManagers = collectionPointManager::where('managerStatus','inActive')->get();
   $collectionManagers = DB::table('collection_point_managers')
   ->select('user_id','collectionPointId','managerStatus','name','users.id')
   ->where('managerStatus','inActive')
   ->join('users','user_id','=','users.id')
   ->get();

    //  echo "<pre>";
    //  print_r($collectionManagers);
    //  exit;
   return $collectionManagers;
}

public function assignCollectionManager(Request $request)
    {   
        $this->validate($request,[      
            'pId'=>   'required',
            'manager_id'=>'required',
         ]);

    //  echo "<pre>";
    //  print_r($request->all());
    //  exit;
    $var2= $request->pId;
    $var1= $request->manager_id;

    DB::update("UPDATE collection_point_managers SET collectionPointId = $var2 , managerStatus = 'Active' WHERE user_id = $var1");
    return redirect()->route('index.collectionPoint');
    }


    public function getAssetList()
    {  
       //$collectionManagers = collectionPointManager::where('managerStatus','inActive')->get();
       $assets = DB::table('milkman_assets')
       ->select('milkman_assets.id','assetCapacity','assetName','assetUnit','typeName')
       ->where('assignedPoint',null)
       ->where('user_id',null)
       ->join('assets_types','type_id','=','assets_types.id')
       ->get();
    
        //  echo "<pre>";
        //  print_r($assets);
        //  exit;
       return $assets;
    }

    public function setAssetList(Request $request)
    {     
        //    echo "<pre>";
        //    print_r($request->all());
        //    exit;
        $this->validate($request,[ 
            'pointId'       => 'required',        
            'select_asset'  => 'required', 
        ]);

        $asset_ids = $request['select_asset'];

        foreach($asset_ids as $index => $asset_id)
        {  
            DB::update("UPDATE milkman_assets SET `assignedPoint` =  $request->pointId WHERE id = $asset_id");  
        }
        return redirect()->route('index.collectionPoint');
    }







    public function myCollectors()
    {
    $CMid = Auth::id();
    $CPM = collectionPointManager::where('user_id',$CMid)->where('managerStatus','Active')->first();
    $CPIDs = $CPM->collectionPointId;

     $collectorDetails = DB::table('collector_details')
     ->select('user_id','collectionPoint_id','collectorMorStatus','collectorEveStatus','collectorCapacity','users.id','name','user_phone','filenames')
     ->where('collectionPoint_id', $CPIDs)
     ->join('users','user_id','=','users.id')
     ->get();
    //  echo "<pre>";
    //  print_r($collectorDetails);
    //  exit;   
     return view('collectionPoint/collectors', compact('collectorDetails'));
    }


    public function milkSubmission()
{  
   //$collectionManagers = collectionPointManager::where('managerStatus','inActive')->get();

   $CMid = Auth::id();
   $CPM = collectionPointManager::where('user_id',$CMid)->where('managerStatus','Active')->first();
   $CPIDs = $CPM->collectionPointId;

   $collectors = DB::table('collector_details')
   ->select('user_id','name')
   ->where('collectionPoint_id',$CPIDs)
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
   ->select('id','task_id','milkCollected','fat','lactose','Ash','totalProteins','totalSolid','status')
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
