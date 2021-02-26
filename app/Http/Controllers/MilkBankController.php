<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\milkCollectionPoint;
use App\Models\Collection;
use App\Models\User;
use App\Models\TaskArea;
use App\Models\collectorDetail;
use App\Models\collectionPointManager;
use App\Models\milkmanAsset;
use App\Models\collectionPointSubmission;
use App\Models\milkBank;
use App\Models\milkBankSubmission;


class MilkBankController extends Controller
{
    //milkBank point-----------------------------------------------------------

public function milkBankManagerDashboard()
{
    return view('dashBoards.milkBank-manager');
}

public function milkBankIndex()
{  
 $milkBanks = DB::table('milk_banks')
 ->select('milk_banks.id','bankName','bankAddress')
 ->get();

//  echo "<pre>";
//  print_r($collectionPoints);
//  exit;
   return view('milkBank/index', compact('milkBanks'));
}

public function milkBankCreate() 
{       
    return view('milkBank/create');
}

public function milkBankStore(Request $request)
{    
    $this->validate($request,[      
        'bank_name'=>   'required',
        'bank_address'=>'required',
     ]);     
    $banks = new milkBank();
    $banks->bankName = $request->bank_name;        
    $banks->bankAddress = $request->bank_address;
    $banks->save();
    return redirect()->route('index.milkBank');
}

public function milkBankEdit($id)
{
    $banks = milkBank::findOrFail($id);
    return view('milkBank/edit', compact('banks'));
}

public function milkBankUpdate(Request $request, $id)
{
    $updatedata = $request->validate([
        'bankName' => 'required',
        'bankAddress'=>'required', 
    ]);
    milkBank::whereid($id)->update($updatedata);
    return redirect()->route('index.milkBank');
}

public function milkBankDelete($id)
{
    $points = milkBank::findOrFail($id);
    $points->delete();
    return redirect()->route('index.milkBank');
}


public function getCollectionManager()
{  

    $collectionManagers = User::whereHas('roles', function($query) {$query->where('roles.id', 4);})->get();   
   
    // $collectionManagers = DB::table('collection_point_managers')
    // ->select('user_id','managerStatus','name','users.id','user_phone')
    // ->where('managerStatus','inActive')
    // ->join('users','user_id','=','users.id')
    // ->get();
    return $collectionManagers;
}


public function assignCollectionManager(Request $request)
{   
    $this->validate($request,[      
        'pId'=>   'required',
        'manager_id'=>'required',
     ]);
//  echo "<pre>";
//  print_r($request->all());
//  exit;
$var1= $request->pId;
$var2= $request->manager_id;
DB::update("UPDATE milk_banks SET bankManager_id = $var2 WHERE id = $var1");
return redirect()->route('index.milkBank');
}


public function pointCollection()
{  
   $collectionPoints = DB::table('milk_collection_points')
   ->select('id','pointName','pointAddress','totalMilk')
   ->get();
    //  echo "<pre>";
    //  print_r($collectionManagers);
    //  exit;
    return view('milkBank/milkSubmission', compact('collectionPoints'));
}

public function checkQuantity($id)
{  
   $milkAvailable = DB::table('milk_collection_points')
   ->select('id','pointName','pointAddress','totalMilk')
   ->where('id',$id)
   ->first();
   $totalMilk = $milkAvailable->totalMilk;
    //  echo "<pre>";
    //  print_r($milkAvailable);
    //  exit;
    return $totalMilk;
}


public function pointSubmission(Request $request)
{
    //  echo "<pre>";
    //  print_r($request->all());
    //  exit;

    $this->validate($request,[
        'point_id'=> 'required',
        'totalMilk'=>'required', 
        'totalFat'=> 'required', 
        'totalAsh'=> 'required',
        'totalProteins'=>'required',
        'totalLactose'=> 'required',
        'D_Shot'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
 
    
    $collectionManagers = DB::table('collection_point_managers')
    ->select('user_id','collectionPointId')
    ->where('collectionPointId', $request->point_id)
    ->first();
    
    $possibleQuantity = DB::table('milk_collection_points')
    ->select('totalMilk','milkBank_Id')
    ->where('id', $collectionManagers->collectionPointId)
    ->first();

    if($request->totalMilk > 0 && $request->totalMilk <= $possibleQuantity->totalMilk)
    {
    // echo "<pre>";
    // print_r($collectionManagers->user_id);
    // exit;
    $submission = new milkBankSubmission();
    $submission->milkBank_id = $possibleQuantity->milkBank_Id;
    $submission->collectionPoint_id = $request->point_id;        
    $submission->collectionManager_id = $collectionManagers->user_id;
    $submission->milkCollected = $request->totalMilk;        
    $submission->averageFat = $request->totalFat;
    $submission->averageAsh = $request->totalAsh;        
    $submission->averageProteins = $request->totalProteins;
    $submission->averageLactose = $request->totalLactose;       
    $submission->averageSolids = ($request->totalFat + $request->totalAsh + $request->totalProteins + $request->totalLactose)/4;    

    $imageName = time().'.'.$request->D_Shot->extension();    
    $request->D_Shot->move(public_path('milkQuality_img'), $imageName);
    $submission->Quality_SS = $imageName;
    $submission->save();

    DB::update("UPDATE milk_collection_points SET `totalMilk` = totalMilk-$request->totalMilk WHERE `id` = $request->point_id");
    DB::update("UPDATE milk_banks SET `milkAvailable` = milkAvailable+$request->totalMilk WHERE `id` = $possibleQuantity->milkBank_Id");

    return redirect()->route('user.dashBoard');
    }
    else
    {
        return redirect()->back()->with('alert', "You are Entering Wrong Information");
    }
}







}
