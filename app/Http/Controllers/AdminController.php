<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\District;
use App\Cart;
use App\User;
use DB;
use App\Comments;

class AdminController extends Controller
{
    public function dashboard(){
        $users = User::all()->whereNull('user_type');
        $comments =Comments::take(3)->latest()->get();
        return view('administrator.dashboard',[
            'users' => $users,
            'comments'=>$comments
        ]);
    }


    public function profile(){
        return view('administrator.profile');
    }

    public function show($id){
        $usery = User::find($id);
        return view('administrator.single',[
            'usery' => $usery
        ]);
    }


    public function edit_district(){
        $districts = District::all()->whereNull('parent_id');
        return view('administrator.districts.edit-site',[
            'districts' => $districts
        ]);
    }

    public function get_categories(){
        $categories = Category::all()->whereNull('parent_id');
        return view('administrator.categories.index',[
            'categories' => $categories,
        ]);
    }


    public function single_district($id){

        $district = District::find($id);
        $locations = $district->sub_locations;
        return view('administrator.districts.locations',[
            'locations' => $locations,
            'district' => $district
        ]);

    }

    public function single_category($id){

        $category = Category::find($id);
        $sub_categories = $category->sub_category;
        return view('administrator.categories.sub_categories',[
            'sub_categories' => $sub_categories,
            'category' => $category
        ]);

    }


    public function updatecart($product_id, $cart_id){

        $subtract = DB::select('SELECT * FROM cart_product WHERE cart_id=? AND product_id =? AND ordered = "yes" AND delivered is null',[$cart_id,$product_id]);
        DB::update('UPDATE cart_product SET delivered ="yes" WHERE cart_id = ? AND product_id = ? AND ordered = "yes"', [$cart_id,$product_id]);
        $product = Product::find($product_id);
        $product->quantity = $product->quantity - $subtract[0]->quantity;
        $product->save();
        return redirect('/admini/orders');   
    }

    public function updateUser(Request $request, User $user){
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'contact'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:10',
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->contact = $request->input('contact');
        $user->save();

        return redirect('/admini/single/'.$user->id);

    }

    public function destroyUser(User $user){

        $user->delete();
        
        return redirect('/administrator');

    }

    public function getorders(){

        //$orders = DB::select('SELECT * FROM cart_product WHERE ordered = "yes" AND delivered is null');

        $carts = Cart::all();
        $orders = [];
        $orderedss = [];
        foreach($carts as $cart){
            foreach($cart->products as $order){
                if(($order->pivot->ordered == "yes") and ($order->pivot->delivered == null) ){
                    $orders[] = $order;
                }

                if(($order->pivot->ordered == "yes") and ($order->pivot->delivered == 'yes') ){
                    $orderedss[] = $order;
                }
            }
        }
    
        return view('administrator.orders',[
            'orders' => $orders,
            'orderedss'=> $orderedss
        ]);
    }

    public function deletecart($product_id,$cart_id){
        $cart = Cart::find($cart_id);
        $cart->products()->detach($product_id);
        return redirect('/admini/orders');

    }


    public function destroy(Product $product){

        $id = $product->user->id;
        if (empty($product)) {
            abort(404);
        }

        $destinationPath         =       public_path('/images/products');
        $path                    =       $destinationPath.'/'.$product->id;
        
        $rm =$this->deleteDirectory($path);

        $product->delete();

        return redirect('/admini/single/'.$id);
    }

    public function deleteDirectory($dir) {
        if (!file_exists($dir)) {
            return true;
        }
    
        if (!is_dir($dir)) {
            return unlink($dir);
        }
    
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
    
            if (!($this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item))) {
                return false;
            }
    
        }
    
        return rmdir($dir);
    }
}
