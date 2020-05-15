<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\District;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     * 
     */

    public function index(){
        
        $products = Product::take(9)->latest()->get();
        
        return view('Home.index',[
            "products"=>$products,
        ]);

    }

    public function home()
    {
        $products = Product::take(9)->latest()->get();
        $categories = Category::all()->whereNull('parent_id');
        $districts = District::take(9)->latest()->get();

        return view('Product.home',[
            'products' => $products,
            'categories'=>$categories,
            'districts'=>$districts,
        ]);
    }
}
