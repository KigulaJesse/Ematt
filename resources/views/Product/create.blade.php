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
                <h3>{{Auth::user()->name}}, Add some Products</h3>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>

<section class="ad-post bg-gray py-5">
    <div class="container">
        <form method="POST" action="{{url('/products')}}"enctype="multipart/form-data">
            @csrf
            <!-- Post Your ad start -->
            <fieldset class="border border-gary p-4 mb-5">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3>Post Your Product For Sell</h3>
                        </div>
                        <div class="col-lg-6">
                            <!--product name -->
                            <h6 class="font-weight-bold pt-4 pb-1">Name Of Product:</h6>
                            <input type="text" 
                                   name='product_name' 
                                   class="border w-100 p-2 bg-white text-capitalize" 
                                   placeholder="Type product name"
                                   value = "{{old('product_name')}}">
                            @error('product_name')
                                <p class="alert alert-danger">{{$errors->first('product_name')}}</p>
                            @enderror
                            <!-----end of name--------->

                            <!--<h6 class="font-weight-bold pt-4 pb-1">Ad Type:</h6>
                            <div class="row px-3">
                                <div class="col-lg-4 mr-lg-4 my-2 rounded bg-white">
                                    <input type="radio" name="itemName" value="personal" id="personal">
                                    <label for="personal" class="py-2">Personal</label>
                                </div>
                                <div class="col-lg-4 mr-lg-4 my-2 rounded bg-white ">
                                    <input type="radio" name="itemName" value="business" id="business">
                                    <label for="business" class="py-2">Business</label>
                                </div>
                            </div>-->

                            <!-- short description of product -->
                            <h6 class="font-weight-bold pt-4 pb-1">Short description:</h6>
                            <textarea name="short" id="" class="border p-3 w-100" rows="3" placeholder="Enter a short description here" value = "{{old('short')}}"></textarea>
                            @error('short')
                                <p class="alert alert-danger">{{$errors->first('short')}}</p>
                            @enderror
                            <!-----end of short description------>

                            <!-- long description of product -->
                            <h6 class="font-weight-bold pt-4 pb-1">Long description:</h6>
                            <textarea name="long" id="" class="border p-3 w-100" rows="7" placeholder="Enter a detailed description of product" value = "{{old('long')}}"></textarea>
                            @error('long')
                                <p class="alert alert-danger">{{$errors->first('long')}}</p>
                            @enderror
                            <!--end of long description-------->
                        </div>


                        <div class="col-lg-6">
                            <!---------Category under which product falls --->
                            <h6 class="font-weight-bold pt-4 pb-1">Select Category:</h6>
                            <select name = "category" id = "inputGroupSelect" class="w-100" value = "{{old('category')}}">
                                    <option value="">Category</option>
                                    @foreach($categories as $category)
                                        <option value = "{{$category->id}}">{{$category->category_name}} </option>  
                                    @endforeach
                            </select>

                            <!--<h6 class="font-weight-bold pt-4 pb-1">Select Sub Category:</h6>
                            <select name = "subcategory" id = "inputGroupSelect" class="w-100 subcategory">
                                <option value="">Sub category</option>
                            </select>-->

                            <script type="text/javascript">  
                                jQuery(document).ready(function (){
                                    jQuery('select[name="category"]').on('change',function(){
                                            var category_ID = jQuery(this).val();
                                            if(category_ID){
                                                jQuery.ajax({
                                                    url : '/category/get_sub_categories/'+category_ID,
                                                    type : "GET",
                                                    dataType : "json",
                                                    success:function(data){
                                                        console.log(data);
                                                        jQuery('select[name="subcategory"]').empty();
                                                        jQuery.each(data, function(key,value){
                                                            jQuery('select[name="subcategory"]').append('<option value="'+ key +'">'+ value +'</option>');
                                                            $('select[name="subcategory"').on('change', function (e){
                                                                $('div').append("//not sure how to write code here");
                                                             });     
                                                        });
                                                    }
                                                });
                                            }   
                                            else{
                                                $('select[name="subcategory"]').empty();
                                            }
                                    });
                                });
                            </script>
                            @error('category')
                            <p class="alert alert-danger">{{$errors->first('category')}}</p>
                            @enderror
                            <!------------end of category ------------------->
                            
                            <!------------price and quantity ----------------------------->
                            <div class="price">
                                <h6 class="font-weight-bold pt-3 pb-1">Item Price (Ush):  &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      Quantity:</h6>
                                <div class="row px-3">
                                    <div class="col-lg-4 mr-lg-4 rounded bg-white my-2 ">
                                        <input type="text" name="price" class="border-0 py-2 w-100 price" placeholder="Price"
                                            id="price" value = "{{old('price')}}">
                                    </div>

                                    <div class="col-lg-4 mrx-4  bg-white my-2 ">
                                        <input type="text" name = 'quantity' class="border-0 py-2 w-100 price" id="Negotiable" value = "{{old('quantity')}}">
                                    </div>
                                </div>
                                @error('price')
                                <p class="alert alert-danger">{{$errors->first('price')}}</p>
                                @enderror
                                @error('quantity')
                                <p class="alert alert-danger">{{$errors->first('quantity')}}</p>
                                @enderror
                            </div>
                            <!---------------------end of price and quantity--------------->

                            <!-------------------- Brand and color ------------------------>
                            <div class="price">
                                <h6 class="font-weight-bold pt-3 pb-1">Brand:  &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      Color:</h6>
                                <div class="row px-3">
                                    <div class="col-lg-4 mr-lg-4 rounded bg-white my-2 ">
                                        <input type="text" name="brand" class="border-0 py-2 w-100 price" placeholder="Brand" id="price" value = "{{old('brand')}}">
                                    </div>

                                    <div class="col-lg-4 mrx-4  bg-white my-2 ">
                                        <input type="text" name = 'color' class="border-0 py-2 w-100 price" id="Negotiable" value = "{{old('color')}}"> 
                                    </div>
                                </div>
                            </div>
                            <!------------end of brand and color ---------------------------->

                            <!-----------Condition of the product---------------------------->
                            <h6 class="font-weight-bold pt-4 pb-1">Condition:</h6>
                            <select name = "condition" id = "inputGroupSelect" class="w-100" value = "{{old('condition')}}">
                                    <option value="">Condition</option>
                                    <option value="brand new">Brand New</option>
                                    <option value="like new">Like New</option>
                                    <option value="fairly used">Fairly Used</option>
                                    <option value="Used">Used</option>
                            </select>
                            @error('condition')
                                <p class="alert alert-danger">{{$errors->first('condition')}}</p>
                            @enderror
                            <!---------------end of condition of the product----------------->


                            <!--------------------uploading image/images of product -------------->
                            <div class="choose-file text-center my-4 py-4 rounded">
                                <label for="file-upload">
                                    <span class="d-block font-weight-bold text-dark">Drop files anywhere to upload</span>
                                    <span class="d-block">or</span>
                                    <span class="d-block btn bg-primary text-white my-3 select-files">Select files</span>
                                    <span class="d-block">Maximum upload file size: 500 KB</span>
                                    <input type="file" class="form-control-file d-none" id="file-upload" name="file-upload">
                                </label>
                            </div>
                            @error('file-upload')
                                <p class="alert alert-danger">{{$errors->first('file-upload')}}</p>
                            @enderror
                            <!-------------------end of image upload------------------------>
                        </div>
                    </div>
            </fieldset>
            <!-- Post Your ad end -->

            <!--seller-information start
            <fieldset class="border p-4 my-5 seller-information bg-gray">
                <div class="row">
                    <div class="col-lg-12">
                        <h3>Seller Information</h3>
                    </div>
                    <div class="col-lg-6">
                        <h6 class="font-weight-bold pt-4 pb-1">Contact Name:</h6>
                        <input type="text" placeholder="Contact name" class="border w-100 p-2">
                        <h6 class="font-weight-bold pt-4 pb-1">Contact Number:</h6>
                        <input type="text" placeholder="Contact Number" class="border w-100 p-2">
                    </div>
                    <div class="col-lg-6">
                        <h6 class="font-weight-bold pt-4 pb-1">Contact Name:</h6>
                        <input type="email" placeholder="name@yourmail.com" class="border w-100 p-2">
                        <h6 class="font-weight-bold pt-4 pb-1">Contact Name:</h6>
                        <input type="text" placeholder="Your address" class="border w-100 p-2">
                    </div>
                </div>
            </fieldset>
            <!-- seller-information end-->

            <!-- ad-feature start 
            <fieldset class="border bg-white p-4 my-5 ad-feature bg-gray">
                <div class="row">
                    <div class="col-lg-12">

                        <h3 class="pb-3">Make Your Ad Featured
                            <span class="float-right"><a class="text-right font-weight-normal text-success" href="#">What
                                    is featured ad ?</a></span>
                        </h3>

                    </div>
                    <div class="col-lg-6 my-3">
                        <span class="mb-3 d-block">Premium Ad Options:</span>
                        <ul>
                            <li>
                                <input type="radio" id="regular-ad" name="adfeature">
                                <label for="regular-ad" class="font-weight-bold text-dark py-1">Regular Ad</label>
                                <span>$00.00</span>
                            </li>
                            <li>
                                <input type="radio" id="Featured-Ads" name="adfeature">
                                <label for="Featured-Ads" class="font-weight-bold text-dark py-1">Top Featured Ads</label>
                                <span>$59.00</span>
                            </li>
                            <li>
                                <input type="radio" id="urgent-Ads" name="adfeature">
                                <label for="urgent-Ads" class="font-weight-bold text-dark py-1">Urgent Ads</label>
                                <span>$79.00</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 my-3">
                        <span class="mb-3 d-block">Please select the preferred payment method:</span>
                        <ul>
                            <li>
                                <input type="radio" id="bank-transfer" name="adfeature">
                                <label for="bank-transfer" class="font-weight-bold text-dark py-1">Direct Bank Transfer</label>
                            </li>
                            <li>
                                <input type="radio" id="Cheque-Payment" name="adfeature">
                                <label for="Cheque-Payment" class="font-weight-bold text-dark py-1">Cheque Payment</label>
                            </li>
                            <li>
                                <input type="radio" id="Credit-Card" name="adfeature">
                                <label for="Credit-Card" class="font-weight-bold text-dark py-1">Credit Card</label>
                            </li>
                        </ul>
                    </div>
                </div>
            </fieldset>
            <!-- ad-feature start -->

            <!-- submit button -->
            <div class="checkbox d-inline-flex">
                <input type="checkbox" id="terms-&-condition" name = 'terms' class="mt-1">
                <label for="terms-&-condition" class="ml-2">By click you must agree with our
                    <span> <a class="text-success" href="terms-condition.html">Terms & Condition and Posting Rules.</a></span>
                </label>
                
            </div>
            @error('terms')
                    <p class="alert alert-danger">{{$errors->first('terms')}}</p>
            @enderror

            <button type="submit" class="btn btn-primary d-block mt-2">Post Your Ad</button>
        </form>
    </div>
</section>
@endsection