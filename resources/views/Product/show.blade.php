<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Bootstrap-ecommerce by Vosidiy">

    <title>Catalog List - Shopper</title>

    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">

    <!-- jQuery -->
    <script src="/js2/jquery-2.0.0.min.js" type="text/javascript"></script>

    <!-- Bootstrap4 files-->
    <script src="/js2/bootstrap.bundle.min.js" type="text/javascript"></script>
    <link href="/css2/bootstrap.css?v=1.0" rel="stylesheet" type="text/css" />

    <!-- Font awesome 5 -->
    <link href="/fonts2/fontawesome/css/fontawesome-all.min.css" type="text/css" rel="stylesheet">

    <!-- plugin: fancybox  -->
    <script src="/plugins2/fancybox/fancybox.min.js" type="text/javascript"></script>
    <link href="/plugins2/fancybox/fancybox.min.css" type="text/css" rel="stylesheet">

    <!-- plugin: owl carousel  -->
    <link href="/plugins2/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="/plugins2/owlcarousel/assets/owl.theme.default.css" rel="stylesheet">
    <script src="/plugins2/owlcarousel/owl.carousel.min.js"></script>

    <!-- custom style -->
    <link href="/css2/ui.css?v=1.0" rel="stylesheet" type="text/css" />
    <link href="/css2/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)" />

    <!-- custom javascript -->
    <script src="/js2/script.js" type="text/javascript"></script>

    <script type="text/javascript">
        /// some script

        // jquery ready start
        $(document).ready(function() {
            // jQuery code

        });
        // jquery end
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>     

    <!-- Scripts 
    <script src="{{ asset('js/app.js') }}" defer></script>--> 


    <!-- Fonts 
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">-->

    <!-- Styles -->
    <!--<link href="{{ asset('/css/app.css') }}" rel="stylesheet">-->
    <!-- FAVICON -->
    <link href="/img/favicon.png" rel="shortcut icon">
    <!-- PLUGINS CSS STYLE -->
    <!-- <link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet"> -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/plugins/bootstrap/css/bootstrap-slider.css">
    <!-- Font Awesome -->
    <link href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- Owl Carousel -->
    <link href="/plugins/slick-carousel/slick/slick.css" rel="stylesheet">
    <link href="/plugins/slick-carousel/slick/slick-theme.css" rel="stylesheet">
    <!-- Fancy Box -->
    <link href="{{asset('/plugins/fancybox/jquery.fancybox.pack.css')}}" rel="stylesheet">
    <link href="{{asset('/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet">
    <!-- CUSTOM CSS -->
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    

</head>

