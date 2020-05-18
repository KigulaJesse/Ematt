@extends('layouts.app')

@section('content')
<section class="page-title" style ="background-color:forestgreen;   ">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<div class="col-md-8 offset-md-2 text-center">
				<!-- Title text -->
                <h3>{{Auth::user()->name}}, Checkout</h3>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>

<style>
    body {font-family: Arial, Helvetica, sans-serif;}
    * {box-sizing: border-box;}
    
    /* The popup form - hidden by default */
    .form-popup {
      display: none;
      position: absolute;
      top: 20px;
      left: 300px;
      
      border: 3px solid #f1f1f1;
      z-index: 9;
    }
    
    /* Add styles to the form container */
    .form-container {
      max-width: 300px;
      padding: 10px;
      background-color: white;
    }
    
    /* Full-width input fields */
    .form-container input[type=text], .form-container input[type=password] {
      width: 100%;
      padding: 15px;
      margin: 5px 0 22px 0;
      border: none;
      background: #f1f1f1;
    }
    
    /* When the inputs get focus, do something */
    .form-container input[type=text]:focus, .form-container input[type=password]:focus {
      background-color: #ddd;
      outline: none;
    }
    
    /* Set a style for the submit/login button */
    .form-container .btn {
      background-color: #4CAF50;
      color: white;
      padding: 16px 20px;
      border: none;
      cursor: pointer;
      width: 100%;
      margin-bottom:10px;
      opacity: 0.8;
    }
    
    /* Add a red background color to the cancel button */
    .form-container .cancel {
      background-color: red;
    }
    
    /* Add some hover effects to buttons */
    .form-container .btn:hover, .open-button:hover {
      opacity: 1;
    }
    </style>
    
<section class="blog single-blog section">
	<div class="container">
		<div class="row">
			<div class="col-md-10 offset-md-1 col-lg-9 offset-lg-0">
				<article class="single-post">
                    <h3>Address Details</h3>
                    <h6>{{Auth::user()->name}}</h6>

                    @if(Auth::user()->address == null)
                        <a onclick="openForm()" style="color:forestgreen;">+Add Address</a>

                        <div class="form-popup" id="myForm">
                            <form action="/carts/address" method = "post" class="form-container">
                            @csrf
                                <h1>Add an address</h1>
                                <input type="text" placeholder="address" name="address" required>
                                <input type="text" placeholder="contact" name="contact" required>
                                <button type="submit" class="btn">Add Address</button>
                                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                            </form>
                        </div>
                    @else 
                    <h6>{{Auth::user()->contact}} 
                    </h6>
                    <h6>{{Auth::user()->address}} @if(Auth::user()->district), {{Auth::user()->district->district_name}} Region @endif
                    </h6>
                    <a onclick="openForm()" style="color:forestgreen;">Change Address</a>

                    <div class="form-popup" id="myForm">
                        <form action="/carts/address" method = "post" class="form-container">
                        @csrf
                            <h1>Change address</h1>
                            <input type="text" placeholder="address" name="address" value="{{Auth::user()->address}}" required>
                            <input type="text" placeholder="contact" name="contact" value ="{{Auth::user()->contact}}"required>
                            <button type="submit" class="btn">Change Address</button>
                            <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                        </form>
                    </div>
                    @endif

                    <script>
                    function openForm() {
                    document.getElementById("myForm").style.display = "block";
                    }

                    function closeForm() {
                    document.getElementById("myForm").style.display = "none";
                    }
                    </script>
                </article>
                @error('address')
                    <p class="alert alert-danger">{{$errors->first('address')}}</p>
                @enderror
                @error('contact')
                    <p class="alert alert-danger">{{$errors->first('contact')}}</p>
                @enderror
				<div class="block comment">
                    <span class="mb-3 d-block">Please select the preferred payment method:</span>
                        <ul>
                            <li>
                                <input type="radio" id="bank-transfer" name="adfeature">
                                <label for="bank-transfer" class="font-weight-bold text-dark py-1">Pay On Delivery</label>
                            </li>
                            <li>
                                <input type="radio" id="Cheque-Payment" name="adfeature">
                                <label for="Cheque-Payment" class="font-weight-bold text-dark py-1">Mobile Money</label>
                            </li>
                        </ul>
                </div>		
			</div>
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
                                <li class="list-inline-item"><a href = "/carts/confirm-order/{{Auth::user()->carts->id}}" class="btn btn-offer d-inline-block btn-primary ml-n1 my-1 px-lg-4 px-md-3" style="color:white;position:relative; left:30px; ">Confirm Order</a></li>
                        </ul>
                    </div>
				</div>
			</div>
		</div>
	</div>
</section>


@endsection