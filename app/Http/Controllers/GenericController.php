<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
class GenericController extends Controller
{
    public function cityAjax($id)
    {
        // echo $id;
        // exit;
        $cities =City::where("state_id",$id)->select('city_name','id')->get();
        // echo "<pre>";
        // print_r($cities);
        // exit;
        return json_encode($cities);
    }
}
