<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

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
    public function show(Request $request)
    {
        //super category e.g phone
        
        $categories = Category::where('category_name','=',$request->input('category'));
        $categories = $categories->first();
        $products = [];

        if(count($categories->sub_category)>0){
            foreach($categories->sub_category as $category){
                if(count($category->sub_category)>0){
                    foreach($category->sub_category as $child){
                        foreach($child->products->take(3) as $product){
                            $products[] = $product;    
                        }
                    }
                }
                else{
                    foreach($category->products->take(3) as $product){
                        $products[] = $product;
                    }                     
                }        
            }
        }
        else{
            foreach($categories->products->take(3) as $product){
                $products[] = $product;
            }
        }

        return view('Product.home',[
            'products' => $products
        ]);

        /*//sub category e.g smart_phone / basic phone
        $category_sub = Category::where('category_id','=',$category->id);
        $category_sub = $category_sub->first();
        //dd($category_sub->category_name);

        //sub sub category e.g IOS / android
        $category_sub_sub = Category::where('category_id','=',$category_sub->id);
        $category_sub_sub = $category_sub_sub->first();        
        //dd($category_sub_sub->category_name);

        $category_sub_sub_sub = Category::where('category_id','=',$category_sub_sub->id);
        dd($category_sub_sub_sub->first());
        $category_sub_sub_sub = $category_sub_sub_sub->first();        
        //dd($category_sub_sub->category_name);

        $products = $category_sub_sub->products;
        return view('Product.home',[
            'products' => $products
        ]);*/

        

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
}
