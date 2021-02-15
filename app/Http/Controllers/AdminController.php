<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Role;
use App\Models\User;

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
    //  echo "<pre>";
    //  print_r($Coutnts);
    //  exit;
    return view('dashBoards.admin', compact('roles','userCount'));

    }

    public function collectionManagerDashboard()
    {
    return view('dashBoards.collection-manager');
    }
}
