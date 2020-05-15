<!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span
                            class="hide-menu">Navigation</span></h3>
                </div>    
                <ul class="nav" id="side-menu">
                    <li style="padding: 70px 0 0;">
                        <a href="/administrator" class="waves-effect"><i class="fa fa-clock-o fa-fw"
                                aria-hidden="true"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="/admini/edit" class="waves-effect"><i class="fa fa-edit fa-fw"
                                aria-hidden="true"></i>Edit</a>
                    </li>
                    <li>
                        <a href="/admini/profile" class="waves-effect"><i class="fa fa-user fa-fw"
                                aria-hidden="true"></i>Profile</a>
                    </li>                    
                    <li>
                        <a class="waves-effect" 
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i  class="fa fa-sign-out fa-fw"
                                aria-hidden="true">
                            </i>{{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->