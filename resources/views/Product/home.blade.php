@extends('layouts.app')

@section('content')

@include('layouts.product.header')

<section class="section-sm">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="search-result bg-gray">
					<!--<h2>Results For "Electronics</h2>-->
					<h2>Top Results</h2>
					<p>123 Results on 12 December, 2017</p>
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
							<form method="POST" action="/category" id="sample_form">
								@csrf
								@foreach($categories as $category)
									<li><a href = "#" onclick="submitForm();">{{$category->category_name}}</a> </li> 
									<input type="hidden" name="category" value='{{$category->category_name}}'/> 
								@endforeach
							</form>
						</ul>
					</div>

					<div class="widget category-list">
						<h4 class="widget-header">Nearby</h4>
						<ul class="category-list">
							<li><a href="#">Kampala<span>93</span></a></li>
							<li><a href="#">Ntinda<span>233</span></a></li>
							<li><a href="#">Lubowa<span>183</span></a></li>
						</ul>
					</div>

					<div class="widget filter">
						<h4 class="widget-header">Show Produts</h4>
						<select>
							<option>Popularity</option>
							<option value="1">Top rated</option>
							<option value="2">Lowest Price</option>
							<option value="4">Highest Price</option>
						</select>
					</div>

					<div class="widget price-range w-100">
						<h4 class="widget-header">Price Range</h4>
						<div class="block">
											<input class="range-track w-100" type="text" data-slider-min="1000" data-slider-max="500000" data-slider-step="500"
											data-slider-value="[1000,500000]">
									<div class="d-flex justify-content-between mt-2">
											<span class="value">Ush1000 - Ush500000</span>
									</div>
						</div>
					</div>

					<div class="widget product-shorting">
						<h4 class="widget-header">By Condition</h4>
						<div class="form-check">
							<label class="form-check-label">
								<input class="form-check-input" type="checkbox" value="">
								Brand New
							</label>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input class="form-check-input" type="checkbox" value="">
								Almost New
							</label>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input class="form-check-input" type="checkbox" value="">
								Gently New
							</label>
						</div>
						<div class="form-check">
							<label class="form-check-label">
								<input class="form-check-input" type="checkbox" value="">
									Havely New
							</label>
						</div>
					</div>

				</div>
			</div>

			<div class="col-md-9">

				<!--============================
                 =         SEARCH FILTER       =
                 =============================-->
				<div class="category-search-filter">
					<div class="row">
						<div class="col-md-6">
							<strong>Short</strong>
							<select>
								<option>Most Recent</option>
								<option value="1">Most Popular</option>
								<option value="2">Lowest Price</option>
								<option value="4">Highest Price</option>
							</select>
						</div>
						<div class="col-md-6">
							<div class="view">
								<strong>Views</strong>
								<ul class="list-inline view-switcher">
									<li class="list-inline-item">
										<a href="#" onclick="event.preventDefault();" class="text-info"><i class="fa fa-th-large"></i></a>
									</li>
									<li class="list-inline-item">
										<a href="#"><i class="fa fa-reorder"></i></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>

				<!--============================
				=         PRODUCT LIST         =
				=============================-->
				<div class="product-grid-list">
					<div class="row mt-30">
						@foreach($products as $product)
						<div class="col-sm-12 col-lg-4 col-md-6">
						
							<div class="product-item bg-light">
								<div class="card">
									<div class="thumb-content">
										<!-- <div class="price">$200</div> -->
										<a href="/products/{{$product->id}}">
									 		<img class="card-img-top img-fluid" src="images/products/{{$product->id}}/1.jpg" alt="Card image cap">
										</a>
									</div>
									<div class="card-body">
										<h4 class="card-title"><a href="/products/{{$product->id}}">{{$product->product_name}}</a></h4>
										<ul class="list-inline product-meta">
											<li class="list-inline-item">
												<form method="POST" action="/category" id="sample_form">
												@csrf
													<a href="#" onclick="submitForm();"><i class="fa fa-folder-open-o"></i>{{$product->category->category_name}}</a>
													<input type="hidden" name="category" value='{{$product->category->category_name}}'/>
												</form>
											</li>
											<li class="list-inline-item">
												<a href="#"><i class="fa fa-calendar"></i>26th December</a>
											</li>
										</ul>
										@if ($product->long_description)
											<p class="card-text">{{$product->long_description}}</p>
										@else
											<p class="card-text">This {{$product->product_name}} is for sale</p>
										@endif
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
	  // Can do some validation here if needed
	
	  document.getElementById('sample_form').submit();  
	
	  return true;
	}
</script>


@endsection