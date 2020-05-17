<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Product;
use App\District;
use App\User;

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
    public function showbyuser($id){
        $user = User::find($id);
        $products = $user->products;

        $districts = District::take(9)->latest()->get();
        $categories = Category::all()->whereNull('parent_id');
        return view('Product.home',[
            'products' => $products,
            'categories' => $categories,
            'searched' => $user->name,
            'districts'=> $districts
        ]);
    }

    public function showbydistrict($id){
        $district = District::find($id);
        $users = $district->users;
        $products = [];
        //dd($users[0]->products);
        foreach($users as $user){
            foreach($user->products as $product){
                $products[]=$product;
            }
        }
        $districts = District::take(9)->latest()->get();
        $categories = Category::all()->whereNull('parent_id');
        return view('Product.home',[
            'products' => $products,
            'categories' => $categories,
            'searched' => $district->district_name,
            'districts'=> $districts
        ]);
        
    }

    public function showcategory($name){

        $category = Category::where('category_name','LIKE','%'.$name.'%')->get()->first();
            if($category != null ){
                $products = $category->products;
            }
        $districts = District::take(9)->latest()->get();
        $categories = Category::all()->whereNull('parent_id');
        return view('Product.home',[
            'products' => $products,
            'categories' => $categories,
            'searched' => $name,
            'districts'=> $districts
        ]);
        
    }
    public function show(Request $request){

        $search = $request->input('search');

        /*SEARCH BUY BRAND AND STORE PRODUCTS */
        $products = Product::where('brand','LIKE','%'.$search.'%')->get();

        if(count($products) == 0){
            $products = Product::where('product_name','LIKE','%'.$search.'%')->get();
        }
        if(count($products) == 0){
            $category = Category::where('category_name','LIKE','%'.$search.'%')->get()->first();
            if($category != null ){
                $products = $category->products;
            }
        }
        if(count($products)==0){
            $users = User::where('name','LIKE','%'.$search.'%')->get();
            foreach($users as $user){
                foreach($user->products as $product){
                    $products[]=$product;
                }
            }    
        }
        
        $districts = District::take(9)->latest()->get();
        $categories = Category::all()->whereNull('parent_id');
        return view('Product.home',[
            'products' => $products,
            'categories' => $categories,
            'searched' => $request->input('search'),
            'districts'=> $districts
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
