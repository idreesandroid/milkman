<?php 
use Illuminate\Support\Facades\DB;



if(!function_exists('next_hierarchy')){
function next_hierarchy($current_role){

    $next_role = "SELECT MAX(role_id)next_role_id FROM roles WHERE role_id < $current_role ";
    $next_role_rs = DB::select($next_role);
    
    if(collect($next_role_rs)->first()) {
        $next_role_result = json_decode(json_encode($next_role_rs[0]), true);
        $next_role_id = $next_role_result['next_role_id'];
    }
    return  $next_role_id;

}
}


if(!function_exists('previous_hierarchy')){
    function previous_hierarchy($current_role){
    
        $pre_role = "SELECT MIN(role_id)pre_role_id FROM roles WHERE role_id > $current_role ";
        $pre_role_rs = DB::select($pre_role);
        
        if(collect($pre_role_rs)->first()) {
            $pre_role_result = json_decode(json_encode($pre_role_rs[0]), true);
            $pre_role_id = $pre_role_result['pre_role_id'];
        }
        return  $pre_role_id;
    
    }
    }




?>