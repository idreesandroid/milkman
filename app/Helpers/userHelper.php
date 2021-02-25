<?php

use App\Models\UserAccount;
use App\Models\milkmanAsset;

function generateAccNumber() {
    $number = mt_rand(1000000, 9999999); // better than rand()

    // call the same function if the barcode exists already
    if (accNumberExists($number)) {
        return generateAccNumber();
    }

    // otherwise, it's valid and can be used
    return $number;
}

function accNumberExists($number) {
    // query the database and return a boolean
    // for instance, it might look like this in Laravel
    return UserAccount::where('userAccount', '=' , $number)->exists();
}

function timeFormat($date)
{
    $strTime = strtotime($date);
    $dateTimeArray = array(
        'date' => date('d/m/Y', $strTime),
        'time' => date('h:i a', $strTime)
    );
   
    return $dateTimeArray;
}


function generateAssetCode() {
    $number = mt_rand(1000000, 9999999); // better than rand()

    // call the same function if the barcode exists already
    if (assetNumberExists($number)) {
        return generateAssetCode();
    }

    // otherwise, it's valid and can be used
    return $number;
}

function assetNumberExists($number) {
    // query the database and return a boolean
    // for instance, it might look like this in Laravel
    return milkmanAsset::where('assetCode', '=' , $number)->exists();
}

//is area assigned-------------------------------------
function findArea()
{  
    //test
}


function isInPolygon($points_polygon, $vertices_x, $vertices_y, $longitude_x, $latitude_y){
  $i = $j = $c = 0;
  for ($i = 0, $j = $points_polygon-1 ; $i < $points_polygon; $j = $i++) {
    if ( (($vertices_y[$i] > $latitude_y != ($vertices_y[$j] > $latitude_y)) &&
    ($longitude_x < ($vertices_x[$j] - $vertices_x[$i]) * ($latitude_y - $vertices_y[$i]) / ($vertices_y[$j] - $vertices_y[$i]) + $vertices_x[$i]) ) ) 
        $c = !$c;
  }
  return $c;
}

function createDateRangeArray($strDateFrom,$strDateTo)
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
