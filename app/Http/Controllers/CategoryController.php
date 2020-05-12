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
    public function show(Request $request)
    {
        //super category e.g phone
        
        $categories = Category::where('category_name','=',$request->input('search'))->latest();
        $categories = $categories->first();
        $products_searched_for = Product::where('product_name','=',$request->input('search'));
        $products_searched_for = $products_searched_for->get();
        $brand_searched_for = Product::where('brand','=',$request->input('search'))->latest();
        $brand_searched_for = $brand_searched_for->get();
        //dd($brand_searched_for[0]->product_name);

        $products=[];

        if($categories){
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
        }
        else if($products_searched_for){
            dd('here 1');
            $products = $products_searched_for;
        }
        else if($brand_searched_for){
            dd('here');
            dd($brand_searched_for[0]->product_name);
            $products = $brand_searched_for;
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
        $output = "";    
        $category = Category::find($id);
        $subcategories = $category->sub_category->pluck("category_name","id");
        /*if($subcategories){
            foreach ($subcategories as $subcategory) {
                $output.= '<option value = "'.$subcategory->id.'">'.$subcategory->name.'</option>';                   
            }
            return Response($output);
        }*/

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
