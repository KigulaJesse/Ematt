@extends('layouts.app')

@section('content')
<!--===============================
=            Hero Area            =
================================-->
<section class="hero-area bg-1 text-center overly">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Header Contetnt -->
				<div class="content-block">
					@auth
						<h1>Hello, {{Auth::user()->name}}</h1>
					@else
						<h1>Hello</h1>
					@endauth
					<p>Join Ematt to buy and sell from each other <br> everyday in local communities around the world</p>
					<div class="short-popular-category-list text-center">
						<h2>Popular Category</h2>
						<ul class="list-inline">
							<li class="list-inline-item">
								<a href="#"><i class="fa fa-bed"></i> Hostel</a></li>
							<!--<li class="list-inline-item">
								<a href="category.html"><i class="fa fa-grav"></i> Fitness</a>
							</li>-->
							<li class="list-inline-item">
								<a href="#"><i class="fa fa-car"></i> Cars</a>
							</li>
							<li class="list-inline-item">
								<a href="#"><i class="fa fa-cutlery"></i> Restaurants</a>
							</li>
							<li class="list-inline-item">
								<a href="/home"><i class="fa fa-shopping-bag"></i>Shop Online</a>
							</li>
						</ul>
					</div>
					
				</div>
				<!-- Advance Search -->
				<div class="advance-search">
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-lg-12 col-md-12 align-content-center">
								<form method = "POST" action = "/category">
									@csrf			
									<div class="form-row">
										<div class="form-group col-md-10">
											<input type="text" name = 'search' class="form-control my-2 my-lg-0" id="inputCategory4" placeholder="Welcome, what are you looking for in Ematt today?">
										</div>
										<div class="form-group col-md-2 align-self-center">
											<button type="submit" class="btn btn-primary">Search Now</button>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>

<!--===================================
=            Client Slider            =
====================================-->


<!--===========================================
=            Popular deals section            =
============================================-->

<section class="popular-deals section bg-gray">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h2>Trending Adds</h2>
					<p>Some of our more popular items</p>
				</div>
			</div>
		</div>
		<div class="row">
			<!-- offer 01 -->
			<div class="col-lg-12">
				<div class="trending-ads-slide">
					@foreach($products as $product)
					<div class="col-sm-12 col-lg-4 col-md-6 myDIV" style = "overflow:auto; ">
						<div class="product-item bg-light">
							<div class="card">
								<div class="thumb-content">
									<a href="/products/{{$product->id}}" style ="position: relative; ">
										<img class="card-img-top img-fluid" src="/images/products/{{$product->id}}/1.jpg" alt="Card image cap">
									</a>
									<!--<div class="price hide" style="background-color:dodgerblue;">Ush {{number_format($product->price)}}</div> 
									<div class="price" style ="position: relative; top:-30em; left:85%; background-color:blue;"><a href="/cart/{{$product->id}}">+</a></div>-->
								</div>
								<div class="card-body">
									<a href="/products/{{$product->id}}">{{$product->product_name}}</a>
									<ul class="list-inline product-meta">
										<li class="list-inline-item">
												<a href="/category/{{$product->category->last()->category_name}}"><i class="fa fa-folder-open-o"></i>{{$product->category->last()->category_name}}</a>
										</li>
									</ul>
									<!--@if ($product->short_description)
										<p class="card-text">{{$product->short_description}}</p>
									@else-->
										<p class="card-text">This {{$product->product_name}} is for sale</p>
									<!--@endif-->
									<!--<div>
										<b>Ushs {{number_format($product->price)}}</b>
									</div>-->
									<div class="product-ratings">
										<ul class="list-inline">
											<li class="list-inline-item selected"><i class="fa fa-star"></i></li>
											<li class="list-inline-item selected"><i class="fa fa-star"></i></li>
											<li class="list-inline-item selected"><i class="fa fa-star"></i></li>
											<li class="list-inline-item selected"><i class="fa fa-star"></i></li>
											<li class="list-inline-item"><i class="fa fa-star"></i></li>
										</ul>
									</div>
									
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</section>

