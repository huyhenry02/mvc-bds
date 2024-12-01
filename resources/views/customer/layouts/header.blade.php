<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="">HLC</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->routeIs('customer.showIndex') ? 'active' : '' }}"><a href="{{ route('customer.showIndex') }}" class="nav-link">Trang chủ</a></li>
                <li class="nav-item {{ request()->routeIs('customer.showAbout') ? 'active' : '' }}"><a href="{{ route('customer.showAbout') }}" class="nav-link">Về chúng tôi</a></li>
                <li class="nav-item {{ request()->routeIs('customer.showProjects') ? 'active' : '' }}"><a href="{{ route('customer.showProjects') }}" class="nav-link">Dự án</a></li>
                <li class="nav-item {{ request()->routeIs('customer.showService') ? 'active' : '' }}"><a href="{{ route('customer.showService') }}" class="nav-link">Dịch vụ</a></li>
            </ul>
            <div class="ml-auto">
                @if(auth()->user())
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: black;">
                            <i class="fa fa-user mr-2" style="color: black;"></i>
                            <span class="nav-link">{{ auth()->user()->full_name ?? '' }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">Giao dịch của bạn</a>
                            <a class="dropdown-item" href="{{ route('auth.logout') }}">Đăng xuất</a>
                        </div>
                    </div>
                @else
                    <a href="{{ route('auth.showLogin') }}" class="btn btn-primary">Đăng nhập</a>
                    <a href="{{ route('auth.showRegister') }}" class="btn btn-secondary">Đăng ký</a>
                @endif
            </div>
        </div>
    </div>
</nav>
