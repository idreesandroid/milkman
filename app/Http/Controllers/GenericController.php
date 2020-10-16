<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
class GenericController extends Controller
{
    public function cityAjax($id)
    {
        $cities =City::where("state_id",$id)->select('city_name','id')->get();
        return json_encode($cities);
    }
}