<body>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg navbar-light navigation">
                        <a class="navbar-brand" href="/">
                            <img src="/images/logo.png" style="postion:relative;" width="200" alt="">
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                         aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto main-nav ">
                            
                                    <li class = "{{Request::is('/') ? 'nav-item active' : ''}} nav-item"><a class="nav-link" href="/">Home</a></li>
                                    <li class = "{{Request::is('home') ? 'nav-item active' : ''}} nav-item"><a class="nav-link" href="/home">Buy Now</a></li>
                                    
                                    <li class="{{Request::is('products')||Request::is('product') ? 'nav-item active' : ''}} nav-item dropdown dropdown-slide">
                                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="">Sell Now<span><i class="fa fa-angle-down"></i></span>
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="/product">Add Product</a>
                                            @auth
                                                @if(count(Auth::user()->products) > 0)
                                                <a class="dropdown-item" href="/products">View Your Products</a>
                                                @endif
                                            @endauth  
                                        </div>
                                    </li>
                                    <li class="{{Request::is('about-us') || Request::is('update')  ? 'nav-item active' : ''}} nav-item dropdown dropdown-slide">
                                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="">Help<span><i class="fa fa-angle-down"></i></span>
                                        </a>
                                        <div class="dropdown-menu">
                                            @auth
                                                <!--<a class="dropdown-item" href="/update">Your Profile</a>-->
                                            @endauth
                                            <a class="dropdown-item" href="/about-us">About-Us</a>
                                            <a class="dropdown-item" href="/contact-us">Contact-Us</a>
                                        </div>
                                    </li> 
    
                                    @if(isset(Auth::user()->user_type) == 'admin')
                                        <li class = "nav-item"><a class="nav-link" href="/administrator">Admin</a></li>
                                    @endif
                                    
                            
                                 <!-- <div id="app">
                                     <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
    
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">-->
                        <!-- Left Side Of Navbar -->
                        <!--<ul class="navbar-nav mr-auto">
    
                        </ul>-->
    
                        <!-- Right Side Of Navbar -->
                        <!--<ul class="navbar-nav ml-auto"> -->
                            <!-- Authentication Links -->
                            <!--@guest
                                <li class="nav-item">
                                    <a class="nav-link" href="">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>
    
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
    
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>-->
    
      
                                
                            </ul>
                            @guest
    
                            <ul class="navbar-nav ml-auto mt-10">
                                <li class="nav-item">
                                    <a class="nav-link login-button" href="{{ route('login') }}">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link login-button" href="{{ route('register') }}">Register</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white add-button" href="#"><i class="fa fa-shopping-cart"></i></a>
                                </li>
                            </ul>
                            @else 
                            <ul class="navbar-nav ml-auto mt-10">
                                <li class="nav-item">
                                    <a class="nav-link login-button" href="{{ route('logout') }}"onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                    </form>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-white add-button" href="/cart"><i class="fa fa-shopping-cart"></i></a>
                                </li>
                            </ul>
                            @endguest
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    
    <section class="page-search" style = " background-color:forestgreen;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Advance Search -->
                            <div class="advance-search">
                                <form method = "POST" action = "/category">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-10">
                                            <input type="text" name = 'search' class="form-control my-2 my-lg-0" id="inputCategory4" @if(isset(Auth::user()->name))placeholder="Welcome {{Auth::user()->name}}, what are you looking for in Ematt today?"@else placeholder="Welcome what are you looking for in Ematt today?" @endif  >
                                        </div>
                                        <div class="form-group col-md-2">
                                            <button type="submit" class="btn btn-primary" style = "">Search Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                </div>
            </div>
        </div>
    </section>
    
    
    <!-- ========================= SECTION INTRO END// ========================= -->
    <!-- ========================= SECTION CONTENT ========================= -->
    <section class="section-content bg padding-y border-top">
        <div class="container">
            @if (session('cart add') == "This product has been added to cart")
                <p class="alert alert-success">{{session('cart add')}}</p>
            @endif
	        @if(session('cart add') == "This product is already in cart")
		        <p class="alert alert-danger">{{session('cart add')}}</p>
            @endif
    
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="row no-gutters">
                            <aside class="col-sm-5 border-right">
                                <article class="gallery-wrap">
                                    <div class="img-big-wrap">
                                        <div>
                                            <img src="/images/products/{{$product->id}}/1.jpg"></a>
                                        </div>
                                    </div>
                                    <!-- slider-product.// -->
                                    <div class="img-small-wrap">
                                        @php($x = 1)
                                        @foreach($images as $image)
                                        <div class="item-gallery"> <img src="/images/products/{{$product->id}}/{{$x}}.jpg"></div>
                                            @php($x = $x + 1)
                                        @endforeach
                                    </div>
                                    <!-- slider-nav.// -->
                                </article>
                                <!-- gallery-wrap .end// -->
                            </aside>
                            <aside class="col-sm-7">
                                <article class="p-5">
                                    <h3 class="title mb-3">
                                        @if ($product->short_description)
                                            {{$product->short_description}}
                                        @else
                                            {{$product->product_name}} for sale
                                        @endif
                                    </h3>

                                    <div class="mb-3">
                                        <var class="price h3 text-warning">
                                            <span class="currency">Ush</span><span class="num"> {{number_format($product->price)}}</span>
                                        </var>
                                        <span>/per item</span>
                                    </div>
                                    <!-- price-detail-wrap .// -->
                                    <dl>
                                        <dt>Description</dt>
                                        <dd>
                                            @if ($product->short_description)
                                                {{$product->short_description}}
                                            @else
                                                {{$product->product_name}} is being sold on Ematt, your favourite online shopping centre. Browse and buy other products.
                                            @endif
                                        </dd>
                                    </dl>
                                    <dl class="row">

                                        <dt class="col-sm-3">Condition:</dt>
                                        <dd class="col-sm-9">{{$product->condition}}</dd>
                                        
                                        @if($product->brand)
                                            <dt class="col-sm-3">Brand</dt>
                                            <dd class="col-sm-9">{{$product->brand}}</dd>
                                        @endif
                                        
                                        @if($user->district)
                                            <dt class="col-sm-3">Location:</dt>
                                            <dd class="col-sm-9">{{$user->district->district_name}}</dd>
										@endif
                                    </dl>
                                    <div class="rating-wrap">

                                        <ul class="rating-stars">
                                            <li style="width:80%" class="stars-active">
                                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </li>
                                            <li>
                                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </li>
                                        </ul>
                                        <!--<div class="label-rating">132 reviews</div>
                                        <div class="label-rating">154 orders </div>-->
                                    </div>
                                    <!-- rating-wrap.// -->
                                    <hr>
                                        <div class="row">
                                        <div class="col-sm-5">
                                            <dl class="dlist-inline">
                                                <dt>Quantity: </dt>
                                                <dd>
                                                    <select class="form-control form-control-sm" style="width:70px;">
                                                        <option> 1 </option>
                                                        <option> 2 </option>
                                                        <option> 3 </option>
                                                    </select>
                                                </dd>
                                            </dl>
                                            <!-- item-property .// -->
                                        </div>
                                        <!-- col.// -->
                                        <!--<div class="col-sm-7">
                                            <dl class="dlist-inline">
                                                <dt>Size: </dt>
                                                <dd>
                                                    <label class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                        <span class="form-check-label">SM</span>
                                                    </label>
                                                    <label class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                        <span class="form-check-label">MD</span>
                                                    </label>
                                                    <label class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                        <span class="form-check-label">XXL</span>
                                                    </label>
                                                </dd>
                                            </dl>
                                            <!-- item-property .// 
                                        </div>-->
                                        <!-- col.// -->
                                    </div>
                                    <!-- row.// -->
                                    <hr>
                                    <!--<a href="/cart/{{$product->id}}"  class="btn  btn-primary"> Buy now </a>-->
                                    <a href="/cart/{{$product->id}}" class="btn  btn-outline-primary"> <i class="fas fa-shopping-cart"></i> Add to cart </a>
                                </article>
                                <!-- card-body.// -->
                            </aside>
                            <!-- col.// -->
                        </div>
                        <!-- row.// -->
                    </div>
                    <!-- card.// -->

                </div>
                <div class="col-md-12">
                    <article class="card mt-4">
                        <div class="card-body">
                            <!--META-INFORMATION AT THE TOP OF IMAGES-->
                                <div class="product-meta">
                                    <ul class="list-inline">
                                        <li  class="list-inline-item"><h4>Detail overview</h4></li>
                                        <li class="list-inline-item"><i class="fa fa-user-o"></i> Seller <a href="/category/user/{{$user->id}}">{{$user->name}}</a></li>
                                        <li class="list-inline-item"><i class="fa fa-folder-open-o"></i> Category<a href="/category/{{$product->category->last()->category_name}}">{{$product->category->last()->category_name}}</a></li>
                                        @if(isset($user->district->id))
                                            <li class="list-inline-item"><i class="fa fa-location-arrow"></i> Location<a href="/category/district/{{$user->district->id}}">{{$user->district->district_name}} District</a></li>
                                        @endif
                                    </ul>
                                </div>

                            @if($product->long_description)
                                    {{$product->long_description}}
                            @else
                                <p>This product was added to Ematt and is approved by the Ematt team</P>
                            @endif
                        </div>
                        <!-- card-body.// -->
                    </article>
                </div>
            </div>
        </div>
    </section>
    <!--====================================================================-->

