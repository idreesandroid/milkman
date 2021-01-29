<?php

namespace App\Http\Controllers;

use App\Models\test;
use App\Models\CollectionVendor;
use App\Models\vendorDetail;
use App\Models\Collection;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     

        $vendorLocation = Collection::select('vendors_location')->where('id','=',8)->first();         
        $allVendorsLatLng = vendorDetail::select('id','latitude','longitude')->get();
        $vendorsIds = $this->getAllVendorInsideCollectionArea($vendorLocation['vendors_location'],$allVendorsLatLng);

        foreach ($vendorsIds as $item) {
            echo "Ids".$item."<br>";
        }

        // print_r($vendorsIds);
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
                if($this->isInPolygon($points_polygon,$allLats,$allLngs,$latlngs['latitude'],$latlngs['longitude'])){
                    array_push($allInsideVendors, $latlngs['id']);
                }
            }

            return $allInsideVendors;            

        }else if(strpos($collectionArea, 'CIRCLE') !== false){
            echo $collectionArea.'<br>';
            $radius = substr($collectionArea, 37, -52);
            $centerLatitude = substr($collectionArea, 68, -21);
            $centerLongitude = substr($collectionArea, 85, -3);
            echo "Radius: ".$radius. " centerLatitude: ".$centerLatitude." centerLongitude: ".$centerLongitude."<br>";
            $allInsideVendors = [];
            foreach($allVendorsLatLng as $latlngs){
                if($this->isInsideCircle($centerLatitude,$centerLongitude,$radius,$latlngs['latitude'],$latlngs['longitude'])){
                    array_push($allInsideVendors, $latlngs['id']);
                }
            }                     
            return $allInsideVendors; 
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
}
