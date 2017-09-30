<header class="main-header">
    <a href="{{ route('admin.dashboard') }}" class="logo">
        <span class="logo-mini"><i class="ion ion-cube"></i></span>
        <span class="logo-lg"><i class="ion ion-cube"></i> <b>W</b>atsons</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav" style="padding-right:20px;">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('assets/img/photo.jpg') }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{!! Auth::getUser()->fullname; !!}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="{{ asset('assets/img/photo.png') }}" class="img-circle" alt="User Image">
                            <p>
                                Admin Content Management System Watsons
                                <small></small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat"><i class="ion ion-person"></i> Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('admin.auth.logout') }}" class="btn btn-default btn-flat"><i class="ion ion-power"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
