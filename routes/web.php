<?php

use Illuminate\Support\Facades\Route;
use App\Product;
use App\Category;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*------TOP FOLDER ROUTES ------------------*/
        //This is a route to the top page of the app with some popular products
            Route::get('/', function(){
                $products = Product::take(9)->latest()->get();
                $categories = Category::all()->whereNull('parent_id'); 
                return view('Home.index',[
                    "products"=>$products,
                    "categories"=>$categories
                ]);
            });

        //This is a route to the about-us page to know about us
            Route::get('/about-us', function () {
                return view('Home.about-us');
            });

        //This is a route to the contact-us page to contact us
            Route::get('/contact-us', function () {
                $products = Product::take(9)->latest()->get();
                $categories = Category::all()->whereNull('parent_id'); 
                return view('Home.contact-us',[
                    "products"=>$products,
                    "categories"=>$categories
                ]);
            });
        //This route is for comments from users to the admins
            Route::post('/contact-us',"HomeController@contact_us");
        //This is a route to the contact-us page to contact us
        Route::get('/Terms-and-conditions', function () {
            return view('Home.Terms-and-conditions');
        });
/*-------------------------------------------*/

/*----------------ADMIN ROUTES---------------*/
        Route::group(['middleware'=>['auth','admin']],function(){
        
                //Used to bring the admin dashboard
                    Route::get('/administrator','AdminController@dashboard');
                //Used to view the admins profile
                    Route::get('/admini/profile','AdminController@profile');
                //Used to show orders
                    Route::get('/admini/orders','AdminController@getorders');
                //Used to confirm a delivery
                    Route::get('/admini/{product_id}/{cart_id}/updatecart','AdminController@updatecart');
                //Used to confirm a delivery
                    Route::get('/admini/{product_id}/{cart_id}/delete','AdminController@deletecart');
                    
                

                //Used to edit the site
                    Route::get('/admini/edit','AdminController@edit_district');
                //Used to add a district to the database
                    Route::post('/admini/district','DistrictController@store');
                //Used to add a location in a district to the database
                    Route::post('/admini/district/{id}','DistrictController@add_location');
                //Used to update a district 
                    Route::put('/admini/{district}/update','DistrictController@update');
                //Used to delete a user from database
                    Route::get('/admini/{district}/deleteDistrict','DistrictController@destroy');

                    
                //Used to show a user
                    Route::get('/admini/single/{id}','AdminController@show');
                //Used to show locations under a district
                    Route::get('/admini/single_district/{id}','AdminController@single_district');
                //Used to update user info by the admin
                    Route::put('/admini/{user}','AdminController@updateUser');
                //Used to delete a user from database
                    Route::get('/admini/{user}/deleteUser','AdminController@destroyUser');
                

                //Used to delete a product from database
                    Route::get('/admini/{product}/delete','AdminController@destroy');
        }); 
/*-------------------------------------------*/

/*-----------USER AND AUTH ROUTES------------*/
        //
            Auth::routes();
        //
            Route::get('/update',function(){
                return view('auth.update');
            });
/*------------------------------------------*/

/*-------------CART ROUTES-------------*/

        //
    
            Route::get('/cart','CartController@index');
        //
            Route::get('/cart/{cart}','CartController@create');
        //Is a route to the CartController destroy method used to delete products from cart_product
            Route::get('/cart/{product}/delete','CartController@destroy');
        //
            Route::get('/carts/checkout','CartController@checkout');
        //Used to change address used
            Route::post('/carts/address','CartController@address');
        //Used to update the quantity of the products in cart_product
            Route::get('/UpdateQuantity/{id}/{qty}','CartController@quantity');
        //Used to confirm order
            Route::get('/carts/confirm-order/{cart}','CartController@order');
        //Used to confirm payment method
            Route::put('/payment','CartController@payment');
        //Used to get sub_categories when creating a product
            Route::get('/district/get_sub_locations/{id}','DistrictController@get_sub_locations');
        //Used to get sub_categories when creating a product
            Route::get('/district/get_sub_locations1/{id}','DistrictController@get_sub_locations1');

/*-----------------------------------------*/


/*--------------PRODUCTS ROUTES---------------*/
        //displays the products that are for sale    
            Route::get('/home', 'HomeController@home')->name('home');
        //used to display all products uploaded and owned by one user
            Route::get('/products','ProductController@index');
        //used to get form used to create a product
            Route::get('/product','ProductController@create'); 
        //used to store the products in the database
            Route::post('/products','ProductController@store');
        //used to display a singular product  
            Route::get('/products/{product}', 'ProductController@show');
        //used to get form for editing the product
            Route::get('/products/{product}/edit','ProductController@edit');
        //used to store the results of updating a product
            Route::put('/products/{product}','ProductController@update');     
        //Used to delete a product from database
            Route::get('/products/{product}/delete','ProductController@destroy');
        //Used to get and show clients pending orders by a seller
            Route::get('/orders','ProductController@orders');
        //Used to get show items delivered to a client for a specific seller
            Route::get('/ordered','ProductController@ordered');
/*----------------------------------------------*/

/*----------------CATEGORY ROUTES-----------------*/
        //Used to post a query to find some category
            Route::post('/category','CategoryController@show');
        //Used to get products of a category on the side bar
            Route::get('/category/{category}','CategoryController@showcategory');
        //Used to get products of a category on the side bar
            Route::get('/category/district/{id}','CategoryController@showbydistrict');
        //Used to get products of a user on the show page
            Route::get('/category/user/{id}','CategoryController@showbyuser');
        //Used to get sub_categories when creating a product
            Route::get('/category/get_sub_categories/{id}','CategoryController@get_sub_category');
/*------------------------------------------------*/