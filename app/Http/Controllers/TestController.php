<?php

namespace App\Http\Controllers;

use App\Models\test;
use App\Models\CollectionVendor;
use App\Models\vendorDetail;
use App\Models\Collection;
use App\Models\Invoice;
use Illuminate\Http\Request;

use App\Http\Controllers\CollectionController as CollectionController;

use App\Http\Controllers\TasksController as Task;

use App\Exports\OrderExport;
use Maatwebsite\Excel\Facades\Excel;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        ///echo date(strtotime("now"),'M/d/Y'), "</br>";
        // date_default_timezone_set("Asia/Karachi");
        // echo date("d-m-Y", strtotime("-1 week"))."\n"; 
        // echo date("d-m-Y", strtotime("-1 month"))."\n"; 
        // echo date("d-m-Y", strtotime("-1 day"))."\n"; 
        // echo date("d-m-Y", strtotime("now"))."\n"; 
        // echo strtotime("10 September 2000"), "</br>";
        // echo strtotime("+1 day"), "</br>";
        // echo strtotime("+1 week"), "</br>";
        // echo strtotime("+1 week 2 days 4 hours 2 seconds"), "</br>";
        // echo strtotime("next Thursday"), "</br>";
        // echo strtotime("last Monday"), "</br>";
//2020-11-02
//2021-02-10
        //select * from `invoices` where `created_at` between '2021-02-08' and '2021-02-10' and `invoices`.`deleted_at` is null

// $vendors = User::select('users.id','users.name','vendor_details.longitude','vendor_details.latitude')
//                     ->join('role_user', 'role_user.user_id', '=', 'users.id')
//                     ->join('vendor_details','vendor_details.user_id','=','users.id')
//                     ->where('role_user.role_id', '=', 6)
//                     ->get();

        // select `invoices`.*, `users`.`name` as `saler` from `invoices` inner join `users` on `users`.`id` = `invoices`.`seller_id` where `created_at` between '2020-11-02' and '2021-02-10' and `invoices`.`deleted_at` is null

$Invoice = Invoice::select('invoices.*','users.name as saler')
                        ->join('users','users.id','=','invoices.seller_id')
                        ->whereBetween('invoices.created_at', array('2020-11-02', '2021-02-10'))
                        ->get();
    dd($Invoice);




    echo $fromDate = date("Y-m-d", strtotime("-3 day"));
    echo "<br>";
    echo $toDate = date("Y-m-d", strtotime("now"));



    $Invoice = Invoice::whereBetween('created_at', array(date("Y-m-d", $fromDate), date("Y-m-d", $toDate)))->get();

    dd($Invoice);      


        //assignMorningTask();
        //assignEveningTask();
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


    public function export()
    {
       // return Excel::download(new OrderExport, 'allOrders.xlsx');
        //return (new OrderExport)->download('allOrders.xlsx');
        $filename = 'search-orders-at-'.date("d-m-Y").'.xlsx';
       return Excel::download(new OrderExport(), $filename);
         
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

    public function getCollectionAreaWhereVendorLies($collectionArea,$locationDetail){

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
