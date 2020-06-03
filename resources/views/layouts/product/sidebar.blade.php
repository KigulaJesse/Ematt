<div class="sidebar">
    <!-- User Widget -->
    <!--<div class="widget user-dashboard-profile">
        <!-- User Image 
        <div class="profile-thumb">
            <img src="images/user/user-thumb.jpg" alt="" class="rounded-circle">
        </div>
        <!-- User Name 
        @auth
            <h5 class="text-center">{{ Auth::user()->name }}</h5>
            @else
            {{ route('/') }}
        @endauth
        <p>Joined February 06, 2017</p>
        <a href="/update" class="btn btn-main-sm">Edit Profile</a>
    </div>
    <!-- Dashboard Links -->
    <div class="widget user-dashboard-menu">
        <ul>
            <li><h2 style ="position:relative; text-align:center;">{{ Auth::user()->name }} Manage products</h2></li>
            <li class="{{Request::is('products') ? 'nav-item active' : ''}}"><a href="/products"><i class="fa fa-user"></i> My products</a></li>
            <li class="{{Request::is('orders') ? 'nav-item active' : ''}}"  ><a href="/orders"><i class="fa fa-bookmark-o"></i>Pending orders<span>0</span></a></li>
            <li class="{{Request::is('ordered') ? 'nav-item active' : ''}}"><a href="/ordered"><i class="fa fa-file-archive-o"></i>Ordered history<span>0</span></a></li>
           <!-- <li><a href="dashboard-pending-ads.html"><i class="fa fa-bolt"></i> Pending Approval<span>23</span></a></li>-->
            <li><a href="{{route('logout')}}" href="{{ route('logout') }}"onclick="event.preventDefault();
            document.getElementById('logout-form-product-index').submit();"><i class="fa fa-cog"></i>{{ __('Logout') }}</a></li>
            <form id="logout-form-product-index" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <!--<li><a href="" data-toggle="modal" data-target="#deleteaccount"><i class="fa fa-power-off"></i>Delete
                Account</a></li>-->
        </ul>
    </div>
    
    <!-- delete-account modal -->
        <!-- delete account popup modal start-->
            <!-- Modal -->
            <div class="modal fade" id="deleteaccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-bottom-0">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <img src="images/account/Account1.png" class="img-fluid mb-2" alt="">
                            <h6 class="py-2">Are you sure you want to delete your account?</h6>
                            <p>Do you really want to delete these records? This process cannot be undone.</p>
                            <textarea name="message" id="" cols="40" rows="4" class="w-100 rounded"></textarea>
                        </div>
                        <div class="modal-footer border-top-0 mb-3 mx-5 justify-content-lg-between justify-content-center">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        <!-- delete account popup modal end-->
    <!-- delete-account modal -->
</div>