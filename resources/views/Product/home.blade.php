@extends('layouts.app')

@section('content')

@include('layouts.product.header')

<section class="section" > 
	<div class="container" style = "position:relative; top:-10ex;">
		<div class="row">
			<div class="col-md-12" >
				<div class="search-result bg-gray">
					<!--<h2>Results For "Electronics</h2>-->
					<h2>
						@if(isset($searched))
						Top Results for {{$searched}}
						@else
						Top Results on page
						@endif 
					</h2>
					<p>Results in <script>
						var monthNames = ["January", "February", "March", "April", "May", "June",
											"July", "August", "September", "October", "November", "December"
											];
					var d = new Date;
					var CurrentYear = d.getFullYear();
					var currentMonth = d.getMonth();
					document.write(monthNames[d.getMonth()]);
					document.write(" of " + CurrentYear); </script></p>
				</div>
			</div>
		</div>


		<div class="row">
		
			<div class="col-md-3">

			<!--============================
			=         SideBar            =
			=============================-->
				<div class="category-sidebar">
					<div class="widget category-list">
						<h4 class="widget-header">All Category</h4>
						<ul class="category-list">
							@foreach($categories as $category)
								<li><a href = "/category/{{$category->category_name}}">{{$category->category_name}}</a> </li>  
							@endforeach
						</ul>
					</div>

					<div class="widget category-list">
						<h4 class="widget-header">Nearby</h4>
						<ul class="category-list">
							@foreach($districts as $district)
							<li><a href="/category/district/{{$district->id}}">{{$district->district_name}}<span></span></a></li>
							@endforeach
						</ul>
					</div>
					<!--<div class="widget price-range w-100">
						<h4 class="widget-header">Price Range</h4>
						<div class="block">
							<input 	class="range-track w-100" 
									type="text" 
									id = "price_span"
									data-slider-min="1000" 
									data-slider-max="5000000" 
									data-slider-step="500"
									data-slider-value="[1000,500000]">
							<div class="d-flex justify-content-between mt-2">
								<span class="value" id="price_range"></span>
							</div>
						</div>
					</div>
					<script>
						var amountmonday = $('#price_span');
						var slidermonday = $('#price_range');
						slidermonday.slider({
						range: true,
						min: 1000,
						max: 5000000,
						values: [1000, 5000000],
						create: function() {
							var max = $(this).slider('values', 1);
							var min = $(this).slider('values', 0);
							amountmonday.val(max - min);
						},
						slide: function Total(event, ui) {
							amountmonday.val(ui.values[1] - ui.values[0]);
						}

						});
						
					</script>-->
						

				<!--	<div class="widget product-shorting">
						<h4 class="widget-header">By Condition</h4>
						<div class="form-check">
							<label class="form-check-label">
								<input class="form-check-input" name = "condition" type="radio" value="Brand New">
								Brand New
							</label>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input class="form-check-input" name ="condition" type="radio" value="Like New">
								Like New
							</label>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input class="form-check-input" name = "condition" type="radio" value="Fairly Used">
								Fairly Used
							</label>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input class="form-check-input" name = "condition" type="radio" value="used">
									Used
							</label>
						</div>
					</div>-->
					<script>
						var rad = document.condition;
						var prev = null;
						for (var i = 0; i < rad.length; i++) {
							rad[i].addEventListener('change', function() {
								alert(rad[i]);
								/*(prev) ? console.log(prev.value): null;
								if (this !== prev) {
									prev = this;
								}
								console.log(this.value)*/
							});
						}
					</script>
				</div>
			</div>

			<div class="col-md-9">

				<!--============================
                 =         SEARCH FILTER       =
                 =============================-->
				<div class="category-search-filter">
					<div class="row">
						<div class="col-md-6">
							<strong>Sort By</strong>
							<form method="POST" action="/category" id="popularity_form">
								@csrf
	
								<select name = search onchange="submitpopularity()">
									<option>Most Recent</option>
									<!--<option value="1">Most Popular</option>
									<option value="2">Lowest Price</option>
									<option value="4">Highest Price</option>-->
								</select>
							</form>
						</div>
						
						<!--<div class="col-md-6">
							<div class="view">
								<strong>Views</strong>
								<ul class="list-inline view-switcher">
									<li class="list-inline-item">
										<a href="#" onclick="event.preventDefault();" class="text-info"><i class="fa fa-th-large"></i></a>
									</li>
									<!--<li class="list-inline-item">
										<a href="#"><i class="fa fa-reorder"></i></a>
									</li>
								</ul>
							</div>
						</div>-->
					</div>
				</div>

				<!--============================
				=         PRODUCT LIST         =
				=============================-->
				<div class="product-grid-list">
					<div class="row mt-30">
						<style>
						.hide {
							display: none;
						  }
							  
						.myDIV:hover .hide {
							display: block;
							color: red;
						}
						</style>
						@if(count($products) > 0)
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
						@else
						<h1 style='position:relative; left:200px'>No Products to show</h1>

						@endif
					</div>
				</div>

				<!--============================
				=      PAGE LIST AT BOTTOM     =
				=============================-->
				<!--<div class="pagination justify-content-center">
					<nav aria-label="Page navigation example">
						<ul class="pagination">
							<li class="page-item">
								<a class="page-link" href="#" aria-label="Previous">
									<span aria-hidden="true">&laquo;</span>
									<span class="sr-only">Previous</span>
								</a>
							</li>
							<li class="page-item"><a class="page-link" href="#">1</a></li>
							<li class="page-item active"><a class="page-link" href="#">2</a></li>
							<li class="page-item"><a class="page-link" href="#">3</a></li>
							<li class="page-item">
								<a class="page-link" href="#" aria-label="Next">
									<span aria-hidden="true">&raquo;</span>
									<span class="sr-only">Next</span>
								</a>
							</li>
						</ul>
					</nav>
				</div>-->

			</div>

		</div>
	</div>
</section>

<script>
	function submitForm() {
	  document.getElementById('sample_form').submit();
	  return true;
	}
	function submitpopularity() {
	  document.getElementById('popularity_form').submit();
	  return true;
	}
</script>


@endsection