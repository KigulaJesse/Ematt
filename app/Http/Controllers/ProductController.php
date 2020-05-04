<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Image;
use File;
use App\Category;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $products = $user->products;
        return view('Product.index',[
           'products' => $products
       ]);
    }

    
    public function home(){
        
        $products = Product::take(9)->latest()->get();
        $categories = Category::all()->whereNull('category_id');
        return view('Product.home',[
            'products' => $products,
            'categories' => $categories
        ]);
    }
    /**
     * Used to display form for creating a new product
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::all();
        return view('Product.create',[
            'categories' => $categories
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
            'product_name'=> ['required', 'max:255'],
            'category'=>'required',
            'quantity'=>'required',
            'condition'=>'required',
            'price'=>'required',
            'short'=>'max:30',
            'file-upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        $user = \Auth::user();
        $product = new Product;
        $product->product_name = $request->input('product_name');
        $product->price = $request->input('price');
        $product->user_id = $user->id;
        $product->quantity= $request->input('quantity');
        $product->brand = $request->input('brand');
        $product->condition = $request->input('condition');
        $product->color = $request->input('color');
        $product->short_description = $request->input('short');
        $product->long_description = $request->input('long');
        $product->category_id= $request->input('category');
            
        //This persists the product in the database
        $product->save();

        if ($request->hasFile('file-upload')){
            
            $image                   =       $request->file('file-upload'); 
            $img                     =       Image::make($image);
            $destinationPath         =       public_path('/images/products');
            $path                    =       $destinationPath.'/'.$product->id;
            File::makeDirectory($path);
            
            $img->resize(480,480)->save($path.'/1.jpg');
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
        return view('Product.show',[
            'product'=>$product,
            'user' => $user
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
        return view('Product.update',[
            'product'=>$product
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
        //
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

        $destinationPath         =       public_path('/images/products');
        $path                    =       $destinationPath.'/'.$product->id;
        
        $rm =$this->deleteDirectory($path);

        $product->delete();

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
