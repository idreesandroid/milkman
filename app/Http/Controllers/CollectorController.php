<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CollectorController extends Controller
{
    //

    public function collector_list(Request $request)
    { 
    $col_query="SELECT a.id , `name` , email, user_phone , role_title 
    FROM `users` a INNER JOIN user_role b ON  b.id=a.`user_role`
    WHERE user_role=2 ";
    $collector_list =  DB::select($col_query);

    $vend_query="SELECT id  as rout_id, route_name  from  vendor__routes ";


    $route_list =  DB::select($vend_query);



    return  view('set_task',  compact('collector_list', 'route_list') );

}

public function set_task(Request $request)
{

        $task_date = $request->input('task_date');
        $collector_id = $request->input('collector_id');
        $task_time = $request->input('task_time');
        $u_id =  session()->get('u_id');

    $set_task_data = array(
         
        'collector_id'   => "$collector_id",
        'task_time'   => "$task_time", 
        'created_by'   => "$u_id"

        );


    $task_id =  DB::table('collection_task_header')->insertGetId($set_task_data);

    

     

    for($i=0; $i < count($request->input('route_id')); $i++ ) 
    {
      $route_ids =  $request->input('route_id')[$i];
    $Records = " INSERT INTO collection_task_vendors ( task_id , route_id) 
        VALUES ( '$task_id','$route_ids')";
         DB::insert("$Records");


    }





    return redirect('set_task')->with('msg','Record Inserted Successfully.');
}


public function task_list(Request $request)
{

    $u_id =  session()->get('u_id');

     $task_que="SELECT a.id AS task_id, task_time,a.collector_id, b.name AS collector_name, DATE_FORMAT(a.created_date,'%d-%m-%Y')created_time, c.received_qty 
   FROM `collection_task_header` a 
   INNER JOIN users b ON b.id=a.collector_id
   LEFT JOIN `collection_task_child` c ON c.task_id=a.id WHERE a.collector_id='$u_id' ";
    $task_lists =  DB::select($task_que);

    return  view('task_list',  compact('task_lists') );

}

public function task_vendors($id)
{
    

        $vend_query=" select  distinct  vendor_id, `name`, decided_rate from collection_task_vendors a
     INNER JOIN vendor_details b on b.route_id=a.route_id
     INNER JOIN users c on c.id=b.vendor_id 
   
     where task_id= '$id' and   vendor_id not in (select  vendor_id from collection_task_child where task_id='$id') ";
    $vendor_list =  DB::select($vend_query);


    return  view('task_collection', compact('vendor_list'))->with('task_id', $id);
}
public function task_collection_entry(Request $request)
{
$task_id =  $request->input('task_id');
$collector_id =  session()->get('u_id');
$vendor_id =  $request->input('vendor_id');
$received_qty =  $request->input('received_qty');
$milk_quality =  $request->input('milk_quality');


$fat =  $request->input('fat');
$protine =  $request->input('protine');
$calcium =  $request->input('calcium');



$get_rate = DB::table('vendor_details')->select('decided_rate')->where('vendor_id', $vendor_id)->first();
$currunt_rate =  $get_rate->decided_rate;
$Records = " INSERT INTO collection_task_child ( task_id , collector_id, vendor_id, received_qty, milk_quality,rate,fat,protine,calcium  ) 
VALUES ( '$task_id','$collector_id','$vendor_id','$received_qty','$milk_quality', '$currunt_rate', '$fat', '$protine', '$calcium')";
DB::insert("$Records");
return  redirect('task_list');
}








}
