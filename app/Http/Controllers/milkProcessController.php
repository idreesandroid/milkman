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
use App\Models\milkProcess;
use App\Models\Product;
use App\Models\milkbankManager;
class milkProcessController extends Controller
{
    public function milkProcessManagerDashboard()
    {
        return view('dashBoards.milkProcess-manager');
    }

    public function milkRequestCreate()
    {
        $products= Product::select('product_name','id')->get();
        $milkBanks= milkBank::select('bankName','id')->get();
        return view('milk-process.milkProcessRequest',compact('products','milkBanks'));
    }

    public function storeMilkRequest(Request $request)
    {
        $this->validate($request,[      
            'product_id'=> 'required',
            'milkBank_id'=> 'required',
            'processDescription'=>'required',
            'milkQuantity'=>'required',      
         ]);

         $mid = Auth::id();
        $milkRequest = new milkProcess();        
        $milkRequest->milkBankId = $request->milkBank_id;   
        $milkRequest->product_id = $request->product_id;        
        $milkRequest->alotment_code = milkRequestCode();
        $milkRequest->milkQuantity = $request->milkQuantity;
        $milkRequest->processDescription = $request->processDescription;
        $milkRequest->processManager_id = $mid;
        $milkRequest->milkRequestStatus = 'Requested';
        $milkRequest->save();

        //$product_stocks->users($mid);
        return redirect('/DashBoard');
    }


    public function requestedMilkList()
    {  
    $roleArray= auth()->user()->roles()->pluck('roles.id')->toArray();
          
    if(in_array(4, $roleArray))
    { 
        $Mid = Auth::id();
        $CPM = milkbankManager::where('user_id',$Mid)->where('manager_status','Active')->where('milkbank_id','<>',  null)->first();
        $BID = $CPM->milkbank_id;
       
        // echo "<pre>";
        // print_r($BID);
        // exit;
   
    //  $milkRequests = DB::table('milk_processes')
    //                     ->select('milk_processes.id',
    //                                     'alotment_code',
    //                                     'milkQuantity',
    //                                     'rejectionReason',
    //                                     'milkRequestStatus',
    //                                     'processDescription',
    //                                     'users.name as processManager',
    //                                     'bankName',
    //                                     'usr.name as bankMangerName')
    //                     ->where('milkBankId',$BID)
    //                     ->leftJoin('users','milk_processes.processManager_id','=','users.id')
    //                     ->leftJoin('milkbank_managers','milk_processes.milkBankManager_id','=','milkbank_managers.user_id')
    //                     ->leftJoin('users as usr','usr.id','=','milkbank_managers.user_id')    
    //                     ->leftjoin('milk_banks','milk_processes.milkBankId','=','milk_banks.id')
    //                     ->get();

       $milkRequests = DB::table('milk_processes')
                        ->select('milk_processes.id',
                                        'alotment_code',
                                        'milkQuantity',
                                        'rejectionReason',
                                        'milkRequestStatus',
                                        'processDescription',
                                        'users.name as processManager',
                                        'bankName',
                                        'usr.name as bankMangerName')
                        ->where('milkBankId',$BID)
                        ->leftJoin('users','milk_processes.processManager_id','=','users.id')
                        ->leftJoin('milkbank_managers','milk_processes.milkBankManager_id','=','milkbank_managers.user_id')
                        ->leftJoin('users as usr','usr.id','=','milk_processes.milkBankManager_id')    
                        ->leftjoin('milk_banks','milk_processes.milkBankId','=','milk_banks.id')
                        ->get();
    //  echo "<pre>";
    //  print_r($milkRequests);
    //  exit;
       return view('milk-process/index', compact('milkRequests'));

    }
    }

    public function requestApproved($id)
    {  
        $mid = Auth::id();
        DB::update("UPDATE milk_processes SET milkRequestStatus = 'Granted' , milkBankManager_id = $mid  WHERE id = $id");
        return redirect()->route('user.dashBoard');
    }

    public function requestReject(Request $request)
    {  
        $mid = Auth::id();
        $this->validate($request,[      
            'pId'=> 'required',
            'rejectionReason'=> 'required',  
         ]);
//    echo "<pre>";
//      print_r($request->all());
//      exit;
        $var1 = $request->pId;
        $var2 = $request->rejectionReason;

        $mid = Auth::id();
        DB::update("UPDATE milk_processes SET milkRequestStatus = 'Rejected' , rejectionReason = '$request->rejectionReason' , milkBankManager_id = $mid  WHERE id = $request->pId");
        return redirect()->route('user.dashBoard');
    }





    public function milkRequestedList()
    {  
        // echo "<pre>";
        // print_r($BID);
        // exit;
       $milkRequests = DB::table('milk_processes')
                        ->select('milk_processes.id',
                                        'alotment_code',
                                        'milkQuantity',
                                        'rejectionReason',
                                        'milkRequestStatus',
                                        'processDescription',
                                        'users.name as processManager',
                                        'bankName',
                                        'usr.name as bankMangerName')
                        ->leftJoin('users','milk_processes.processManager_id','=','users.id')
                        ->leftJoin('milkbank_managers','milk_processes.milkBankManager_id','=','milkbank_managers.user_id')
                        ->leftJoin('users as usr','usr.id','=','milk_processes.milkBankManager_id')    
                        ->leftJoin('milk_banks','milk_processes.milkBankId','=','milk_banks.id')
                        ->get();
        //  echo "<pre>";
        //  print_r($milkRequests);
        //  exit;
       return view('milk-process/index', compact('milkRequests'));

    }

}
