<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\User;
use App\Models\Tasks;
use App\Models\vendorDetail;
use App\Models\CollectionVendor;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
                    // foreach($collections as $collection)
                    // {
                    //     echo "<pre>";
                    //     print_r($collection->id);

                    // }
                    //     exit;
                  // Asim work on Task as---------------------------------------------------------------

        $collectors = User::select('users.*')
                    ->join('role_user', 'role_user.user_id', '=', 'users.id')
                    ->where('role_user.role_id', '=', 5)
                    ->get(); 
        //$bootstrapclass = ['bg-gradient-danger','bg-gradient-warning','bg-gradient-info','bg-gradient-success'];
        return view('collection/index', compact('vendors','collections','location','collectors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        return view('collection/create', compact('vendors','location'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $this->validate($request,[        
            'title'      => 'required|min:3',          
            'vendors_location'  => 'required',
            'status' => 'required'
        ]);

        $collection_id = Collection::insertGetId([
            'title' => $request->title,
            'vendors_location' => str_replace("\\", '', $request->vendors_location),
            'status'   => $request->status,
            'collector_id' => 0
        ]);

        $vendorLocation = Collection::select('vendors_location')->where('id','=',$collection_id)->first();

        $allVendorsLatLng = vendorDetail::select('user_id','latitude','longitude')->get();

        $vendorsIds = $this->getAllVendorInsideCollectionArea($vendorLocation['vendors_location'],$allVendorsLatLng);

        foreach($vendorsIds as $vendor_id){ 
            CollectionVendor::insert([        
                'collection_id' => $collection_id,          
                'vendor_id'  => $vendor_id           
            ]);
        }

        foreach($request->vendorsIds as $vendor_id){ 
            DB::update("UPDATE vendor_details SET collection_id = $collection_id  WHERE user_id	 = $vendor_id");

        }



        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $collection = Collection::select('collections.*','collection_vendor.vendor_id')
                     ->leftjoin('collection_vendor', 'collection_vendor.collection_id', '=', 'collections.id')
                     ->where('collections.id', '=', $request->id)
                     ->get();

        $vendors = User::select('users.id','users.name','vendor_details.longitude','vendor_details.latitude')
                    ->join('role_user', 'role_user.user_id', '=', 'users.id')
                    ->join('vendor_details','vendor_details.user_id','=','users.id')
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
        return $collection;
        
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

        Collection::where('id',$request->id)
                    ->update([
                        'title' => $request->title,
                        'vendors_location' => str_replace("\\", '', $request->vendors_location),
                        'status'   => $request->status,
                        'collector_id' => $request->collector_id
                    ]);
        $vendorLocation = Collection::select('vendors_location')->where('id','=',$request->id)->first();

        $allVendorsLatLng = vendorDetail::select('user_id','latitude','longitude')->get();

        $vendorsIds = $this->getAllVendorInsideCollectionArea($vendorLocation['vendors_location'],$allVendorsLatLng);

        CollectionVendor::where('collection_id',$request->id)->delete();

        //foreach($request->vendorsIds as $vendor_id){ 
        foreach($vendorsIds as $vendor_id){ 
            CollectionVendor::insert([        
                'collection_id' => $request->id,          
                'vendor_id'  => $vendor_id           
            ]);
        }        

        return true;
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

    // public function getvendorlatlng(Request $request){ 
    // $currentVendorId = $request->vendor_id[count($request->vendor_id) - 1];
         
    //     //$latlng = vendorDetail::select('longitude','latitude')->where('user_id','=',end($request->vendor_id))->first();
    //     //echo $latlng->latitude. ', '.$latlng->longitude;
    //     echo $currentVendorId;
    // }

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
                if($this->isInPolygon($points_polygon,$allLats,$allLngs,$latlngs['latitude'],$latlngs['longitude'])){
                    array_push($allInsideVendors, $latlngs['user_id']);
                }
            }

            return $allInsideVendors;            

        }else if(strpos($collectionArea, 'CIRCLE') !== false){
            return 'it is CIRCLE';
        }
    }


    public function isInPolygon($points_polygon, $vertices_x, $vertices_y, $longitude_x, $latitude_y){
      $i = $j = $c = 0;
      for ($i = 0, $j = $points_polygon-1 ; $i < $points_polygon; $j = $i++) {
        if ( (($vertices_y[$i] > $latitude_y != ($vertices_y[$j] > $latitude_y)) &&
        ($longitude_x < ($vertices_x[$j] - $vertices_x[$i]) * ($latitude_y - $vertices_y[$i]) / ($vertices_y[$j] - $vertices_y[$i]) + $vertices_x[$i]) ) ) 
            $c = !$c;
      }
      return $c;
    }
}
