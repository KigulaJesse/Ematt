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
            
        //This is a route to the about-us page to contact us
            Route::get('/about-us', function () {
                return view('Home.about-us');
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

