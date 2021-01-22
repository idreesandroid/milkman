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

        $collections = Collection::select('collections.*','users.filenames')
                    ->leftjoin('users','users.id','=','collections.collector_id')
                    ->get();
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
            'title'      => 'required|min:5',          
            'vendors_location'  => 'required',
            'vendorsIds' => 'required|min:1',
            'status' => 'required'
        ]);

        $collection_id = Collection::insertGetId([
            'title' => $request->title,
            'vendors_location' => str_replace("\\", '', $request->vendors_location),
            'status'   => $request->status,
            'collector_id' => 0
        ]);

        foreach($request->vendorsIds as $vendor_id){ 
            CollectionVendor::insert([        
                'collection_id' => $collection_id,          
                'vendor_id'  => $vendor_id           
            ]);
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
            'vendorsIds' => 'required|min:1',
            'status' => 'required'
        ]);

        Collection::where('id',$request->id)
                    ->update([
                        'title' => $request->title,
                        'vendors_location' => str_replace("\\", '', $request->vendors_location),
                        'status'   => $request->status,
                        'collector_id' => $request->collector_id
                    ]);

        CollectionVendor::where('collection_id',$request->id)->delete();

        foreach($request->vendorsIds as $vendor_id){ 
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

    public function getvendorlatlng(Request $request){ 
    $currentVendorId = $request->vendor_id[count($request->vendor_id) - 1];
         
        //$latlng = vendorDetail::select('longitude','latitude')->where('user_id','=',end($request->vendor_id))->first();
        //echo $latlng->latitude. ', '.$latlng->longitude;
        echo $currentVendorId;
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
}
