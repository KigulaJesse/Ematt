<?php

use Illuminate\Support\Facades\Route;
use App\Product;

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
                return view('Home.index',[
                    "products"=>$products
                ]);
            });

        //This is a route to the about-us page to know about us
            Route::get('/about-us', function () {
                return view('Home.about-us');
            });

        //This is a route to the contact-us page to contact us
            Route::get('/contact-us', function () {
                return view('Home.contact-us');
            });
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
        

        //Used to edit the site
            Route::get('/admini/edit','AdminController@edit');
        //Used to add a district to the database
            Route::post('/admini/district','DistrictController@store');
        //Used to update a district 
            Route::put('/admini/{district}/update','DistrictController@update');
        //Used to delete a user from database
            Route::get('/admini/{district}/deleteDistrict','DistrictController@destroy');
            
        //Used to show a user
            Route::get('/admini/single/{id}','AdminController@show');
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
        // Is a route to the CartController destroy method used to delete products from cart_product
            Route::get('/cart/{product}/delete','CartController@destroy');
        //
            Route::get('/carts/checkout','CartController@checkout');
        //Used to change address used
            Route::post('/carts/address','CartController@address');
        //Used to update the quantity of the products in cart_product
            Route::get('/UpdateQuantity/{id}/{qty}','CartController@quantity');

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
/*----------------------------------------------*/

/*----------------CATEGORY ROUTES-----------------*/
        //Used to post a query to find some category
            Route::post('/category','CategoryController@show');  
        //Used to get sub_categories when creating a product
            Route::get('/category/get_sub_categories/{id}','CategoryController@get_sub_category');


/*------------------------------------------------*/