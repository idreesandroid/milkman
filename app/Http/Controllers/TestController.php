<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\test;
use App\Models\CollectionVendor;
use App\Models\vendorDetail;
use App\Models\Collection;
use App\Models\Invoice;
use App\Models\UserAccount;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\SubTask;
use App\Models\UserTransaction;
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

        $first_day_this_month  = date('Y-m-01');
        $current_day_this_month = date('Y-m-d');

        $periods = createDateRangeArray($first_day_this_month,$current_day_this_month);

        $MorningMilkDetail = '[';        
        $EveningMilkDetail = '[';        

        foreach($periods as $period){
            $MorningMilkqualityString = '';
            $MorningMilkqualityString .= '{date:'."'".$period."'".',';

            $EveningMilkqualityString = '';
            $EveningMilkqualityString .= '{date:'."'".$period."'".',';  

            $morningMilkQuality = SubTask::select('milkCollected','fat','Lactose','Ash','totalProteins','totalSolid')
                                    ->where('taskShift', 'Morning')
                                    ->where('status', 'Complete')
                                    ->where('created_at', 'like', '%' . $period . '%')
                                    ->first();

            if(isset($morningMilkQuality)){
                $MorningMilkqualityString.= "'".'milkCollected'."':"."'".$morningMilkQuality->milkCollected."'".",";
                $MorningMilkqualityString.= "'".'fat'."':"."'".$morningMilkQuality->fat."'".",";
                $MorningMilkqualityString.= "'".'Lactose'."':"."'".$morningMilkQuality->Lactose."'".",";
                $MorningMilkqualityString.= "'".'Ash'."':"."'".$morningMilkQuality->Ash."'".",";
            }else{
                $MorningMilkqualityString.= "'".'milkCollected'."':"."'".'0'."'".",";
                $MorningMilkqualityString.= "'".'fat'."':"."'".'0'."'".",";
                $MorningMilkqualityString.= "'".'Lactose'."':"."'".'0'."'".",";
                $MorningMilkqualityString.= "'".'Ash'."':"."'".'0'."'".",";
            }
                         
            $newMorMilk='';
            $newMorMilk .= rtrim($MorningMilkqualityString, ","); 
            $newMorMilk .= '},';
            $MorningMilkDetail .= $newMorMilk; 


            $eveningMilkQuality = SubTask::select('milkCollected','fat','Lactose','Ash','totalProteins','totalSolid')
                                    ->where('taskShift', 'Evening')
                                    ->where('status', 'Complete')
                                    ->where('created_at', 'like', '%' . $period . '%')
                                    ->first();

            if(isset($eveningMilkQuality)){
                $EveningMilkqualityString.= "'".'milkCollected'."':"."'".$eveningMilkQuality->milkCollected."'".",";
                $EveningMilkqualityString.= "'".'fat'."':"."'".$eveningMilkQuality->fat."'".",";
                $EveningMilkqualityString.= "'".'Lactose'."':"."'".$eveningMilkQuality->Lactose."'".",";
                $EveningMilkqualityString.= "'".'Ash'."':"."'".$eveningMilkQuality->Ash."'".",";
            }else{
                $EveningMilkqualityString.= "'".'milkCollected'."':"."'".'0'."'".",";
                $EveningMilkqualityString.= "'".'fat'."':"."'".'0'."'".",";
                $EveningMilkqualityString.= "'".'Lactose'."':"."'".'0'."'".",";
                $EveningMilkqualityString.= "'".'Ash'."':"."'".'0'."'".",";
            }
                         
            $newEveMilk='';
            $newEveMilk .= rtrim($EveningMilkqualityString, ","); 
            $newEveMilk .= '},';
            $EveningMilkDetail .= $newEveMilk;                     
        }        

        $MorningMilkDetail .= ']'; 

        $MorningMilkDetail = str_replace("},]","}]",$MorningMilkDetail);

        echo $MorningMilkDetail;

        echo "<br>=========================</br>";

        $EveningMilkDetail .= ']'; 

        $EveningMilkDetail = str_replace("},]","}]",$EveningMilkDetail);

        echo $EveningMilkDetail;



            
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo $first_day_this_month  = date('Y-m-01');
echo "<br>";
echo $current_day_this_month = date('Y-m-d'); // hard-coded '01' for first day

$periods = $this->createDateRangeArray($first_day_this_month,$current_day_this_month);

$productids = [1,2,3,4];

$productsDetail = [];

    foreach($periods as $period){

        $temp = [];
        foreach($productids as $productid){
                    $singleProduct = [];

            $products = Cart::select('carts.product_id','carts.created_at','products.product_name')
                                ->leftJoin('products','products.id','=','carts.product_id')
                                ->where('carts.product_id', $productid)
                                ->where('carts.created_at', 'like', '%' . $period . '%')
                                ->get();
            $total = Cart::where('product_id', $productid)
                            ->where('created_at', 'like', '%' . $period . '%')
                            ->sum('product_quantity');

                foreach ($products as $product) {
                    array_push($temp, $product->product_id);
                    array_push($temp, $period);
                    array_push($temp, $product->product_name);
                    array_push($temp, $total);
                }       
            array_push($temp, $singleProduct);  
        }    
        array_push($productsDetail, $temp);  
    }
    echo "<pre>";

    print_r($productsDetail);   
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

    public function createDateRangeArray($strDateFrom,$strDateTo)
    {
        // takes two dates formatted as YYYY-MM-DD and creates an
        // inclusive array of the dates between the from and to dates.

        // could test validity of dates here but I'm already doing
        // that in the main script

        $aryRange = [];

        $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
        $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

        if ($iDateTo >= $iDateFrom) {
            array_push($aryRange, date('Y-m-d', $iDateFrom)); // first entry
            while ($iDateFrom<$iDateTo) {
                $iDateFrom += 86400; // add 24 hours
                array_push($aryRange, date('Y-m-d', $iDateFrom));
            }
        }
        return $aryRange;
    }
}



