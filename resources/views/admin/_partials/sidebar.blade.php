<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image" style="height:75px;">
                <img src="{{ url('assets/img/photo.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{!! Auth::getUser()->full_name; !!}</p>
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
        </ul>
    </section>
</aside>