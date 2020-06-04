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
                <h3>{{Auth::user()->name}}, Update this product</h3>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>


<div class="product-details">
    <div class="content mt-5 pt-5">
        <ul class="nav nav-pills  justify-content-center" id="pills-tab" role="tablist" style="position: relative; top:-50px;">
            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home"
                aria-selected="true">Product Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile"
                aria-selected="false">Product Images</a>
            </li>
           <!-- <li class="nav-item">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact"
                aria-selected="false">Reviews</a>
            </li>-->
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <section class="ad-post bg-gray py-5"  style="position: relative; top:-50px;">
                    <div class="container">
                        <form method="POST" action="/products/{{$product->id}}"enctype="multipart/form-data">
                            @csrf
                            @method('put')
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
                                                    value = "{{$product->product_name}}">
                                            @error('product_name')
                                                <p class="alert alert-danger">{{$errors->first('product_name')}}</p>
                                            @enderror
                                            <!-----end of name--------->

                                            <!-- short description of product -->
                                            <h6 class="font-weight-bold pt-4 pb-1">Short description:</h6>
                                            <textarea name="short" id="" class="border p-3 w-100" rows="3" @if($product->short_description == null)placeholder="Enter a short description here" @else placeholder="{{$product->short_description}}" @endif value = "{{$product->short_description}}"></textarea>
                                            @error('short')
                                                <p class="alert alert-danger">{{$errors->first('short')}}</p>
                                            @enderror
                                            <!-----end of short description------>

                                            <!-- long description of product -->
                                            <h6 class="font-weight-bold pt-4 pb-1">Long description:</h6>
                                            <textarea name="long" id="" class="border p-3 w-100" rows="7" @if($product->long_description == null)placeholder="Enter a long description here" @else placeholder="{{$product->long_description}}" @endif value = "{{$product->long_description}}"></textarea>
                                            @error('long')
                                                <p class="alert alert-danger">{{$errors->first('long')}}</p>
                                            @enderror
                                            <!--end of long description-------->
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <!---------Category under which product falls--> 
                                            <h6 class="font-weight-bold pt-4 pb-1">Select Category:</h6>
                                            <select name = "category" id = "inputGroupSelect" class="w-100" onchange = "sub(this)" >
                                                    <option value="">Category</option>   
                                                    @foreach($categories as $category)
                                                        <option value = "{{$category->id}}" @if($super_category->id == $category->id) selected @endif>{{$category->category_name}} </option>  
                                                    @endforeach
                                            </select>

                                            <h6 class="font-weight-bold pt-4 pb-1">Select Sub Category:</h6>
                                            <select name = "subcategory" id = "subcategory" class = "w-100 subcategory" style = "after{content: none}">
                                                <option value="">Sub category</option>
                                                @foreach($child_categories as $child_category)
                                                    <option value="{{$child_category->id}}" @if($chosen_sub->id == $child_category->id) selected @endif>{{$child_category->category_name}}</option>
                                                @endforeach
                                            </select>
                                
                                            <script>  
                                                function sub(chosen){
                                                    y = '/category/get_sub_categories/'+chosen.value;
                                                    jQuery.ajax({
                                                        url: y,  
                                                        method:"GET",
                                                        dataType: "json",
                                                        success: function(data) {
                                                            console.log(data);
                                                            jQuery('#subcategory').empty();
                                                            jQuery('.subcategory .list').empty();
                                                            jQuery('.subcategory .current').empty();
                                                            jQuery('.subcategory .current').append('<span class = "current" style="color:grey;">Choose a sub category</span>');
                                                            if (!$.trim(data)){   
                                                                jQuery('#subcategory').append('<option value = "">No sub categories to choose from</option>');
                                                                jQuery('.subcategory .list').append('<li data-value = "" class = "option">No sub categories to choose from</li>');  
                                                            }
                                                            else{   
                                                                jQuery.each(data, function(key,value) {
                                                                    jQuery('#subcategory').append('<option value = "'+key+'">'+value+'</option>');
                                                                    jQuery('.subcategory .list').append('<li data-value = "'+key+'" class = "option">'+value+'</li>');
                                                                });
                                                            }
                                                        }   
                                                    });
                                                }
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
                                                            id="price" value = "{{$product->price}}">
                                                    </div>

                                                    <div class="col-lg-4 mrx-4  bg-white my-2 ">
                                                        <input type="text" name = 'quantity' class="border-0 py-2 w-100 price" id="Negotiable" value = "{{$product->quantity}}">
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
                                                        <input type="text" name="brand" class="border-0 py-2 w-100 price" placeholder="Brand" id="price" value = "{{$product->brand}}">
                                                    </div>
                                                    <div class="col-lg-4 mrx-4  bg-white my-2 ">
                                                        <input type="text" name = 'color' class="border-0 py-2 w-100 price" id="Negotiable" value = "{{$product->color}}"> 
                                                    </div>
                                                </div>
                                            </div>
                                            <!------------end of brand and color ---------------------------->

                                            <!-----------Condition of the product---------------------------->
                                            <h6 class="font-weight-bold pt-4 pb-1">Condition:</h6>
                                            <select name = "condition" id = "inputGroupSelect" class="w-100">
                                                    <option value="" >Condition</option>
                                                    <option value="brand new" @if($product->condition) selected @endif> Brand New</option>
                                                    <option value="like new" @if($product->condition) selected @endif>Like New</option>
                                                    <option value="fairly used" @if($product->condition) selected @endif>Fairly Used</option>
                                                    <option value="Used" @if($product->condition) selected @endif>Used</option>
                                            </select>
                                            @error('condition')
                                                <p class="alert alert-danger">{{$errors->first('condition')}}</p>
                                            @enderror
                                            <!---------------end of condition of the product----------------->


                                            <!--------------------uploading image/images of product -------------->
                                            
                                            <!-------------------end of image upload------------------------>
                                        </div>
                                    </div>
                            </fieldset>
                            <!-- submit button -->
                            
                            <button type="submit" class="btn btn-primary d-block mt-2">Post Your Ad</button>
                        </form>
                    </div>
                </section>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <section class="ad-post bg-gray py-5"  style="position: relative; top:-50px;">
                    <div class="container">
                        @php($x = 1)
                        @foreach($images as $image)
                            <img width = "150" height = "150" src="/images/products/{{$product->id}}/{{$x}}.jpg">
                            @php($x = $x + 1)
                        @endforeach
                        <form action = "#" method = "POST" >
                            @csrf
                            <!--------------------uploading image/images of product ------------
                            <div class="choose-file text-center my-4 py-4 rounded">
                                <div id="filediv">
                                    <input name="files[]" type="file" id="file"/><br/>
                                </div>
                                <input type="button" id="add_more" class="upload" value="Add More Files"/>
                            </div>
                            <script>
                                var abc = 0;      
                                // Declaring and defining global increment variable.
                                $(document).ready(function() {
                                //  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
                                    $('#add_more').click(function() {
                                        $(this).before($("<div/>", {
                                            id: 'filediv'
                                        }).fadeIn('slow').append($("<input/>", {
                                            name: 'files[]',
                                            type: 'file',
                                            id: 'file'
                                        }), $("<br/>")));
                                    });
                                // Following function will executes on change event of file input to select different file.
                                    $('body').on('change', '#file', function() {
                                        if (this.files && this.files[0]) {
                                            abc += 1; // Incrementing global variable by 1.
                                            var z = abc - 1;
                                            var x = $(this).parent().find('#previewimg' + z).remove();
                                            $(this).before("<div id='abcd" + abc + "' class='abcd'><img width = '100' height = '100' id='previewimg" + abc + "' src=''/></div>");
                                            var reader = new FileReader();
                                            reader.onload = imageIsLoaded;
                                            reader.readAsDataURL(this.files[0]);
                                            $(this).hide();
                                            $("#abcd" + abc).append($("<img/>", {
                                                id: 'img',
                                                src: '/images/x.png',
                                                style: 'position:relative; left:-15px; top:-40px',
                                                alt: 'delete'
                                            }).click(function() {
                                                    $(this).parent().parent().remove();
                                                })
                                            );
                                        }
                                    });
                                // To Preview Image
                                    function imageIsLoaded(e) {
                                        $('#previewimg' + abc).attr('src', e.target.result);
                                    };
                                    $('#upload').click(function(e) {
                                        var name = $(":file").val();
                                        if (!name) {
                                            alert("First Image Must Be Selected");
                                            e.preventDefault();
                                        }
                                    });
                                });
                            </script>
                            @error('files')
                                <p class="alert alert-danger">{{$errors->first('files')}}</p>
                            @enderror
                            <!-------------------end of image upload------------------------>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

@endsection