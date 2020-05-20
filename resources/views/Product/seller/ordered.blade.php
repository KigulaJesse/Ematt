@extends('layouts.app')

@section('content')
<!--================================
=            Page Title            =
=================================-->
<section class="page-title" style ="background-color:forestgreen;   ">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<div class="col-md-8 offset-md-2 text-center">
				<!-- Title text -->
                <h3>Delivered products</h3>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>
<section class="dashboard section">
    <div class="container">
        <!-- Row Start -->
        <div class="row">
            <div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
                @include('layouts.product.sidebar')
            </div>
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                <div class="widget dashboard-container my-adslist">
                    @if($ordered)
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>Client</th>
                                    <th><div style="position:relative; left:-50px;">Product</div></th>
                                    <th class="text-center"><div style="position:relative; left:-40px;">Price</div></th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ordered as $order)
                                    <tr>
                                        <td class="product-details"><h3 class="title">{{App\Cart::find($order->pivot->cart_id)->user->name}}</h3></td>
                                            <td class="product-category" style="white-space: nowrap; text-align:left;"><span class="categories" style="position:relative; left:-50px;">{{App\Product::find($order->pivot->product_id)->product_name}}</span></td>
                                            <td class="action" style="white-space: nowrap; text-align:left;"><div style="position:relative; left:-10px;">{{number_format(App\Product::find($order->pivot->product_id)->price)}}</div></td>
                                            <td class="action">{{$order->pivot->quantity}}</td>
                                            <td class="action" style="white-space: nowrap; text-align:left;">{{number_format(App\Product::find($order->pivot->product_id)->price * $order->pivot->quantity)}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else 
                        <h1 style="position: relative; left: 200px; top:100px;">No ordered products to show</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
