<header class="sticky-top">
    <nav class="navbar shadow-sm navbar-expand-md">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('getHome')}}">
                <img class="logo-main" src="https://tuanxinh.com/upload/setting/72df830590d60444eadf451c7fa384c6.png"
                     width="150" alt="">
            </a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-md-0 me-auto c-font-upper dropHeadHover">
                    <li class="nav-item text-upper">
                        <a class="nav-link fw-bold text-blue-black" href="{{route('getHome')}}">Trang chủ</a>
                    </li>
                    <li class="nav-item dropdown text-upper"><a
                            class="nav-link dropdown-toggle fw-bold text-blue-black" href="#" id="locdz_7"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">Nạp Tiền</a>
                        <div class="dropdown-menu" aria-labelledby="locdz_7">
                            <a class="dropdown-item " href="{{route('getHome')}}"> Nạp atm</a>
                            <a class="dropdown-item " href="{{route('getHome')}}"> Nạp Momo</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown text-upper"><a
                            class="nav-link dropdown-toggle fw-bold text-blue-black" href="#" id="locdz_7"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">Liên Hệ</a>
                        <div class="dropdown-menu" aria-labelledby="locdz_7">
                            <a class="dropdown-item " href="https://www.facebook.com/DuyhungBCX/">Facebook AD</a>
                            <a class="dropdown-item " href="https://t.me/Duyhungbcx">Telegram</a>
                        </div>
                    </li>
                </ul>

                <div id="func-control">
                    @guest
                        <ul class="c-account c-mr-4 d-flex justify-content-evenly">
                            <li class="column"><a href="{{ route('login') }}"
                                                  class="btn btn-success w-100"> Đăng
                                    Nhập </a></li>
                            <li class="column"><a href="{{ route('register') }}"
                                                  class="btn btn-danger w-100"> Đăng Kí
                                </a></li>
                        </ul>
                    @else
                        <ul class="c-account c-mr-4 d-flex justify-content-evenly">
                            <div class="dropdown nav-profile">
                                <li class="column dropNotis">
                                    <div class="dropdown">
                                        <div class="avatar avatar-online">
                                            <img src="https://ui-avatars.com/api/?background=random&amp;name=Xuanngoc"
                                                 alt="" class="w-px-40 h-auto rounded-circle">
                                        </div>
                                        <ul class="dropdown-menu dropdown-menu-right dropdown-menu-end"
                                            aria-labelledby="dropUser">
                                            <a class="dropdown-item">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar avatar-online">
                                                            <img
                                                                src="https://ui-avatars.com/api/?background=random&amp;name=Xuanngoc"
                                                                alt="" class="w-px-40 h-auto rounded-circle">
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <span class="fw-semibold d-block">Xuanngoc</span>
                                                        <small class="text-muted">Số dư: <b
                                                                class="text-danger">0</b></small>
                                                    </div>
                                                </div>
                                            </a>

                                            <div class="dropdown-divider"></div>
                                            @if(auth()->user()&&auth()->user()->role==1)
                                                <li><a class="dropdown-item"  href="{{route('admin.home')}}">Trang quản lý</a>
                                                </li>
                                            @endif

                                            <li><a class="dropdown-item" disabled href="#">Quản Lí Key</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                    Đăng xuất
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                      style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </div>
                        </ul>
                    @endguest
                </div>
            </div>
        </div>
    </nav>
</header>