<!--==========================================
=            All Category Section            =
===========================================-->
<section class=" section">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<div class="col-12">
				<!-- Section title -->
				<div class="section-title">
					<h2>All Categories</h2>
					<p>Ematt has got you with the best products</p>
				</div>
				<!-- Can use a for each loop and multiple if statements for the icons-->
				<div class="row">
					<!--Electronics Category On Home Page -->
					<div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
						<div class="category-block">
							<div class="header">
								<i class="fa fa-laptop icon-bg-1"></i> 
								<h4>Online Shop</h4>
							</div>
							
							<ul class="category-list" >
								@foreach($categories as $category)	
									<li><a href = "/category/{{$category->category_name}}">{{$category->category_name}}<span></span></a> </li>
								@endforeach
							</ul>
						</div>
					</div> 
					<!-- Electronics Category On Home Page -->

					<!--Restaurant Category On Home Page
					<div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
						<div class="category-block">
							<div class="header">
								<i class="fa fa-apple icon-bg-2"></i> 
								<h4>Restaurants</h4>
							</div>
							<ul class="category-list" >
								<li><a href="category.html">Cafe <span>393</span></a></li>
								<li><a href="category.html">Fast food <span>23</span></a></li>
								<li><a href="category.html">Restaurants  <span>13</span></a></li>
								<li><a href="category.html">Food Track<span>43</span></a></li>
							</ul>
						</div>
					</div>
					 <!--Restaurant Category On Home Page -->

					<!-- Hostels Category On Home Page 
					<div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
						<div class="category-block">
							<div class="header">
								<i class="fa fa-home icon-bg-3"></i> 
								<h4>Hostels</h4>
							</div>
							<ul class="category-list" >
								<li><a href="category.html">Nana </a></li>
								<li><a href="category.html">Olympia</a></li>
							</ul>
						</div>
					</div>
					 <!-- Hostels Category List -->

					<!-- Online Shopping Category On Home Page 
					<div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
						<div class="category-block">
							<div class="header">
								<i class="fa fa-shopping-basket icon-bg-4"></i> 
								<h4>Shoppings</h4>
							</div>
							<ul class="category-list" >
								<li><a href="category.html">Mens Wears <span>53</span></a></li>
								<li><a href="category.html">Accessories <span>212</span></a></li>
								<li><a href="category.html">Kids Wears <span>133</span></a></li>
								<li><a href="category.html">It & Software <span>143</span></a></li>
							</ul>
						</div>
					</div> 
					<!-- Online Shopping Category On Home Page -->
					
					<!-- Jobs Category On Home Page 
					<div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
						<div class="category-block">
							<div class="header">
								<i class="fa fa-briefcase icon-bg-5"></i> 
								<h4>Jobs</h4>
							</div>
							<ul class="category-list" >
								<li><a href="category.html">It Jobs <span>93</span></a></li>
								<li><a href="category.html">Cleaning & Washing <span>233</span></a></li>
								<li><a href="category.html">Management  <span>183</span></a></li>
								<li><a href="category.html">Voluntary Works <span>343</span></a></li>
							</ul>
						</div>
					</div> 
					<!-- Jobs Category On Home Page -->
					
					<!-- Vehicles Category On Home Page 
					<div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
						<div class="category-block">
							<div class="header">
								<i class="fa fa-car icon-bg-6"></i> 
								<h4>Vehicles</h4>
							</div>
							<ul class="category-list" >
								<li><a href="category.html">Bus <span>193</span></a></li>
								<li><a href="category.html">Cars <span>23</span></a></li>
								<li><a href="category.html">Motobike  <span>33</span></a></li>
								<li><a href="category.html">Rent a car <span>73</span></a></li>
							</ul>
						</div>
					</div> <!-- Vehicles Category On Home Page -->
					
					<!-- Services Category on home page
					<div class="col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-6">
						<div class="category-block">						
							<div class="header">
								<i class="fa fa-laptop icon-bg-8"></i> 
								<h4>Services</h4>
							</div>
							<ul class="category-list" >
								<li><a href="category.html">Cleaning <span>93</span></a></li>
								<li><a href="category.html">Car Washing <span>233</span></a></li>
								<li><a href="category.html">Clothing  <span>183</span></a></li>
								<li><a href="category.html">Business <span>343</span></a></li>
							</ul>
						</div>
					</div> 
					<!-- Services Category on home page-->
					
					
				</div>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>


<!--====================================
=            Call to Action            =
=====================================-->

<section class="call-to-action overly bg-3 section-sm">
	<!-- Container Start -->
	<div class="container">
		<div class="row justify-content-md-center text-center">
			<div class="col-md-8">
				<div class="content-holder">
					<h2>Start today to get more exposure and
					grow your business</h2>
					<ul class="list-inline mt-30">
						<li class="list-inline-item"><a class="btn btn-main" href="/product">Add Listing</a></li>
						<li class="list-inline-item"><a class="btn btn-secondary" href="/home">Browse Products</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>

@endsection