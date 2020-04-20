@extends('layouts.app')

@section('content')
<section class="section-sm">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 col-md-4">
				<div class="category-search-filter">
					<div class="row">
						<div class="col-md-6">
							<strong>{{Auth::user()->name}}'s Cart</strong>
						</div>
					</div>
				</div>

                <!-- ad listing list  -->
                @if($products)
                    @foreach($products as $product)
                    <div class="ad-listing-list mt-20">
                        <div class="row p-lg-3 p-sm-5 p-4">
                            <div class="col-lg-4 align-self-center">
                                <a href="#"> image
                                    <!--<img src="images/products/{{$product->id}}/1.jpg" class="img-fluid" alt="">-->
                                </a>
                            </div>
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-6 col-md-10">
                                        <div class="ad-listing-content">
                                            <div>
                                                <a href="single.html" class="font-weight-bold">{{$product->name}}</a>
                                            </div>
                                            <ul class="list-inline mt-2 mb-3">
                                                <li class="list-inline-item"><a href="category.html"> <i class="fa fa-folder-open-o"></i> Electronics</a></li>
                                                <li class="list-inline-item"><a href=""><i class="fa fa-calendar"></i>26th December</a></li>
                                            </ul>
                                            <p class="pr-5">
                                                @if ($product->short_description)
                                                    {{$product->short_decription}}
                                                @else
                                                    This {{$product->name}} is for sale
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 align-self-center">
                                        <div class="product-ratings float-lg-right pb-3">
                                            <ul class="list-inline">
                                                <li class="list-inline-item selected"><b>{{$product->price}}</b></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                <div class="ad-listing-list mt-20">
                    <div class="row p-lg-3 p-sm-5 p-4">
                        <div class="col-lg-4 align-self-center">
                           <h1>Empty cart</h1>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <div class="col-md-10 offset-md-1 col-lg-3 offset-lg-0">
				<div class="sidebar">
                    <div class="widget category">
                        <!-- Widget Header -->
                        <h5 class="widget-header">Price Details</h5>
                        <ul class="category-list">
                            @php($total = 0)
                            @if($products)
                                @foreach($products as $product)
                                    <li><a href="">{{$product->product_name}} <span class="float-right">{{$product->price}}</span></a></li>
                                    @php($total += $product->price)
                                @endforeach
                                <li>Discount <span class="float-right">---</span></a></li>
                                <li>Delivery Fee<span class="float-right">5000</span></a></li>
                                @php($total += 5000)
                                <li><h3 class="widget-header"><h3> Total<span class="float-right">{{$total}}</span></h3></h3></li>
                                <li class="list-inline-item"><a href="" class="btn btn-offer d-inline-block btn-primary ml-n1 my-1 px-lg-4 px-md-3" style="color:white">Checkout</a></li>
                            @else
                                <h3> Empty Cart </h3>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
					
		</div>
	</div>
</section>   
@endsection