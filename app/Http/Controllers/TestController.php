<?php

namespace App\Http\Controllers;

use App\Models\test;
use App\Models\CollectionVendor;
use App\Models\vendorDetail;
use App\Models\Collection;
use Illuminate\Http\Request;

use App\Http\Controllers\CollectionController as CollectionController;

use App\Http\Controllers\TasksController as Task;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $vendorDetail = vendorDetail::select('user_id','latitude','longitude','collection_id')
                            ->where('user_id','=',20)
                            ->first();
        $vendorLocations = Collection::select('id','vendors_location')->get();

        foreach($vendorLocations as $singleLocation){

        $collection_id = $this->getCollectionAreaWhereVendorLie($singleLocation, $vendorDetail);
            if($collection_id){
                break;
            }
        }

        $label_marker_color = CollectionVendor::select('label_marker_color')->where('collection_id','=',$collection_id)->first();

        $labelcolor = $label_marker_color['label_marker_color'];

        var_dump($labelcolor);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(test $test)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, test $test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(test $test)
    {
        //
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
                    array_push($allInsideVendors, $latlngs['id']);
                }
            }
            return $allInsideVendors;
        }
    }   

    public function getDistanceBetweenPoints($lat1, $lon1, $lat2, $lon2) {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $kilometers = $miles * 1.609344;
        return $kilometers;
    }

    public function isInsideCircle($center_x,$center_y,$radius, $x, $y){

        echo "Radius: ".$radius. " CenterX: ".$center_x." CenterY: ".$center_y." PointX: ".$x." PointY: ".$y;
        echo "<br>";
        echo  $center_x.",".$center_y.",".$radius.",".$x.",".$y;
        echo "<br>";


      $addDiffSqr = $this->getDistanceBetweenPoints($center_x, $center_y, $x, $y);
      echo $addDiffSqr; 

      $sqrt = sqrt($addDiffSqr);
        echo "<br>";

      echo $sqrt; 
        echo "<br>";

            exit();
      if($sqrt < ($radius / 1000)){
          return true; // Inside
      } else {
          return false; // Outside
      }
    }

    public function getCollectionAreaWhereVendorLie($collectionArea,$locationDetail){

        if (strpos($collectionArea['vendors_location'], 'POLYGON') !== false) {
           $AllLatLngs = substr($collectionArea['vendors_location'], 43, -5);
           $LatLngInArray = explode('],[', $AllLatLngs);
            $allLats = [];
            $allLngs = [];
            foreach($LatLngInArray as $item){
                $singleLatLng = explode(',', $item);
                array_push($allLats, $singleLatLng[0]);
                array_push($allLngs, $singleLatLng[1]);
            }
            $points_polygon = count($allLats);

            echo $locationDetail['latitude'].',  '.$locationDetail['longitude'];
            echo "<br>";
            
            if(isInPolygon($points_polygon,$allLats,$allLngs,$locationDetail['latitude'],$locationDetail['longitude'])){
                return ($collectionArea['id']) ? $collectionArea['id'] : false;
            }
            
        }
    }
}
