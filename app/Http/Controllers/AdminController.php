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
        foreach($products as $item){
            $orders = Cart::where('product_id',$item->id)
                            ->where('created_at','>=',date('Y-m-d'))
                            ->sum('product_quantity');
            array_push($totalOrders, $orders);
        }

        return view('dashBoards.admin', compact('roles','userCount','products','totalOrders'));

    }


}
