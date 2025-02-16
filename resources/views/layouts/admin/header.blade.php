    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                   <!-- <a class="logo" href="/administrator">
                        <!-- Logo icon image, you can use font-icon also -->
                        <b>
                            <!--This is dark logo icon
                            <img src="/plugins/images/admin-logo.png" alt="home" class="dark-logo" />
                            <!--This is light logo icon
                            <img src="/plugins/images/admin-logo-dark.png" alt="home" class="light-logo" />
                        </b>
                        <!-- Logo text image you can use text also 
                        <span class="hidden-xs">
                            <!--This is dark logo text
                            <img src="/plugins/images/admin-text.png" alt="home" class="dark-logo" />
                            <!--This is light logo text
                            <img src="/plugins/images/admin-text-dark.png" alt="home" class="light-logo" />
                        </span> 
                    </a>-->
                </div>
                <!-- /Logo -->
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <a class="nav-toggler open-close waves-effect waves-light hidden-md hidden-lg" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
                    </li>
                    <li>
                        <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                            <input type="text" placeholder="Search..." class="form-control"> 
                            <a href="">
                                <i class="fa fa-search"></i>
                            </a> 
                        </form>
                    </li>
                    <li>
                        <a class="profile-pic" href="/admini/profile"><img src="/plugins/images/users/varun.jpg" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">{{Auth::user()->name}}</b></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->