<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\milkCollectionPoint;
use App\Models\Collection;
use App\Models\User;
use App\Models\TaskArea;
use App\Models\collectorDetail;
use App\Models\collectionPointManager;
use App\Models\milkmanAsset;

class CollectionManagerController extends Controller
{

    public function collectionManagerDashboard()
    {
        return view('dashBoards.collection-manager');
    }


    public function getCollectionManager()
{  
   $collectionManagers = DB::table('collection_point_managers')
   ->select('user_id','collectionPointId','managerStatus','name','users.id','user_phone','pointName')
   ->where('managerStatus','inActive')
   ->join('users','user_id','=','users.id')
   ->leftjoin('milk_collection_points','collectionPointId','=','milk_collection_points.id')
   ->get();
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


    public function getAssetList($id)
    {  
       $assets = DB::table('milkman_assets')
       ->select('milkman_assets.id','assetCapacity','assetName','assetUnit','typeName','assignedPoint')
       ->where('assignedPoint',null)    
       ->where('user_id',null)
       ->orWhere('assignedPoint',$id)
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
        ]);

        $point=$request->pointId;

        $assetsList = milkmanAsset::where('assignedPoint', $point)->get();
        foreach($assetsList as $assetList)
        {
            DB::update("UPDATE milkman_assets SET `assignedPoint` = null WHERE `id` = $assetList->id");
        }

        if($request->input('select_asset'))
        {
        $asset_ids = $request['select_asset'];

        foreach($asset_ids as $index => $asset_id)
        {  
            DB::update("UPDATE milkman_assets SET `assignedPoint` =  $request->pointId WHERE `id` = $asset_id");  
        }
        }
        return redirect()->route('index.collectionPoint');
    }


    public function getPointAsset($id)
    {  
       $point = checkpoint();
       $assets = DB::table('milkman_assets')
       ->select('milkman_assets.id','assetCapacity','assetName','assetUnit','typeName','user_id')
       ->where('assignedPoint', $point)
       ->where('user_id',null)
       ->orWhere('user_id',$id)
       ->join('assets_types','type_id','=','assets_types.id')
       ->get();
        //  echo "<pre>";
        //  print_r($assets);
        //  exit;
       return $assets;
    }

    public function setCollectorAsset(Request $request)
    {     
   
        $this->validate($request,[ 
            'collectorId'       => 'required', 
        ]);

            $TempCid=$request->collectorId;

        $assetsList = milkmanAsset::where('user_id', $TempCid)->get();

        foreach($assetsList as $assetList)
        {
            DB::update("UPDATE milkman_assets SET `user_id` = null WHERE `id` = $assetList->id");
        }
            DB::update("UPDATE collector_details SET `collectorCapacity` =  null WHERE `user_id` = $TempCid");

        // echo "<pre>";
        // print_r($assets1);
        // exit;
        if($request->input('select_asset'))
        {
        $asset_ids = $request['select_asset'];

        foreach($asset_ids as $index => $asset_id)
        {  
            DB::update("UPDATE milkman_assets SET `user_id` =  $request->collectorId WHERE id = $asset_id");  
        }
        }
        $collectorCaps = milkmanAsset::where('user_id' , $request->collectorId)->where('type_id' , 2)->get();
        
        $collectorcap = array();
        foreach($collectorCaps as $collectorCap)
        {
        $collectorcap[]=$collectorCap->assetCapacity;
        }
        $collectorcap1=array_sum($collectorcap);

        DB::update("UPDATE collector_details SET `collectorCapacity` =  $collectorcap1 WHERE user_id = $request->collectorId");

        return redirect()->route('my.collectors');
    }

    public function myCollectors()
    {
     $collectorDetails = DB::table('collector_details')
     ->select('user_id','collectionPoint_id','collectorMorStatus','collectorEveStatus','collectorCapacity','users.id','name','user_phone','filenames')
     ->where('collectionPoint_id', checkpoint()) //function in helper function
     ->join('users','user_id','=','users.id')
     ->get();
    //  echo "<pre>";
    //  print_r($collectorDetails);
    //  exit;   
     return view('collectionPoint/collectors', compact('collectorDetails'));
    }

    public function myAreas()
    {
     $collectionAreas = DB::table('collections')
     ->select('collections.id','title','AFM','AFE')
     ->where('collectionPoint_id', checkpoint())  //function in helper function
     ->get();
     
    //  echo "<pre>";
    //  print_r($collectionAreas);
    //  exit;   
    //return view('task.generateTask', compact('eveningTasks'));
    return view('collectionPoint/collectionAreas', compact('collectionAreas'));
    }




}
