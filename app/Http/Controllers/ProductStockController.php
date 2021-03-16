<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\milkProcess;
class ProductStockController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {  
    
       $product_stocks = ProductStock::where('deleted_at', null)->with('product','Manager')->get();
       return view('product-stock/index', compact('product_stocks'));
    }
    
    public function create() 
    {       
        $products= Product::select('product_name','id')->get();
        return view('product-stock/create',compact('products'));
    }


    public function store(Request $request)
    {


        $this->validate($request,[      
            'product_id'=> 'required',
            'manufactured_date'=>'required|date',
            'expire_date'=>'required|date|after_or_equal:manufactured_date',
            'manufactured_quantity'=>'required',   
            'milkRequestCode' =>'required'    
         ]);

            if (allotmentNoExist($request->milkRequestCode))
             {
      
                $mid = Auth::id();
                $Request_codes = milkProcess::where('alotment_code',$request->milkRequestCode)->first();
                $requestId=$Request_codes->id;
    
                $product_codes = Product::where('id',$request->product_id)->select('product_nick','id')->first();
                $product_code =$product_codes->product_nick;
    
                $product_stocks = new ProductStock();
                $product_stocks->product_id = $request->product_id;        
                $product_stocks->batch_name = $product_code.'#'.date('Y-m-d').time();
                $product_stocks->manufactured_date = $request->manufactured_date;
                $product_stocks->expire_date = $request->expire_date;
                $product_stocks->manufactured_quantity = $request->manufactured_quantity;
                $product_stocks->stockInBatch = $request->manufactured_quantity;
                $product_stocks->milkAlotment_no = $requestId;
                $product_stocks->user_id  =$mid; //it should be come from session
    
                $product_stocks->save();
    
                return redirect('product-stock/index');
               
        } else {
            return redirect()->back()->with('alert', 0);
        }
    }

    public function edit($id)
    {
        $product_stocks = ProductStock::findOrFail($id);
        $products= Product::select('product_name','id')->get();
        return view('product-stock/edit', compact('product_stocks','products'));
    }

    public function update(Request $request, $id)
    {
        $updatedata = $request->validate([
            'product_id'=> 'required',
            'manufactured_date'=>'required|date',
            'expire_date'=>'required|date|after_or_equal:manufactured_date',
            'manufactured_quantity'=>'required'  
        ]);

        $productStocks = ProductStock::find($id);
        $productStocks->product_id=$request->product_id;
        $productStocks->manufactured_date=$request->manufactured_date;
        $productStocks->expire_date=$request->expire_date;
        $productStocks->manufactured_quantity=$request->manufactured_quantity;
        $productStocks->stockInBatch=$request->manufactured_quantity;
        $productStocks->save();
        
        ProductStock::whereid($id)->update($updatedata);
        return redirect('product-stock/index');
    }

    public function deleteProductStock($id)
    {
        $product_stocks = ProductStock::findOrFail($id);
        $checkInBatches = ProductStock::where('id', $id)->first();
        $checkInBatch = $checkInBatches->stockInBatch;
        
        if($checkInBatch == 0)
        {
        $product_stocks->delete();
        }
        else
        {
            return "Still You Have Some Product In Stock for Sale";
        }
        return redirect('product-stock/index');
    }
}
