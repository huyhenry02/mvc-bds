<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="">HLC</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="{{ route('customer.showIndex') }}" class="nav-link">Trang chủ</a></li>
                <li class="nav-item"><a href="{{ route('customer.showAbout') }}" class="nav-link">Về chúng tôi</a></li>
                <li class="nav-item"><a href="{{ route('customer.showProjects') }}" class="nav-link">Dự án</a></li>
                <li class="nav-item"><a href="{{ route('customer.showService') }}" class="nav-link">Chính sách</a></li>
            </ul>
            <div class="ml-auto">
                <a href="{{ route('auth.showLogin') }}" class="btn btn-warning">Đăng nhập</a>
                <a href="{{ route('auth.showRegister') }}" class="btn btn-secondary">Đăng ký</a>
            </div>
        </div>
    </div>
</nav>
