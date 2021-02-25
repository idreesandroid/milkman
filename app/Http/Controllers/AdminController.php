<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Role;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        $roles = Role::get();

        foreach($roles as $role)       
        {
            $roleId=$role->id;
                
            $user = User::whereHas('roles', function($query) use($roleId) {$query->where('roles.id', $roleId);})->get()->toArray();  
            $userCount[] = count($user);
        }

        $products = Product::select('id','product_name')->get();
        $totalOrders = [];
        $productids = [];
        $productNames = [];
        foreach($products as $item){

            array_push($productids, $item->id);
            array_push($productNames, $item->product_name);

            $orders = Cart::where('product_id',$item->id)
                            ->where('created_at','>=',date('Y-m-d'))
                            ->sum('product_quantity');
            array_push($totalOrders, $orders);
        }


        $first_day_this_month  = date('Y-m-01');
        $current_day_this_month = date('Y-m-d');

        $periods = createDateRangeArray($first_day_this_month,$current_day_this_month);        

        $productsDetail = '[';        
        foreach($periods as $period){
            $pro = '';
            $pro .= '{date:'."'".$period."'".',';
            
            foreach($productids as $key => $productid){

                $total = '';

                $products = Cart::select('carts.product_id','carts.created_at','products.product_name')
                                    ->leftJoin('products','products.id','=','carts.product_id')
                                    ->where('carts.product_id', $productid)
                                    ->where('carts.created_at', 'like', '%' . $period . '%')
                                    ->get();

                $total = Cart::where('product_id', $productid)
                                ->where('created_at', 'like', '%' . $period . '%')
                                ->sum('product_quantity');

                if(empty($products->count())){
                    $pro .= "'".$productNames[$key]."' : ". $total.",";
                }else{
                    $pro .= "'".$productNames[$key]."' : ". $total.",";
                }
            }
            $newpro='';
            $newpro .= rtrim($pro, ","); 
            $newpro .= '},';
            $productsDetail .= $newpro;
        }

    $productsDetail .= ']'; 

    $productsDetail = str_replace("},]","}]",$productsDetail);



        return view('dashBoards.admin', compact('roles','userCount','products','totalOrders','productsDetail','productNames'));

    }

    public function collectionManagerDashboard()
    {
        return view('dashBoards.collection-manager');
    }
}
