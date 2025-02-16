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
      top: 50%; 
            left: 50%; 
            margin-top: -150px; 
            margin-left: -150px; 
        
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
                    @if (session('address_status'))
                        <p class="alert alert-success">{{session('address_status')}}</p>
                    @endif
                    <h3>Address Details</h3>
                    <h6>{{Auth::user()->name}}</h6>

                    @if(Auth::user()->district_id == null)
                        <a onclick="openForm()" style="color:forestgreen;">+Add Address</a>
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                        @error('contact')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        
                        @if(session('error_status'))
                            <h6 style="color :red;">{{ session('error_status') }}</h6>
                        @endif
                        <div class="form-popup" id="myForm">
                            <form action="/carts/address" method = "post" class="form-container">
                            @csrf
                                <h1>Add an address</h1>
                                <select name = "address" id = "inputGroupSelect" class="w-100" onchange = "sub(this)" required>
                                    <option value="">District</option>   
                                    @foreach($districts as $district)
                                        <option value = "{{$district->id}}" @if(old('address') == $district->id) selected @endif>{{$district->district_name}} </option>  
                                    @endforeach
                                </select>
                                <div style="position:relative; top:10px;">
                                    <select name = "sublocation" id = "sublocation" class = "w-100 sublocation" style = "after{content: none}">
                                        <option value="">Location</option>
                                    </select> 
                                </div>   
                                <input type="text" style="position:relative; top:15px;"value = "{{Auth::user()->contact}}" name="contact" required>
                                <button type="submit" class="btn">Add Address</button>
                                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                            </form>
                        </div>
                        <script>  
                            function sub(chosen){
                                y = '/district/get_sub_locations/'+chosen.value;
                                jQuery.ajax({
                                    url: y,  
                                    method:"GET",
                                    dataType: "json",
                                    success: function(data) {
                                        console.log(data);
                                        jQuery('#sublocation').empty();
                                        jQuery('.sublocation .list').empty();
                                        jQuery.each(data, function(key,value) {
                                            jQuery('#sublocation').append('<option value = "'+key+'">'+value+'</option>');
                                            jQuery('.sublocation .list').append('<li data-value = "'+key+'" class = "option">'+value+'</li>');
                                        }); 
                                    }   
                                });
                            }
                        </script>

                    @else 
                        <h6>{{Auth::user()->contact}} 
                        </h6>
                        <h6>{{Auth::user()->district->district_name}} 
                            @if(App\District::find(Auth::user()->district->parent_id))
                                , {{$parent_district->district_name}} Region 
                            @endif
                        </h6>
                        <a onclick="openForm()" style="color:forestgreen;">Change Address</a>

                        <div class="form-popup" id="myForm">
                            <form action="/carts/address" method = "post" class="form-container">
                            @csrf
                                <h1>Change address</h1>
                                <select name = "address" id = "inputGroupSelect1" class="w-100" onchange = "sub1(this)" required>   
                                    @foreach($districts as $district)
                                        <option value = "{{$district->id}}" @if($parent_district->id == $district->id) selected @endif>{{$district->district_name}} </option>  
                                    @endforeach
                                </select>
                                <div style="position:relative; top:10px;">
                                    <select name = "sublocation" id = "sublocation1" class = "w-100 sublocation1" style = "after{content: none}">
                                        @foreach($locations as $location)
                                            <option value = "{{$location->id}}" @if(Auth::user()->district_id == $location->id) selected @endif>{{$location->district_name}} </option>  
                                        @endforeach
                                    </select> 
                                </div>
                                <input type="text" style="position:relative; top:15px;" placeholder="contact" name="contact" value ="{{Auth::user()->contact}}"required>
                                <button type="submit" class="btn">Change Address</button>
                                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                            </form>
                            <script>  
                                function sub1(chosen){
                                    y = '/district/get_sub_locations1/'+chosen.value;
                                    $("#sublocation option:selected").attr('disabled','disabled').siblings().removeAttr('disabled');                 
                                    jQuery.ajax({
                                        url: y,  
                                        method:"GET",
                                        dataType: "json",
                                        success: function(data) {
                                            console.log(data);
                                            jQuery('#sublocation1').empty();
                                            jQuery('.sublocation1 .list').empty();
                                            jQuery('.sublocation1 .current').empty();
                                            jQuery('.sublocation1 .current').append('<span class = "current">choose location</span>');
                                            if (!$.trim(data)){   
                                                jQuery('#sublocation1').append('<option value = "">No locations to choose from</option>');
                                                jQuery('.sublocation1 .list').append('<li data-value = "" class = "option">No locations to choose from</li>');  
                                            }
                                            else{
                                                jQuery.each(data, function(key,value) {
                                                    jQuery('#sublocation1').append('<option value = "'+key+'">'+value+'</option>');
                                                    jQuery('.sublocation1 .list').append('<li data-value = "'+key+'" class = "option">'+value+'</li>');
                                                });
                                            } 
                                        }   
                                    });
                                }
                            </script>    
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
                    <span class="mb-3 d-block"><h3>Please select the preferred payment method:</h3></span>
                    @if (session('payment'))
                        <p class="alert alert-success">{{session('payment')}}</p>
                    @endif
                        
                    <form method = "post" action = "/payment">
                        @csrf
                        @method('put')
                        <ul>
                            <li>
                                <input type="radio" 
                                    id="bank-transfer" 
                                    name="payment" 
                                    value = "POD" 
                                    @if(Auth::user()->payment_type == 'POD') checked @endif>
                                <label for="bank-transfer" ><h6>Pay On Delivery</h6></label>
                            </li>
                            <li>
                                <input 
                                    type="radio" 
                                    id="Cheque-Payment" 
                                    name="payment" 
                                    value = "mobile money" 
                                    @if(Auth::user()->payment_type == 'mobile money') checked @endif>
                                <label for="Cheque-Payment"><h6>Mobile Money</h6></label>
                            </li>
                        </ul>
                        @error('payment')
                            <h6 style="color :red;">*Please choose a payment option</h6>
                        @enderror
                        @if(session('error_payment'))
                            <h6 style="color :red;">{{ session('error_payment') }}</h6>
                        @endif
                        <button type="submit" class="d-block py-3 px-4 bg-primary text-white border-0 rounded font-weight-bold">
                            {{ __('Add') }}
                        </button>
                    </form>
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
                                @if($product->pivot->ordered == null)
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