<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\assetsType;
use App\Models\milkmanAsset;
use App\Models\User;
class AssetController extends Controller
{
    public function listType()
    {  
       $assetTypes = assetsType::all();
       return view('milkman-asset/type-list', compact('assetTypes'));
    }

    public function createType() 
    { 
        return view('milkman-asset/type-create');
    }

    public function storeType(Request $request)
    {
        $this->validate($request,[      
            'type_name'=> 'required',
            'type_unit'=>'required',
            'type_description'=>'required',        
         ]);

        $Type = new assetsType();

        $Type->typeName = $request->type_name;        
        $Type->assetUnit = $request->type_unit;
        $Type->description = $request->type_description;
        $Type->save();
        return redirect()->route('list.type');
    }

    public function editType($id)
    {
        $Types = assetsType::findOrFail($id);
        return view('milkman-asset/type-edit', compact('Types'));
    }

    public function updateType(Request $request, $id)
    {

        $updatedata = $request->validate([
            'typeName'=> 'required',
            'assetUnit'=>'required',
            'description'=>'required',
        ]);
        assetsType::whereid($id)->update($updatedata);
        return redirect()->route('list.type');
    }

    public function deleteType($id)
    {
        $product_stocks = assetsType::findOrFail($id);
        $product_stocks->delete();
        return redirect()->route('list.type');
    }


    //asset----------------------------------------


    public function listAsset()
    {  
       $Assets = milkmanAsset::with('assetType','assetAssignTo')->get();
       return view('milkman-asset/asset-list', compact('Assets'));
    }

    public function createAsset() 
    { 
        $types= assetsType::select('typeName','id')->get();
        return view('milkman-asset/asset-create',compact('types'));
    }

    public function storeAsset(Request $request)
    {
        $this->validate($request,[      
            'type_id'=> 'required',
            'assetCapacity'=>'required',       
         ]);

        $assetCod=generateAssetCode();
        
        $Asset = new milkmanAsset();
        $Asset->type_id = $request->type_id;        
        $Asset->assetCode = $assetCod;
        $Asset->assetCapacity = $request->assetCapacity;
        $Asset->save();
        return redirect()->route('list.asset');
    }

    public function editAsset($id)
    {
        $Assets = milkmanAsset::findOrFail($id);
        $types= assetsType::select('typeName','id')->get();
        return view('milkman-asset/asset-edit', compact('Assets','types'));
    }

    public function updateAsset(Request $request, $id)
    {

        $updatedata = $request->validate([
            'type_id'=> 'required',
            'assetCapacity'=>'required',
        ]);
        milkmanAsset::whereid($id)->update($updatedata);
        return redirect()->route('list.asset');
    }

    public function deleteAsset($id)
    {
        $product_stocks = milkmanAsset::findOrFail($id);
        $product_stocks->delete();
        return redirect()->route('list.asset');
    }
}
