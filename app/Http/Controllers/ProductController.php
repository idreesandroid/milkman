<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductStock;
class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {       
       $products_rs = "SELECT id, product_name, product_nick, product_size, product_price,product_description, unit,  ctn_value, filenames,
       (SELECT IFNULL(SUM(stockInBatch),0)  FROM product_stocks WHERE stockInBatch>0 and product_id=a.id)stockInBatch
        FROM products a";    
        $products = DB::select($products_rs);

       return view('product.index', compact('products'));
    }
    
    public function create() 
    {
        $units = ['ml','ltr','gm','kg'];
        return view('product/create',compact('units'));  
    }

    public function store(Request $request)
    {    
        $this->validate($request,[      
            'product_name'=> 'required|unique:products',
            'product_nick'=>'required',
            'product_size'=>'required',
            'product_price'=>'required|numeric',
            'product_description'=>'required',
            'unit'=>'required',
            'ctn_value'=>'required|numeric',
            'filenames' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',    
         ]);     

        $products = new Product();

        $products->product_name = $request->product_name." ".$request->product_size.$request->unit    ;        
        $products->product_nick = $request->product_nick;
        $products->product_size = $request->product_size;
        $products->product_price = $request->product_price;
        $products->product_description = $request->product_description;
        $products->unit = $request->unit;
        $products->ctn_value = $request->ctn_value;
        $imageName = time().'.'.$request->filenames->extension();    
        $request->filenames->move(public_path('product_img'), $imageName);

        $products->filenames = $imageName;

        $products->save();

        return redirect('product/index');

    }

    public function edit($id)
    {
        $units = ['ml','ltr','gm','kg'];
        $products = Product::findOrFail($id);
        return view('product/edit', compact('products','units'));
    }


    public function update(Request $request, $id)
    {
        $updatedata = $request->validate([
            'product_name'=> 'required',
            'product_nick'=>'required',
            'product_size'=>'required',
            'product_price'=>'required',
            'product_description'=>'required',
            'unit'=>'required',
            'ctn_value'=>'required' 
        ]);

        $filenametostore='';

        if($request->hasFile('filenames')) {

            $destinationPath = public_path('product_img');
            $dealer_logo = $request->file('filenames');
            //get filename with extension
            $filenamewithextension = $request->file('filenames')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('filenames')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            //Upload File
            //$request->file('dealer_logo')->storeAs('public/dealerLogo', $filenametostore);
            $dealer_logo->move($destinationPath, $filenametostore);

        }

        if($filenametostore){
            $updatedata = array_merge($updatedata, array("filenames" => $filenametostore));
        }

        Product::whereid($id)->update($updatedata);
        return redirect('product/index');

    }

    public function deleteProduct($id)
    {
        $products = Product::findOrFail($id);
        $products->delete();
        return redirect('product/index');
    }


    public function productDetail(Request $request){
        $productDetail = Product::findOrFail($request->productID);
        return $productDetail;
    }

    public function productAnalysis(){
        $products = Product::select('products.id',
                                    'products.product_name',
                                    'products.product_price',
                                    'carts.created_at as orderdate',
                                    'carts.product_quantity as orderquentity')
                            ->join('carts','carts.product_id','=','products.id')
                            ->get();

        $product_stocks = ProductStock::select('product_stocks.product_id',
                                        'product_stocks.manufactured_quantity as mfquentity',
                                        'product_stocks.created_at as stockDate',
                                        'products.product_name',
                                        'products.product_price')
                                        ->join('products','products.id','=','product_stocks.product_id')
                                        ->get();

        return view('product/analysis',compact('products','product_stocks'));
    }
}
