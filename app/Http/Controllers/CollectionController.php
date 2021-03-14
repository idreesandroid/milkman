<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\User;
use App\Models\Tasks;
use App\Models\vendorDetail;
use App\Models\CollectionVendor;
use App\Models\milkCollectionPoint;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CollectionController extends Controller
{

    public function index()
    {
        $vendors = User::select('users.id','users.name','vendor_details.longitude','vendor_details.latitude')
                    ->join('role_user', 'role_user.user_id', '=', 'users.id')
                    ->join('vendor_details','vendor_details.user_id','=','users.id')
                    ->where('role_user.role_id', '=', 6)
                    ->get();


        $location = '[';
        foreach ($vendors as $value) {
            $location .='{"type":"MARKER","id":null,"geometry":['.trim($value->latitude).','.trim($value->longitude).']},';
        }
        $location .= ']';
        
        $location = str_replace("},]","}]",$location);

        $collections = Collection::select('collections.*','collections.id','users.filenames','users.user_phone','users.name')
                    ->leftjoin('users','users.id','=','collections.collector_id')
                    ->get();

                // Asim work on Task as---------------------------------------------------------------     
        
                // Asim work on Task as---------------------------------------------------------------
        $collectors = User::select('users.*')
                    ->join('role_user', 'role_user.user_id', '=', 'users.id')
                    ->where('role_user.role_id', '=', 5)
                    ->get();        
       // print_r($collections); die();
        return view('collection/index', compact('vendors','collections','location','collectors'));
    }

    public function create()
    {
        $vendors = User::select('users.id','users.name','vendor_details.longitude','vendor_details.latitude')
                    ->join('role_user', 'role_user.user_id', '=', 'users.id')
                    ->join('vendor_details','vendor_details.user_id','=','users.id')
                   // ->leftjoin('collection_vendor', 'collection_vendor.vendor_id', '=', 'users.id')
                    ->where('role_user.role_id', '=', 6)
                    ->get();
       // print_r($vendors); die();
        $location = '[';
        foreach ($vendors as $value) {
            $location .='{"type":"MARKER","id":null,"geometry":['.trim($value->latitude).','.trim($value->longitude).']},';
        }
        $location .= ']';
        
        $location = str_replace("},]","}]",$location);

        $collectionPoints= milkCollectionPoint::all();
        return view('collection/create', compact('vendors','location','collectionPoints'));
    }

    public function store(Request $request)
    {       

        $this->validate($request,[        
            'title'      => 'required|min:3',          
            'vendors_location'  => 'required',
            'status' => 'required',
            'collectionPoint' => 'required'
        ]);

        $collection_id = Collection::insertGetId([
            'title' => $request->title,
            'vendors_location' => str_replace("\\", '', $request->vendors_location),
            'status'   => $request->status,
            'collector_id' => 0,
            'collectionPoint_id' => $request->collectionPoint,

        ]);

        $vendorLocation = Collection::select('vendors_location')->where('id','=',$collection_id)->first();

        $allVendorsLatLng = vendorDetail::select('user_id','latitude','longitude')->get();

        $vendorsIds = $this->getAllVendorInsideCollectionArea($vendorLocation['vendors_location'],$allVendorsLatLng);        
                 
        foreach($vendorsIds as $vendor_id){ 
            $insLoc = CollectionVendor::insertGetId([        
                'collection_id' => $collection_id,          
                'vendor_id'  => $vendor_id,           
                'label_marker_color'  => $request->label_marker_color           
            ]);
        vendorDetail::where('user_id',$vendor_id)->update(['collection_id'=>$collection_id]);
        }
        return ($collection_id) ? true : false;
    }


    public function show(Collection $collection)
    {
        //
    }

    public function edit(Request $request)
    {
        $collection = Collection::select('collections.*','collection_vendor.vendor_id','collection_vendor.label_marker_color')
                     ->leftjoin('collection_vendor', 'collection_vendor.collection_id', '=', 'collections.id')
                     ->where('collections.id', '=', $request->id)
                     ->get();

        $vendors = User::select('users.id','users.name','vendor_details.longitude','vendor_details.latitude','collection_vendor.label_marker_color')
                    ->join('role_user', 'role_user.user_id', '=', 'users.id')
                    ->join('vendor_details','vendor_details.user_id','=','users.id')
                    ->leftjoin('collection_vendor', 'collection_vendor.vendor_id', '=', 'users.id')
                    ->where('role_user.role_id', '=', 6)
                    ->get();
        $location = '[';
        foreach ($vendors as $value) {
            $location .='{"type":"MARKER","id":null,"geometry":['.trim($value->latitude).','.trim($value->longitude).']},';
        }
        $location .= substr($collection[0]->vendors_location, 1, -1);        
        $location .= ']';
        
        $location = str_replace("},]","}]",$location);

        $collection[0]->vendors_location = $location;
        //$collection;
        return view('collection/edit', compact('location','vendors','collection'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[        
            'title'      => 'required|min:5',          
            'vendors_location'  => 'required',           
            'status' => 'required'
        ]);


        $vendors = User::select('users.id','users.name','vendor_details.longitude','vendor_details.latitude','collection_vendor.label_marker_color')
                    ->join('role_user', 'role_user.user_id', '=', 'users.id')
                    ->join('vendor_details','vendor_details.user_id','=','users.id')
                    ->leftjoin('collection_vendor', 'collection_vendor.vendor_id', '=', 'users.id')
                    ->where('role_user.role_id', '=', 6)
                    ->get();
        $location = '';
        foreach ($vendors as $value) {
            $location .='{"type":"MARKER","id":null,"geometry":['.trim($value->latitude).','.trim($value->longitude).']},';
        }

        $vendorLoc = str_replace($location,"",$request->vendors_location);

        Collection::where('id',$request->id)
                    ->update([
                        'title' => $request->title,
                        'vendors_location' => str_replace("\\", '', $vendorLoc),
                        'status'   => $request->status,
                        'collector_id' => $request->collector_id
                    ]);
        $vendorLocation = Collection::select('vendors_location')->where('id','=',$request->id)->first();

        $allVendorsLatLng = vendorDetail::select('user_id','latitude','longitude')->get();

        $vendorsIds = $this->getAllVendorInsideCollectionArea($vendorLocation['vendors_location'],$allVendorsLatLng);

        CollectionVendor::where('collection_id',$request->id)->delete();

        foreach($vendorsIds as $vendor_id){ 
            $vendorInserted = CollectionVendor::insertGetId([        
                'collection_id' => $request->id,          
                'vendor_id'  => $vendor_id,
                'label_marker_color' => $request->label_marker_color           
            ]);
            $vendorDetail = vendorDetail::where('user_id','=',$vendor_id)->update(['collection_id'=> $request->id]);
        }        

        return ($vendorDetail) ? true : false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $deleteCollection = Collection::where('id',$request->id)->delete();

        $deleteCollectionVendor = CollectionVendor::where('collection_id',$request->id)->delete();

        $deleteTask = Tasks::where('collection_id',$request->id)->delete();

        return ($deleteCollection || $deleteCollectionVendor || $deleteTask) ? true : false;
    } 

    public function assignCollector(Request $request){
        date_default_timezone_set("Asia/Karachi");
        $vendors = CollectionVendor::select('vendor_id')->where('collection_id',$request->id)->get(); 

        $isCollectionExist = Collection::where('id',$request->id)->where('status','active')->first();

        if(!is_null($isCollectionExist)){            

            Collection::where('id', $request->id)->update(['collector_id' => $request->collectorId]);

            foreach ($vendors as $vendor) {

                $vendorDetail = vendorDetail::where('user_id',$vendor->vendor_id)->first();
                    if($vendorDetail->morningTime){
                        $updatedtask = Tasks::insertGetId([        
                            'vendor_id' => $vendor->vendor_id,          
                            'collector_id'  => $request->collectorId,
                            'collection_id'  => $request->id,
                            'status' => 'Not Started',
                            'shift' => 'morning',
                            'duedate' => date('Y-m-d'),
                            'duetime' => $vendorDetail->morningTime
                        ]);
                    }
                    if($vendorDetail->eveningTime){
                        $updatedtask = Tasks::insertGetId([        
                            'vendor_id' => $vendor->vendor_id,          
                            'collector_id'  => $request->collectorId,
                            'collection_id'  => $request->id,
                            'status' => 'Not Started',
                            'shift' => 'evening',
                            'duedate' => date('Y-m-d'),
                            'duetime' => $vendorDetail->eveningTime     
                        ]);
                    }
                }
            return ($updatedtask) ? true : false;         
        }else{
            return false;
        }

    }

    public function getAllVendorInsideCollectionArea($collectionArea,$allVendorsLatLng){  

        if (strpos($collectionArea, 'POLYGON') !== false) {
           $AllLatLngs = substr($collectionArea, 43, -5);
           $LatLngInArray = explode('],[', $AllLatLngs);
            $allLats = [];
            $allLngs = [];
            foreach($LatLngInArray as $item){
                $singleLatLng = explode(',', $item);
                array_push($allLats, $singleLatLng[0]);
                array_push($allLngs, $singleLatLng[1]);
            }
            $points_polygon = count($allLats);
            $allInsideVendors = [];
            foreach($allVendorsLatLng as $latlngs){
                if(isInPolygon($points_polygon,$allLats,$allLngs,$latlngs['latitude'],$latlngs['longitude'])){
                    array_push($allInsideVendors, $latlngs['user_id']);
                }
            }
            return $allInsideVendors;
        }
    }    



    // asim work on reassign collection point of area-----------------

    public function findCollectionPoint($id)
    {   
        $collectionPoints = milkCollectionPoint::all();
        $previousPoint = Collection::findOrFail($id);
        $prePoint = $previousPoint->collectionPoint_id;

        $points= array();
        $points['allPoint']=$collectionPoints;
        $points['selectedPoint']=$prePoint;
    // echo "<pre>";
    // print_r($points);
    // exit;
        return $points;
    }

    public function resetCollectionPoint(Request $request)
    {     
        //    echo "<pre>";
        //    print_r($request->all());
        //    exit;
        $this->validate($request,[ 
            'pointId'       => 'required', 
            'select_point'       => 'required'  
        ]);
        DB::update("UPDATE collections SET `collectionPoint_id` =  $request->select_point WHERE `id` = $request->pointId");  
       return "OK";
        // return redirect()->route('index.collectionPoint');
    }

       
}
