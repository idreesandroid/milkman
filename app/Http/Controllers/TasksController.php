<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TasksController extends Controller
{
    //

public function todays_tasks(Request $request){

  $u_id =  session()->get('u_id');
$today_date = date('Y-m-d');

  $task_total = "SELECT count(*) as task_total
  FROM `collection_task_header` a
  INNER JOIN collection_task_vendors b ON a.id=b.`task_id`
  INNER JOIN vendor_details c ON c.`route_id`=b.`route_id`
  INNER JOIN users d ON d.id=c.user_id	
  INNER JOIN vendor__routes e ON e.id=c.`route_id`  
  LEFT JOIN collection_task_child f ON f.`task_id`=a.`id`  AND f.vendor_id=c.user_id
  WHERE a.`collector_id`='$u_id' AND DATE_FORMAT(task_date, '%Y-%m-%d') = '$today_date'";

 $total_tasks_completed = "SELECT count(*) as task_completed
FROM `collection_task_header` a
INNER JOIN collection_task_vendors b ON a.id=b.`task_id`
INNER JOIN vendor_details c ON c.`route_id`=b.`route_id`
INNER JOIN users d ON d.id=c.user_id	
INNER JOIN vendor__routes e ON e.id=c.`route_id`  
LEFT JOIN collection_task_child f ON f.`task_id`=a.`id`  AND f.vendor_id=c.user_id
WHERE a.`collector_id`='$u_id ' AND DATE_FORMAT(task_date, '%Y-%m-%d') = '$today_date' and received_qty>0";
 
$total_tasks_pending = "SELECT count(*) as task_pending
FROM `collection_task_header` a
INNER JOIN collection_task_vendors b ON a.id=b.`task_id`
INNER JOIN vendor_details c ON c.`route_id`=b.`route_id`
INNER JOIN users d ON d.id=c.user_id	
INNER JOIN vendor__routes e ON e.id=c.`route_id`  
LEFT JOIN collection_task_child f ON f.`task_id`=a.`id`  AND f.vendor_id=c.user_id
WHERE a.`collector_id`='$u_id ' AND DATE_FORMAT(task_date, '%Y-%m-%d') = '$today_date' and received_qty is null";


$task_total_1 = DB::select($task_total);
$total_tasks_completed_1 = DB::select($total_tasks_completed);
$total_tasks_pending_1 = DB::select($total_tasks_pending);


if(collect($task_total_1)->first()) {
    $results1 = json_decode(json_encode($task_total_1[0]), true);
     $task_total = $results1['task_total'];
}

if(collect($total_tasks_completed_1)->first()) {
    $results2 = json_decode(json_encode($total_tasks_completed_1[0]), true);
    $task_completed = $results2['task_completed'];
}

if(collect($total_tasks_pending_1)->first()) {
    $results3 = json_decode(json_encode($total_tasks_pending_1[0]), true);
    $task_pending = $results3['task_pending'];
}






$task_data = [
    'task_total'  => $task_total,
    'task_completed'  => $task_completed,
    'task_pending'  => $task_pending
];


 return  view('profile')->with($task_data) ;

}


}
