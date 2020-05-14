<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Product;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
              
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request){

        /*SEARCH BUY BRAND AND STORE PRODUCTS */
        $products = Product::where('brand','=',$request->input('search'))->get();

        if(count($products) == 0){
            $products = Product::where('product_name','=',$request->input('search'))->get();
        }
        if(count($products) == 0){
            $category = Category::where('category_name','=',$request->input('search'))->get()->first();
            if($category != null ){
                $products = $category->products;
            }
        }
    
        $categories = Category::all()->whereNull('parent_id');
        return view('Product.home',[
            'products' => $products,
            'categories' => $categories,
            'searched' => $request->input('search')
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
    public function get_sub_category($id){
        $output = "";    
        $category = Category::find($id);
        $subcategories = $category->sub_category->pluck("category_name","id");
        
        return json_encode($subcategories);
    }

    public function search(Request $request){
        if($request->ajax()){
            $output="";
            $products = Product::where('product_name','LIKE','%'.$request->input('search')."%")->get();
            if($products){
                foreach ($products as $key => $product) {
                    $output.= '<p style ="color:black;">'.$product->product_name.'</p>';                    
                }
                return Response($output);
            }

        }
    }

}
