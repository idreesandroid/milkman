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
use App\Models\collectionPointSubmission;
use App\Models\milkBank;
class milkCollectionController extends Controller
{
  public function index()
  {  
    $collectionPoints = DB::table('milk_collection_points')
                           ->select('id','pointName','pointAddress','totalmilk')
                           ->get();  
    return view('collectionPoint/index', compact('collectionPoints'));
  }

  public function mapDetail($id)
  {  
    $collectionPoints = DB::table('milk_collection_points')
                           ->select('milk_collection_points.id','pointName','pointAddress','collectionPointId','totalmilk','longitude','latitude')
                           ->leftJoin('collection_point_managers','milk_collection_points.id','=','collection_point_managers.collectionPointId')
                           ->where('milk_collection_points.id',$id)
                           ->first();

    $Long = $collectionPoints->longitude;
    $Lat = $collectionPoints->latitude;

    $collectionPoint = DB::table('milk_collection_points')
                          ->select('milk_collection_points.id','pointName','pointAddress','collectionPointId','totalmilk','longitude','latitude')
                          ->leftJoin('collection_point_managers','milk_collection_points.id','=','collection_point_managers.collectionPointId')
                          ->where('milk_collection_points.id',$id)
                          ->get();

    $location = '[';
    foreach ($collectionPoint as $value) {
          $location .='{"type":"MARKER","id":null,"geometry":['.trim($value->latitude).','.trim($value->longitude).']},';
    }
    $location .= ']';
      
    $location = str_replace("},]","}]",$location);

    return view('collectionPoint/mapDetail', compact('collectionPoints','Long','Lat','location'));
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
            'map_detail'=>'required',
         ]);     
        $points = new milkCollectionPoint();
        $points->pointName = $request->point_name;        
        $points->pointAddress = $request->point_address;        
        $mapdata = json_decode($request->map_detail);
        if(isset($mapdata[0]->geometry[0][0][0]) && isset($mapdata[0]->geometry[0][0][1])){
          $points->latitude = $mapdata[0]->geometry[0][0][0];
          $points->longitude = $mapdata[0]->geometry[0][0][1];
        }else{
          $points->latitude = $mapdata[0]->geometry[0];
          $points->longitude = $mapdata[0]->geometry[1];
        }
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
          'pointAddress'=>'required'
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

  public function milkSubmission()
  {  
     $collectors = DB::table('collector_details')
                       ->select('user_id','name')
                       ->where('collectionPoint_id', checkpoint())
                       ->join('users','user_id','=','users.id')
                       ->get();
      
      return view('collectionPoint/milkSubmission', compact('collectors'));
  }

  public function collectorCollections($id)
  {  
    $today=date('Y-m-d'); 
    $collections = DB::table('sub_tasks')
                       ->select('sub_tasks.id','task_id','milkCollected','fat','lactose','Ash','totalProteins','totalSolid','status','vendor_id','taskShift','collectedTime','name')
                       ->where('assignTo',$id)
                       ->where('collectionStatus','Generated')
                       ->where('collection_date', $today)
                       ->join('users','vendor_id','=','users.id')
                       ->get();
      
       return json_encode($collections);
  }

  public function collectionSubmission(Request $request)
  {
    $this->validate($request,[
        'collectionIds'=> 'required',
        'collector_id'=> 'required',
        'totalMilk'=>'required', 
        'totalFat'=> 'required',
        'D_Shot'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        'totalAsh'=> 'required',
        'totalProteins'=>'required',
        'totalLactose'=> 'required',
        'subTask_id'=>'required',
    ]);

  $Area = TaskArea::where('id', $request->subTask_id)->select('area_id','shift')->first();
    
  if($request->totalMilk > 0 )
    {
    $submission = new collectionPointSubmission();
    $submission->area_Id = $Area->area_id;        
    $submission->collectionPoint_id = checkpoint();
    $submission->collector_id = $request->collector_id;        
    $submission->collectionShift = $Area->shift;
    $submission->milkCollected = $request->totalMilk;        
    $submission->averageFat = $request->totalFat;
    $submission->averageAsh = $request->totalAsh;        
    $submission->averageProteins = $request->totalProteins;
    $submission->averageLactose = $request->totalLactose;
    $submission->averageSolids = ($request->totalFat+$request->totalAsh+$request->totalProteins+$request->totalLactose)/4;

    $imageName = time().'.'.$request->D_Shot->extension();    
    $request->D_Shot->move(public_path('milkQuality_img'), $imageName);
    $submission->averageQuality_SS = $imageName;
    $submission->save();  
    $point=checkpoint();

    DB::update("UPDATE milk_collection_points SET `totalMilk` = totalMilk+$request->totalMilk WHERE `id` = $point");
   
    $task_ids = $request['collectionIds'];
    foreach($task_ids as $index => $task_id)
    {
        DB::update("UPDATE sub_tasks SET `collectionStatus` = 'Completed' WHERE `id` = $task_id");
    }
    return redirect()->route('user.dashBoard');
    }
    else
    {
        return redirect()->back()->with('alert', "You are Entering Wrong Information");
    }
  }


  public function areaBaseCollection($id)
  {  
   $milkCollections = DB::table('collection_point_submissions')
                         ->select('collection_point_submissions.id','title','name','milkCollected','collectionShift','averageFat','averageAsh','averageProteins','averageLactose','averageSolids','averageQuality_SS','collection_point_submissions.created_at')
                         ->where('area_id',$id)
                         ->leftJoin('collections','collection_point_submissions.area_Id','=','collections.id')
                         ->leftJoin('users','collection_point_submissions.collector_id','=','users.id')
                         ->orderBy('collection_point_submissions.created_at', 'DESC')
                         ->get();

     return view('collectionPoint/areaBaseMilkCollection', compact('milkCollections'));
  }

  public function pointBaseCollection($id)
  {  
   $milkCollections = DB::table('collection_point_submissions')
                           ->select('collection_point_submissions.id','title','name','milkCollected','collectionShift','averageFat','averageAsh','averageProteins','averageLactose','averageSolids','averageQuality_SS','collection_point_submissions.created_at')
                           ->where('collection_point_submissions.collectionPoint_id',$id)
                           ->leftJoin('collections','collection_point_submissions.area_Id','=','collections.id')
                           ->leftJoin('users','collection_point_submissions.collector_id','=','users.id')
                           ->orderBy('collection_point_submissions.created_at', 'DESC')
                           ->get();

     return view('collectionPoint/areaBaseMilkCollection', compact('milkCollections'));
  }
}
