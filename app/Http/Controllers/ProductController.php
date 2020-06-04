<?php

namespace App\Http\Controllers;

use App\Product;
use App\District;
use App\Category;
use Illuminate\Http\Request;
use App\Traits\ImageUpload;
use Image;
use File;
use DB;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('home','show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $products = $user->products;
        return view('Product.seller.index',[
           'products' => $products
       ]);
    }

    
    /**
     * Used to display form for creating a new product
     *
     * @return \Illuminate\Http\Response
     */

    public function create(){
        $categories = Category::all()->whereNull('parent_id');   
        return view('Product.seller.create',[
            'categories' => $categories
        ]);
    }

    public function orders(){

        $user       = \Auth::user();
        $products   = $user->products; //used to get all products of this user
        $orders     = []; //empty array where will store all orders that are for this users products

        foreach($products as $product){
            foreach($product->carts as $order){
                if(($order->pivot->ordered == "yes") and ($order->pivot->delivered == null) ){
                    $orders[] = $order;
                }
            }
        }

        return view('Product.seller.orders',[
            'orders'=>$orders
        ]);
    }

    public function ordered(){
        $user       = \Auth::user();
        $products   = $user->products; //used to get all products of this user
        $ordered     = []; //empty array where will store all orders that are for this users products

        foreach($products as $product){
            foreach($product->carts as $order){
                if(($order->pivot->ordered == "yes") and ($order->pivot->delivered == 'yes') ){
                    $ordered[] = $order;
                }
            }
        }

        return view('Product.seller.ordered',[
            'ordered'=>$ordered
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        $this->validate($request,[
            'product_name'=> ['required', 'max:20'],
            'terms'=>'required',
            'category'=>'required',
            'quantity'=>'required',
            'condition'=>'required',
            'price'=>'required',
            'short'=>'max:90',
            
            'files' => 'required',
            'files.*' =>'|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        if(preg_match("/^[0-9,]+$/", $request->input('price'))){ 
            $fee = str_replace(',','',$request->input('price'));
        }
        
        $user = \Auth::user();
        $product = new Product;
        $product->product_name = $request->input('product_name');
        $product->price = $fee;
        $product->user_id = $user->id;
        $product->quantity= $request->input('quantity');
        $product->brand = $request->input('brand');
        $product->condition = $request->input('condition');
        $product->color = $request->input('color');
        $product->short_description = $request->input('short');
        $product->long_description = $request->input('long');
        //This persists the product in the database i.e saves the data into the database
        $product->save();

        $category = Category::find($request->input('category'));
        $category->products()->attach($product->id);

        if($request->input('subcategory')){
            $subcategory = Category::find($request->input('subcategory'));
            $subcategory->products()->attach($product->id);
        }    
    
        if ($files = $request->file('files')){
            $destinationPath         =       public_path('/images/products');
            $path                    =       $destinationPath.'/'.$product->id;
            File::makeDirectory($path);
            $x = 1;
            $count=1;
            foreach($files as $file){
                $image                   =       $file; 
                $img                     =       Image::make($image);
                $img->resize(480,480)->save($path.'/'.$x.'.jpg');
                $x = $x + 1;
                $count = $count + 1;
                if($count > 5){ break;}
            }
            
            
            
            
        }

        return redirect('/products');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {     
        $user = $product->user;
        $destinationPath         =       public_path('/images/products');
        $path                    =       $destinationPath.'/'.$product->id;

        $images = File::allFiles($path);

        return view('Product.show',[
            'product'=>$product,
            'user' => $user,
            'images'=> $images
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all()->whereNull('parent_id');
        $super_category = $product->category->whereNull('parent_id')->first();
        $chosen_sub = $product->category->whereNotNull('parent_id')->first();
        $child_categories = $super_category->sub_category;
        $destinationPath         =       public_path('/images/products');
        $path                    =       $destinationPath.'/'.$product->id;
        $images = File::allFiles($path);

        return view('Product.seller.update',[
            'product'=>$product,
            'categories'=>$categories,
            'super_category'=>$super_category,
            'child_categories'=> $child_categories,
            'chosen_sub'=>$chosen_sub,
            'images'=> $images
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request,[
            'product_name'=> ['required', 'max:20'],
            'quantity'=>'required',
            'condition'=>'required',
            'price'=>'required',
            'category'=>'required',
            'short'=>'max:90',
        ]);
    
        $user = \Auth::user();
        DB::delete('DELETE FROM category_product WHERE product_id = ?',[$product->id]);
        
        $product->product_name = $request->input('product_name');
        $product->price = $request->input('price');
        $product->quantity= $request->input('quantity');
        $product->brand = $request->input('brand');
        $product->condition = $request->input('condition');
        $product->color = $request->input('color');
        $product->short_description = $request->input('short');
        $product->long_description = $request->input('long');
            
        //This persists the product in the database
        $product->save();

        //Updates the category of the product
        $category = Category::find($request->input('category'));
        $category->products()->attach($product->id);

        if($request->input('subcategory')){
            $subcategory = Category::find($request->input('subcategory'));
            $subcategory->products()->attach($product->id);
        } 

        return redirect('/products');
        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (empty($product)) {
            abort(404);
        }

        $check = DB::select("SELECT * FROM cart_product WHERE product_id = ? AND ordered = 'yes'",[$product->id]);
        if($check){
            return redirect()->back()->with('order_status','Someone ordered item, cannot delete');
        }
        else{
            $destinationPath         =       public_path('/images/products');
            $path                    =       $destinationPath.'/'.$product->id;
        
            $rm =$this->deleteDirectory($path);
        
            $product->delete()->with('order_status','Deleted a product');
        }

        return redirect('/products');
    }

    public function deleteDirectory($dir) {
        if (!file_exists($dir)) {
            return true;
        }
    
        if (!is_dir($dir)) {
            return unlink($dir);
        }
    
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
    
            if (!($this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item))) {
                return false;
            }
    
        }
    
        return rmdir($dir);
    }

    
}
