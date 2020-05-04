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

        $categories = Category::all()->whereNull('category_id');
        return view('Product.home',[
            'products' => $products,
            'categories' => $categories
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
        $category = Category::find($id);
        $subcategories = $category->sub_category->pluck("category_name","id");
        return json_encode($subcategories);
    }

}
