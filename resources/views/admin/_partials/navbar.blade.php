<header class="main-header">
    <a href="{{ route('admin.dashboard') }}" class="logo">
        <span class="logo-mini"><i class="ion ion-cube"></i></span>
        <span class="logo-lg"><i class="ion ion-cube"></i> <b>B</b>OT</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ url('assets/img/photo.jpg') }}" class="user-image" alt="User Image"/>
                        <span class="hidden-xs">
                            {{ Auth::user()->full_name }}
                        </span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ url('assets/img/photo.jpg') }}" class="img-circle" alt="User Image"/>
                            <p>
                                {{ Auth::user()->full_name }}
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left"></div>
                            <div class="pull-right">
                                <a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat">
                                    Sign out
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
