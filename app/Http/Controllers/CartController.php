<?php

namespace App\Http\Controllers;

use App\Cart;
use Redirect;
use App\Product;
use App\Address;
use App\Contact;
use Illuminate\Http\Request;
use DB;
use App\District;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
            $full_cart = DB::select('SELECT * FROM cart_product WHERE cart_id = ? AND ordered is null', [$cart->id]);
            
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
            $num = $this->store($product,$cart);
            if($num == 1){
                $status = "This product has been added to cart";
            }
            else{
                $status = "This product is already in cart";
            }
        
        }
        else {
            $cart = new Cart;
            $cart->user_id = $user->id;
            $cart->save();
            $this->store($product,$cart);
            $status = "This product has been added to cart";
        }

        return redirect()->back()->with('cart add',$status);
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

        $cart->products()->attach($product->id,['quantity'=>1]);
        return 1;
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
        
    }

    public function order(Cart $cart){

        $user = \Auth::user();
        
        //check if the items are already in the database;
        $check = DB::select('SELECT * FROM cart_product WHERE cart_id = ? AND ordered is null', [$cart->id]);
         
        if(!$check){
            return redirect('/cart')->with('status_placed_order','You already placed that order');
        }

        if($user->district_id == null){
            return redirect('/carts/checkout')->with('error_status','*Please add an address first');
        }

        if($user->payment_type == null){
            return redirect('/carts/checkout')->with('error_payment','*Please choose a payment option first');
        }
        else {
            DB::update('UPDATE cart_product SET ordered = "yes" WHERE cart_id = ?',[$cart->id]);
            return redirect('/cart')->with('status','Order confirmed');
        }
    }

    public function payment(Request $request){
        
        $this->validate($request,[
            'payment'=> ['required']
        ]);

        $user = \Auth::user();
        $user->payment_type = $request->input('payment');
        $user->save();
        
        return redirect('/carts/checkout')->with('payment','Payment option changed');
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
        if($user->district_id != null){
            $parent_district = District::find($user->district->parent_id);
            if($parent_district != null){
                $locations = $parent_district->sub_locations;
            }
            else{
                $locations = [];
                $parent_district = $user->district;
            }
        }
        else{
            $locations = [];
            $parent_district = $user->district;
        }

        $full_cart = DB::select('SELECT * FROM cart_product WHERE cart_id = ?', [$cart->id]);
        foreach ($full_cart as $full){
            $products[] = Product::find($full->product_id);
        }

        $districts = District::all()->whereNull('parent_id');
        return view('cart.checkout',[
            'products' => $products,
            'districts'=> $districts,
            'locations'=> $locations,
            'parent_district' => $parent_district
        ]);
    }

    public function address(Request $request){
        $this->validate($request,[
            'address'=> ['required'],
            'contact'=> 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:10',
        ]);
        
        $user = \Auth::user();
        if($request->input('sublocation') != null){
            $user->district_id = $request->input('sublocation');
            $status = 'Address added';
        }
        else{
            $user->district_id = $request->input('address');
            $status = 'Address changed';
        }
        $user->contact = $request->input('contact');
        $user->save();

        return redirect('/carts/checkout')->with('address_status',$status);
        
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