<footer class="footer section section-sm">
    <!-- Container Start -->
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-7 offset-md-1 offset-lg-0">
          <!-- About -->
          <div class="block about">
            <!-- footer logo -->
            <img src="/images/logo-footer.png" alt="">
            <!-- description -->
            <p class="alt-color">This is Ematt your one stop shopping centre for all gadgets and goods. Thank you for choosing us and being part
              of our brand. Browse through a selection of all kinds of goods.
            </p>
          </div>
        </div>
        <!-- Link list -->
        <div class="col-lg-2 offset-lg-1 col-md-3">
          <div class="block">
            <h4>Site Pages</h4>
            <ul>
              <li><a href="/about-us">About-Us</a></li>
              <li><a href="/contact-us">Contact-Us</a></li>
             <!-- <li><a href="#">Deals & Coupons</a></li>
              <li><a href="#">Articls & Tips</a></li>-->
              <li><a href="/Terms-and-conditions">Terms & Conditions</a></li>
            </ul>
          </div>
        </div>
        <!-- Link list -->
        <div class="col-lg-2 col-md-3 offset-md-1 offset-lg-0">
          <div class="block">
            <h4>Admin Pages</h4>
            <!--<ul>
              <li><a href="category.html">Category</a></li>
              <li><a href="single.html">Single Page</a></li>
              <li><a href="store.html">Store Single</a></li>
              <li><a href="single-blog.html">Single Post</a>
              </li>
              <li><a href="blog.html">Blog</a></li>
  
  
  
            </ul>-->
          </div>
        </div>
        <!-- Promotion -->
        <div class="col-lg-4 col-md-7">
          <!-- App promotion -->
          <div class="block-2 app-promotion">
            <div class="mobile d-flex">
              <a href="">
                <!-- Icon -->
                <img src="/images/footer/phone-icon.png" alt="mobile-icon">
              </a>
              <p>Get the Dealsy Mobile App and Save more</p>
            </div>
            <div class="download-btn d-flex my-3">
              <a href="#"><img src="/images/apps/google-play-store.png" class="img-fluid" alt=""></a>
              <a href="#" class=" ml-3"><img src="/images/apps/apple-app-store.png" class="img-fluid" alt=""></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Container End -->
  </footer>
  <!-- Footer Bottom -->
  <footer class="footer-bottom">
    <!-- Container Start -->
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-12">
          <!-- Copyright -->
          <div class="copyright">
            <p>Copyright © <script>
                var CurrentYear = new Date().getFullYear()
                document.write(CurrentYear)
              </script>. All Rights Reserved, Developed by<a class="text-primary" href="#" target="_blank"> Jarla</a></p>
          </div>
        </div>
        <div class="col-sm-6 col-12">
          <!-- Social Icons -->
          <ul class="social-media-icons text-right">
            <li><a class="fa fa-facebook" href="#" target="_blank"></a></li>
            <li><a class="fa fa-twitter" href="#" target="_blank"></a></li>
            <li><a class="fa fa-pinterest-p" href="#" target="_blank"></a></li>
            <li><a class="fa fa-vimeo" href="#"></a></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Container End -->
    <!-- To Top -->
    <div class="top-to">
      <a id="top" class="" href="#"><i class="fa fa-angle-up"></i></a>
    </div>
  </footer>
  
  <!-- JAVASCRIPTS -->

  <script src="/plugins/jQuery/jquery.min.js"></script>
  <script src="/plugins/bootstrap/js/popper.min.js"></script>
  <script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
  <script src="/plugins/bootstrap/js/bootstrap-slider.js"></script>
    <!-- tether js -->
  <script src="/plugins/tether/js/tether.min.js"></script>
  <script src="/plugins/raty/jquery.raty-fa.js"></script>
  <script src="/plugins/slick-carousel/slick/slick.min.js"></script>
  <script src="/plugins/jquery-nice-select/js/jquery.nice-select.min.js"></script>
  <script src="/plugins/fancybox/jquery.fancybox.pack.js"></script>
  <script src="/plugins/smoothscroll/SmoothScroll.min.js"></script>
  <!-- google map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>
  <script src="/plugins/google-map/gmap.js"></script>
  <script src="/js/script.js"></script>  


    <!-- ========================= SECTION CONTENT RELATED PRODUCTS END// ========================= -->
    <!--<section class="section-content padding-y-sm bg">
        <div class="container">

            <header class="section-heading heading-line">
                <h4 class="title-section bg">Related PRODUCTS</h4>
            </header>
            <div class="row">
                <div class="col-md-4">
                    <figure class="card card-product">
                        <div class="img-wrap"><img src="images/items/1.jpg"></div>
                        <figcaption class="info-wrap">
                            <h4 class="title">Another name of item</h4>
                            <p class="desc">Some small description goes here</p>
                            <div class="rating-wrap">
                                <ul class="rating-stars">
                                    <li style="width:80%" class="stars-active">
                                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                    </li>
                                </ul>
                                <div class="label-rating">132 reviews</div>
                                <div class="label-rating">154 orders </div>
                            </div>
                            <!-- rating-wrap.// 
                        </figcaption>
                        <div class="bottom-wrap">
                            <a href="" class="btn btn-sm btn-primary float-right">Add To Cart</a>
                            <div class="price-wrap h5">
                                <span class="price-new">$1280</span> <del class="price-old">$1980</del>
                            </div>
                            <!-- price-wrap.// 
                        </div>
                        <!-- bottom-wrap.// 
                    </figure>
                </div>
                <!-- col // 
                <div class="col-md-4">
                    <figure class="card card-product">
                        <div class="img-wrap"><img src="images/items/2.jpg"> </div>
                        <figcaption class="info-wrap">
                            <h4 class="title">Good product</h4>
                            <p class="desc">Some small description goes here</p>
                            <div class="rating-wrap">
                                <ul class="rating-stars">
                                    <li style="width:80%" class="stars-active">
                                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                    </li>
                                </ul>
                                <div class="label-rating">132 reviews</div>
                                <div class="label-rating">154 orders </div>
                            </div>
                            <!-- rating-wrap.// 
                        </figcaption>
                        <div class="bottom-wrap">
                            <a href="" class="btn btn-sm btn-primary float-right">Add To Cart</a>
                            <div class="price-wrap h5">
                                <span class="price-new">$1280</span> <del class="price-old">$1980</del>
                            </div>
                            <!-- price-wrap.// 
                        </div>
                        <!-- bottom-wrap.//
                    </figure>
                </div>
                <!-- col // 
                <div class="col-md-4">
                    <figure class="card card-product">
                        <div class="img-wrap"><img src="images/items/3.jpg"></div>
                        <figcaption class="info-wrap">
                            <h4 class="title">Product name goes here</h4>
                            <p class="desc">Some small description goes here</p>
                            <div class="rating-wrap">
                                <ul class="rating-stars">
                                    <li style="width:80%" class="stars-active">
                                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                    </li>
                                </ul>
                                <div class="label-rating">132 reviews</div>
                                <div class="label-rating">154 orders </div>
                            </div>
                            <!-- rating-wrap.// 
                        </figcaption>
                        <div class="bottom-wrap">
                            <a href="" class="btn btn-sm btn-primary float-right">Add To Cart</a>
                            <div class="price-wrap h5">
                                <span class="price-new">$1280</span> <del class="price-old">$1980</del>
                            </div>
                            <!-- price-wrap.//
                        </div>
                        <!-- bottom-wrap.//
                    </figure>
                </div>
                <!-- col // 
            </div>
            <!-- row.// 

        </div>
        <!-- container .//  
    </section>
    <!===============================================================================->

    <!-- ========================= Subscribe ========================= 
    <section class="section-subscribe bg-primary padding-y-lg">
        <div class="container">

            <p class="pb-2 text-center white">Delivering the latest product trends and industry news straight to your inbox</p>

            <div class="row justify-content-md-center">
                <div class="col-lg-4 col-sm-6">
                    <form class="row-sm form-noborder">
                        <div class="col-8">
                            <input class="form-control" placeholder="Your Email" type="email">
                        </div>
                        <!-- col.// 
                        <div class="col-4">
                            <button type="submit" class="btn btn-block btn-warning"> <i class="fa fa-envelope"></i> Subscribe </button>
                        </div>
                        <!-- col.// 
                    </form>
                    <small class="form-text text-white-50">We’ll never share your email address with a third-party. </small>
                </div>
                <!-- col-md-6.// 
            </div>

        </div>
        <!-- container // 
    </section>
    <!-- ========================= Subscribe .END// ========================= -->

    <!-- ========================= FOOTER ========================= 
    <footer class="section-footer bg-dark white">
        <div class="container">
            <section class="footer-top padding-top">
                <div class="row">
                    <aside class="col-sm-3 col-md-3 white">
                        <h5 class="title">Customer Services</h5>
                        <ul class="list-unstyled">
                            <li> <a href="#">Help center</a></li>
                            <li> <a href="#">Money refund</a></li>
                            <li> <a href="#">Terms and Policy</a></li>
                            <li> <a href="#">Open dispute</a></li>
                        </ul>
                    </aside>
                    <aside class="col-sm-3  col-md-3 white">
                        <h5 class="title">My Account</h5>
                        <ul class="list-unstyled">
                            <li> <a href="#"> User Login </a></li>
                            <li> <a href="#"> User register </a></li>
                            <li> <a href="#"> Account Setting </a></li>
                            <li> <a href="#"> My Orders </a></li>
                            <li> <a href="#"> My Wishlist </a></li>
                        </ul>
                    </aside>
                    <aside class="col-sm-3  col-md-3 white">
                        <h5 class="title">About</h5>
                        <ul class="list-unstyled">
                            <li> <a href="#"> Our history </a></li>
                            <li> <a href="#"> How to buy </a></li>
                            <li> <a href="#"> Delivery and payment </a></li>
                            <li> <a href="#"> Advertice </a></li>
                            <li> <a href="#"> Partnership </a></li>
                        </ul>
                    </aside>
                    <aside class="col-sm-3">
                        <article class="white">
                            <h5 class="title">Contacts</h5>
                            <p>
                                <strong>Phone: </strong> +123456789
                                <br>
                                <strong>Fax:</strong> +123456789
                            </p>

                            <div class="btn-group white">
                                <a class="btn btn-facebook" title="Facebook" target="_blank" href="#"><i class="fab fa-facebook-f  fa-fw"></i></a>
                                <a class="btn btn-instagram" title="Instagram" target="_blank" href="#"><i class="fab fa-instagram  fa-fw"></i></a>
                                <a class="btn btn-youtube" title="Youtube" target="_blank" href="#"><i class="fab fa-youtube  fa-fw"></i></a>
                                <a class="btn btn-twitter" title="Twitter" target="_blank" href="#"><i class="fab fa-twitter  fa-fw"></i></a>
                            </div>
                        </article>
                    </aside>
                </div>
                <!-- row.//
                <br>
            </section>
            <section class="footer-bottom row border-top-white">
                <div class="col-sm-6">
                    <p class="text-white-50"> Made with
                        <3 <br> by Vosidiy M.</p>
                </div>
                <div class="col-sm-6">
                    <p class="text-md-right text-white-50">
                        Copyright &copy
                        <br>
                        <a href="http://bootstrap-ecommerce.com" class="text-white-50">Bootstrap-ecommerce UI kit</a>
                    </p>
                </div>
            </section>
            <!-- //footer-top
        </div>
        <!-- //container 
    </footer>
    <!-- ========================= FOOTER END // ========================= -->

</body>

</html>