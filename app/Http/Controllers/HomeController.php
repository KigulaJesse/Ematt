<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\District;
use App\Comment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('home','contact_us');
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
        $products = Product::where('quantity','>','0')->take(5)->latest()->get();
        $categories = Category::all()->whereNull('parent_id');
        $districts = District::whereNull('parent_id')->take(5)->latest()->get();

        return view('Product.home',[
            'products' => $products,
            'categories'=>$categories,
            'districts'=>$districts,
        ]);
    }

    public function contact_us(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'category'=>'required',
            'message'=>'required',
        ]);
        
        $comment = new Comment;
        $comment->name = $request->input('name');
        $comment->email = $request->input('email');
        $comment->category = $request->input('category');
        $comment->message = $request->input('message');
        $comment->save();
        
        $value = 'Result submitted';
        return redirect('/contact-us',[
            'message' => $value
        ]);

        
    }
}
