<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
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
        if (!($cart)){
            $cart = new Cart;
            $cart->user_id = $user->id;
            $cart->save();
            return view('cart.index');
        }
        else {
            //an array from the cart_product table is returned
            $products = [];
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
        DB::insert('INSERT INTO cart_product (cart_id,product_id) VALUES (?,?)', [$cart->id, $product->id]);
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

        DB::delete("DELETE FROM cart_product WHERE cart_id = ? AND product_id = ?", [$cart->id,$product->id]);

        return redirect('/cart');
    }

    public function checkout(){
        return view('cart.checkout');
    }

    public function checkout_processing(){
        
    }
}
