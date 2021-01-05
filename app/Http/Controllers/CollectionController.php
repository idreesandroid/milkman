<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\User;
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
        $vendors = User::select('users.id','users.name')
                    ->join('role_user', 'role_user.user_id', '=', 'users.id')
                    ->where('role_user.role_id', '=', 6)
                    ->get();
        return view('collection/create', compact('vendors'));
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
            'vendorsIds' => 'required|min:1'
        ]);

        $collection_id = Collection::insertGetId([
            'title' => $request->title,
            'vendors_location' => str_replace("\\", '', $request->vendors_location),
            'status'   => 'active',
            'collector_id' => 5
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collection $collection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $res = Collection::where('id',$request->id)->delete();
        $result = CollectionVendor::where('collection_id',$request->id)->delete();
        return ($res || $result) ? true : false;
    }

    public function assignCollector(Request $request){
        $isCollectionExist = Collection::where('id',$request->id)->where('status','active')->first();
        if(!is_null($isCollectionExist)){
            $affected = Collection::where('id', $request->id)->update(['collector_id' => $request->collectorId]);
            echo ($affected) ? true : false;         
        }else{
            echo false;
        }

    }
}
