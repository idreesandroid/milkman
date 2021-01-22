<?php

use App\Models\UserAccount;

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
        'date' => date('m/d/Y', $strTime),
        'time' => date('h:i:s a', $strTime)
    );
   
    return $dateTimeArray;
}

