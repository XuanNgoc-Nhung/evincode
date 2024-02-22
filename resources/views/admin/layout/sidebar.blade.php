<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title"><span>Hệ thống</span></li>
                <li class=" {{ Request::routeIs('admin.home')? 'active' : '' }}">
                    <a href="{{route('admin.home')}}"><i class="feather-grid"></i> <span>Tổng quan</span></a>
                </li>
                <li class=" {{ Request::routeIs('admin.listIp')? 'active' : '' }}">
                    <a href="{{route('admin.listIp')}}"><i class="feather-calendar"></i> <span>Cấu hình ip</span></a>
                </li>
                <li class=" {{ Request::routeIs('admin.products')? 'active' : '' }}">
                    <a href="{{route('admin.products')}}"><i class="feather-calendar"></i> <span>Sản phẩm</span></a>
                </li>
                <li class=" {{ Request::routeIs('admin.listUser')? 'active' : '' }}">
                    <a href="{{route('admin.listUser')}}"><i class="feather-users"></i> <span>Thành viên</span></a>
                </li>
                <li class=" {{ Request::routeIs('getHome')? 'active' : '' }}">
                    <a href="{{route('getHome')}}"><i class="feather-life-buoy"></i> <span>Xem web</span></a>
                </li>
                <li>
                    <a href="/logout" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                            class="feather-log-out me-1"></i> <span>Đăng xuất</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
