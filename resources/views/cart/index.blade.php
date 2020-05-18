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
                <h3>{{Auth::user()->name}}'s cart</h3>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>

<section class="dashboard section">
    <!-- Container Start -->
    <div class="container">
      <!-- Row Start -->
        <div class="row">
        
            <div class="col-lg-9 col-md-1">
                <div class="widget dashboard-container my-adslist col-lg-20">
                    <table class="table table-responsive product-dashboard-table" style = "overflow: visible;">
                        @if($products)
                        <thead>
                            <tr>
                                <th>image</th>
                                <th>Product </th>
                                <th class = "text-center">Price</th>
                                <th class = "text-center">Qty</th>
                                <th class = "text-center">SubTotal</th>
                                <th class = "text-center">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                                @foreach(Auth::user()->carts->products as $product)
                                    @if($product->pivot->ordered == null)
                                        <tr>
                                            <td class="product-thumb">
                                                <a href="/products/{{$product->id}}"><img width="80px" height="auto" src="images/products/{{$product->id}}/1.jpg" alt="image description"></a>
                                            </td>
                                            <td class="product-details">
                                                <a href="/products/{{$product->id}}"><h3 class="title">{{$product->product_name}}</h3></a>
                                                @if($product->brand)
                                                    <span class="location"><strong>Brand:</strong>{{$product->brand}}</span>
                                                @endif
                                                @if($product->color)
                                                    <span class="add-id"><strong>Color:</strong>{{$product->color}}</span>
                                                @else
                                                    <span><strong>Posted on: </strong><time>{{$product->created_at}}</time> </span>
                                                @endif
                                                
                                            </td>
                                            <td class="product-category text-center">
                                                <span class="categories">{{number_format($product->price)}}</span>
                                            </td>
                                            <td class="product-category">
                                                <span class="categories" >
                                                    <select name = "category_{{$product->id}}" id = "inputGroupSelect_{{$product->id}}" class="w-1" onchange="subtotal(this, {{$product->id}}, {{$product->price}})">
                                                        @for ($i = 1; $i <= $product->quantity; $i++)
                                                            <option value="{{$i}}" @if($i == ($product->pivot->quantity)) selected @endif >{{$i}}</option>    
                                                        @endfor
                                                    </select>            
                                                </span>
                                            </td>
                                            <td>
                                            <span class="categories" style = "position:relative; left:12px;" name = "sub-total" id= "subtotal_{{$product->id}}">
                                                @if($product->pivot->quantity == null)
                                                    {{number_format($product->price)}}
                                                @else
                                                    {{number_format($product->price * $product->pivot->quantity)}}
                                                @endif
                                            </span>
                                            </td>
                                            
                                            <td class="action" data-title="Action">
                                                <div class="">
                                                    <ul class="list-inline justify-content-center">
                                                        <li class="list-inline-item">
                                                            <a class="delete" data-toggle="tooltip" data-placement="top" title="Delete from cart" href ="/cart/{{$product->id}}/delete">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody> 
                            @else
                                 <tr><td style = "position:relative; left:450px;" >
                                        <i class="fa fa-trash fa-5x" style="position:relative; left:60px;"></i>
                                        <h1>Empty Cart</h1>
                                        @if (session('status'))
                                            <h2 style="color :red;">{{ session('status') }}</h2>
                                        @endif
                                        <a href = "/home" style="position:relative; left:-20px;">Click Here to Continue Shopping</a>
                                    </td></tr>
                                    
                            @endif
                    </table>
                </div>
            </div>

            @if($products)
            <div class="col-md-10 offset-md-1 col-lg-3 offset-lg-0">
				<div class="sidebar">
                    <div class="widget category">
                        <!-- Widget Header-->
                        <h5 class="widget-header">Price Details</h5>
                        <ul class="category-list">
                            @php($total = 0)
                           
                                @foreach(Auth::user()->carts->products as $product)
                                    @if($product->pivot->quantity == null)
                                        <li>{{$product->product_name}}
                                            <span class="float-right" id = 'side_sub_total_{{$product->id}}' >
                                                {{number_format($product->price)}}
                                            </span>
                                        </li>
                                            @php($total += $product->price)
                                    @else
                                        <li>{{$product->product_name}}
                                            <span class="float-right" id = 'side_sub_total_{{$product->id}}' >
                                                {{number_format($product->price * $product->pivot->quantity )}}
                                            </span>
                                        </li>
                                            @php($total += $product->price * $product->pivot->quantity)
                                    @endif
                                @endforeach
                                <li>Discount <span class="float-right">---</span></a></li>
                                <li>Delivery Fee<span class="float-right">5000</span></a></li>
                                @php($total += 5000)
                                <li><h3 class="widget-header"><h3> Total<span class="float-right">{{number_format($total)}}</span></h3></h3></li>
                                <li class="list-inline-item"><a href="/carts/checkout" class="btn btn-offer d-inline-block btn-primary ml-n1 my-1 px-lg-4 px-md-3" style="color:white">Checkout</a></li>
                            
                        </ul>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</section>
<script>
    function subtotal(ele,y,price){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var qty = ele.value;
        var subtotal = qty * price;
        subtotal=commafy(subtotal);
        var x = '#subtotal_'+y;
        var z = '#side_sub_total_'+y;
        $.ajax({
            url: '/UpdateQuantity/'+y+'/'+qty,  
            method:"GET",
            dataType: "json",
            success: function( data ) {
                 console.log(data);
            }   
        }); 
        jQuery(x).empty();
        jQuery(x).append(subtotal);
        jQuery(z).empty();
        jQuery(z).append(subtotal);
    }

    function commafy( num ) {
    var str = num.toString().split('.');
    if (str[0].length >= 4) {
        str[0] = str[0].replace(/(\d)(?=(\d{3})+$)/g, '$1,');
    }
    return str.join('.');
}
</script>
@endsection