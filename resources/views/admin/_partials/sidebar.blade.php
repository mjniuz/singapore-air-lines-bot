<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image" style="height:75px;">
                <img src="{{url('assets/img/photo.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{!! Auth::getUser()->fullname; !!}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ (Request::is('*/dashboard*')) ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class='fa fa-home'></i> 
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ (Request::is('*/slider*')) ? 'active' : '' }}">
                <a href="{{ route('admin.sliders') }}">
                    <i class='glyphicon glyphicon-book'></i> 
                    <span>Slider</span>
                </a>
            </li>
            <li class="{{ (Request::is('*/broadcast*')) ? 'active' : '' }}">
                <a href="{{ route('admin.broadcast') }}">
                    <i class='glyphicon glyphicon-bullhorn'></i> 
                    <span>Broadcast</span>
                </a>
            </li>
            <li class="{{ (Request::is('*/menu*')) ? 'active' : '' }}">
                <a href="{{ route('admin.menu') }}">
                    <i class='glyphicon glyphicon-list'></i> 
                    <span>Menu</span>
                </a>
            </li>
            <li class="{{ (Request::is('*/attribution*')) ? 'active' : '' }}">
                <a href="{{ route('admin.attribution') }}">
                    <i class='glyphicon glyphicon-asterisk'></i> 
                    <span>Install Attribution</span>
                </a>
            </li>
            <li class="treeview {{ (Request::is('*/reward*')) ? 'active' : '' }}">
                <a href="#">
                    <i class="glyphicon glyphicon-star"></i>
                    <span>Rewards</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (Request::is('*/reward*')) ? 'active' : '' }}">
                        <a href="{{ route('admin.rewards') }}"><i class="fa fa-circle-o"></i> <span> Rewards</span></a>
                    </li>
                    <li class="{{ (Request::is('*/reward_categor*')) ? 'active' : '' }}">
                        <a href="{{ route('admin.reward_categories') }}"><i class="fa fa-circle-o"></i> <span> Category Rewards</span></a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="glyphicon glyphicon-inbox"></i>
                    <span>Store App</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ (Request::is('*/order*')) ? 'active' : '' }}">
                        <a href="{{ route('admin.orders') }}"><i class="fa fa-circle-o"></i> <span> Orders</span></a>
                    </li>
                </ul>
                <ul class="treeview-menu">
                    <li class="{{ (Request::is('*/store*')) ? 'active' : '' }}">
                        <a href="{{ route('admin.stores') }}"><i class="fa fa-circle-o"></i> <span> Stores</span></a>
                    </li>
                </ul>
                <ul class="treeview-menu">
                    <li class="{{ (Request::is('*/user*')) ? 'active' : '' }}">
                        <a href="{{ route('admin.user') }}"><i class="fa fa-circle-o"></i> <span> Users</span></a>
                    </li>
                </ul>
                <ul class="treeview-menu">
                    <li class="{{ (Request::is('*/simulator*')) ? 'active' : '' }}">
                        <a href="{{ route('simulator.order') }}"><i class="fa fa-circle-o"></i> <span> Simulate Order</span></a>
                    </li>
                </ul>
            <li class="{{ (Request::is('*/settings*')) ? 'active' : '' }}">
                <a href="{{ route('admin.settings') }}">
                    <i class='glyphicon glyphicon-envelope'></i> 
                    <span>SMS Campaign</span>
                </a>
            </li>
            <li class="{{ (Request::is('*/vouchers*')) ? 'active' : '' }}">
                <a href="{{ route('admin.vouchers') }}">
                    <i class='glyphicon glyphicon-credit-card'></i> 
                    <span>Vouchers</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.auth.logout') }}">
                    <i class="glyphicon glyphicon-share"></i> <span> LogOut</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
