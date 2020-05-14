<?php

namespace App\Http\Controllers;

use App\Cart;
use Redirect;
use App\Product;
use App\Address;
use App\Contact;
use Illuminate\Http\Request;
use DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        //getting cart object
        $cart = Cart::where('user_id','=',$user->id)->get();
        //getting the cart 
        $cart = $cart->first();
        $products = [];

        if (!($cart)){
            $cart = new Cart;
            $cart->user_id = $user->id;
            $cart->save();
            return view('cart.index',[
                'products' => $products
            ]);
        }
        else {
            //an array from the cart_product table is returned
            $full_cart = DB::select('SELECT * FROM cart_product WHERE cart_id = ?', [$cart->id]);
            foreach ($full_cart as $full){
                $products[] = Product::find($full->product_id);
            }
            return view('cart.index',[
                'products' => $products
            ]);
        }
    }

    //Creating a new cart for the current user 
    public function create($id)
    {
        $product = Product::find($id);
        $user = \Auth::user();
        $cart = $user->carts;

        if ($cart){
            $this->store($product,$cart);
        }
        else {
            $cart = new Cart;
            $cart->user_id = $user->id;
            $cart->save();
            $this->store($product,$cart);
        }

        return redirect('/products/'.$id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product,Cart $cart)
    {   
        //check if the items are already in the database;
        $check = DB::select('SELECT * FROM cart_product WHERE cart_id = ? AND product_id = ?', [$cart->id, $product->id]); 
        if($check){
            return 0;
        }

        $cart->products()->attach($product->id);
        return 0;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
          
         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        if (empty($product)) {
            abort(404);
        }
        $user = \Auth::user();
        $cart = $user->carts;

        $cart->products()->detach($product->id);

        return redirect('/cart');
    }

    public function checkout(){
        $products = [];
        $user = \Auth::user();
        $cart = $user->carts;

        $full_cart = DB::select('SELECT * FROM cart_product WHERE cart_id = ?', [$cart->id]);
        foreach ($full_cart as $full){
            $products[] = Product::find($full->product_id);
        }

        return view('cart.checkout',[
            'products' => $products,
            
        ]);
    }

    public function address(Request $request){
        $this->validate($request,[
            'address'=> ['required'],
            'contact'=> ['required', 'min:10' ,'max:10']
        ]);
        
        $user = \Auth::user();
        $user->address = $request->input('address');
        $user->contact = $request->input('contact');

        $user->save();

        return redirect('/carts/checkout');
        
    }
    
    public function quantity($id,$qty){
        $user = \Auth::user();
        $cart = $user->carts;
        $product_id = $id;
        $quantity = $qty; 

        DB::update('UPDATE cart_product SET quantity = ? WHERE cart_id = ? AND product_id = ?',[$quantity,$cart->id,$product_id]);

        return json_encode('done');
    }
}
