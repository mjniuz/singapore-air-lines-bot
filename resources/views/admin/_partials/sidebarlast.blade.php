<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image" style="height:75px;">
                <img src="{{url('assets/img/photo.png')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{!! Auth::getUser()->fullname; !!}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class='fa fa-home'></i> 
                    <span>Dashboard</span>
                </a>
            </li>
            <li><a href="{{ route('admin.lookbook') }}"><i class="fa fa-book"></i> <span> Lookbook</span></a></li>
            <li><a href="{{ route('admin.activated') }}"><i class='fa fa-users'></i> <span>Custumers Activity</span></a></li> 
            <li><a href="{{ route('admin.sliders') }}"><i class='glyphicon glyphicon-book'></i> <span>Slider</span></a></li>
            <li><a href="{{ route('admin.menu') }}"><i class='glyphicon glyphicon-list'></i> <span>Menu</span></a></li>
            <li class="treeview">
                <a href="#">
                    <i class="glyphicon glyphicon-star"></i>
                    <span>Rewards</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('admin.rewards') }}"><i class="fa fa-circle-o"></i> <span> Rewards</span></a>
                    </li>
                    <li>
                        <a href="{{ route('admin.reward_categories') }}"><i class="fa fa-circle-o"></i> <span> Category Rewards</span></a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Masters Data</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.member') }}"><i class="fa fa-circle-o"></i> Member</a></li>
                    <li><a href="{{ route('admin.orders') }}"><i class="fa fa-circle-o"></i> Orders</a></li>
                    <li><a href="{{ route('admin.products') }}"><i class="fa fa-circle-o"></i> Products</a></li>
                    <li><a href="{{ route('admin.stores') }}"><i class="fa fa-circle-o"></i> Stores</a></li>
                    <li><a href="{{ route('admin.user') }}"><i class="fa fa-circle-o"></i> Stores Users</a></li>
                </ul>
            </li>
            <li><a href=""><i class='fa fa-gear'></i> <span>Configurations</span></a></li> 
            <li>
                <a href="{{ route('admin.auth.logout') }}">
                    <i class="glyphicon glyphicon-share"></i> <span> LogOut</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
