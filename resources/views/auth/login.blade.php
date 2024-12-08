@extends('customer.layouts.main')
@section('content')
    <section class="ftco-section contact-section">
        <div class="container">
            <div class="row d-flex mb-10 contact-info justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="mb-2">Đăng nhập</h2>
                    <p>Vui lòng đăng nhập để tiếp tục sử dụng các dịch vụ của chúng tôi.</p>
                </div>
            </div>

            <div class="row block-9 justify-content-center mb-5">
                <div class="col-md-6">
                    <form action="{{ route('auth.postLogin') }}" method="post" class="bg-light p-5 contact-form">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email của bạn" name="email">
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="password" class="form-control" placeholder="Mật khẩu" id="password"
                                       name="password">
                                <span class="input-group-text ml-1">
                                    <i class="fas fa-eye toggle-password" data-target="password"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                        </div>
                        <div class="form-group text-center">
                            <a href="#" class="text-secondary">Quên mật khẩu?</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <p>
                        Bạn chưa có tài khoản?
                        <a href="{{ route('auth.showRegister') }}" class="text-primary font-weight-bold">Đăng ký ngay</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', function () {
                const target = document.getElementById(this.getAttribute('data-target'));
                if (target.type === 'password') {
                    target.type = 'text';
                    this.classList.remove('fa-eye');
                    this.classList.add('fa-eye-slash');
                } else {
                    target.type = 'password';
                    this.classList.remove('fa-eye-slash');
                    this.classList.add('fa-eye');
                }
            });
        });
    </script>
@endsection
