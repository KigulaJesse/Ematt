
<section>
    <style>
    #container {
        width: 100px;
        height: 100px;
        position: relative;
      }
      #navi,
      #infoi {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
      }
      #infoi {
        z-index: 10;
      }
    </style>
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
                                <a class="nav-link text-white add-button" href="/cart" title="cart"><i class="fa fa-shopping-cart"></i></a>
                            </li>
                        </ul>
                        @endguest
					</div>
				</nav>
			</div>
		</div>
	</div>
</section>
