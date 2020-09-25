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

    $vend_query="SELECT a.id , `name` , email, user_phone , role_title 
    FROM `users` a INNER JOIN user_role b ON  b.id=a.`user_role`
    WHERE user_role=3 ";
    $vendor_list =  DB::select($vend_query);



    return  view('set_task',  compact('collector_list', 'vendor_list') );

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

    

     

    for($i=0; $i < count($request->input('vendoer_id')); $i++ ) 
    {
      $vendor_ids =  $request->input('vendoer_id')[$i];
    $Records = " INSERT INTO collection_task_vendors ( task_id , vendoer_id) 
        VALUES ( '$task_id','$vendor_ids')";
         DB::insert("$Records");


    }





    return redirect('set_task')->with('msg','Record Inserted Successfully.');
}


public function task_list(Request $request)
{

    $u_id =  session()->get('u_id');

    $task_que="SELECT a.id AS task_id, task_time,collector_id, b.name AS collector_name, DATE_FORMAT(a.created_time,'%d-%m-%Y')created_time
    FROM `collection_task_header` a  
    INNER JOIN users b ON b.id=a.collector_id WHERE collector_id='$u_id' ";
    $task_lists =  DB::select($task_que);

    return  view('task_list',  compact('task_lists') );

}

}
