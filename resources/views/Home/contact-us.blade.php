@extends('layouts.app')

@section('content')
<!--================================
=            Page Title            =
=================================-->
<section class="page-title" style="background-color:forestgreen;">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<div class="col-md-8 offset-md-2 text-center">
				<!-- Title text -->
				<h3>Contact Us</h3>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>
<!-- page title -->

<!-- contact us start-->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="contact-us-content p-4">
                    <h5>Contact Us</h5>
                    <h1 class="pt-3">Hello @auth{{Auth::user()->name}}@endauth, what's on your mind?</h1>
                    <p class="pt-3 pb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla elit dolor, blandit vel euismod ac, lentesque et dolor. Ut id tempus ipsum.</p>
                </div>
            </div>
            <div class="col-md-6">
                    <form action="/contact-us" method = "post">
                        @csrf
                        <fieldset class="p-4">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6 py-2">
                                        <input type="text" name ="name" placeholder="Name *" value ="{{old('name')}}" class="form-control" required>
                                        @error('name')
                                        <p class="alert alert-danger">{{$errors->first('name')}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 pt-2">
                                        <input type="email" name="email" placeholder="Email *" value ="{{old('email')}}" class="form-control" required>
                                        @error('email')
                                        <p class="alert alert-danger">{{$errors->first('email')}}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <select name="category" id="" class="form-control w-100">
                                <option value="">Category</option>
                                @foreach($categories as $category)
                                        <option value = "{{$category->id}}" @if(old('category') == $category->id) selected @endif>{{$category->category_name}} </option>  
                                @endforeach
                            </select>
                            @error('category')
                            <p class="alert alert-danger">{{$errors->first('category')}}</p>
                            @enderror
                            <textarea name="message" id=""  placeholder="Message *" value = "{{old('message')}}" class="border w-100 p-3 mt-3 mt-lg-4"></textarea>
                            @error('message')
                            <p class="alert alert-danger">{{$errors->first('message')}}</p>
                            @enderror
                            <div class="btn-grounp">
                                <button type="submit" class="btn btn-primary mt-2 float-right">SUBMIT</button>
                            </div>
                        </fieldset>
                    </form>
            </div>
        </div>
    </div>
</section>
<!-- contact us end -->


@endsection