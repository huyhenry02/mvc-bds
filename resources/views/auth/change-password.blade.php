@extends('customer.layouts.main')
@section('content')
    <section class="ftco-section contact-section">
        <div class="container">
            <div class="row d-flex mb-10 contact-info justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="mb-2">Đổi mật khẩu</h2>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>Vui lòng nhập các thông tin để đổi mật khẩu.</p>
                </div>
            </div>

            <div class="row block-9 justify-content-center mb-5">
                <div class="col-md-6">
                    <form action="{{ route('auth.postChangePassword') }}" method="post"
                          class="bg-light p-5 contact-form">
                        @csrf
                        <div class="form-group">
                            <label for="old_password">Mật khẩu cũ</label>
                            <input type="password" class="form-control" placeholder="Mật khẩu cũ" id="old_password"
                                   name="old_password">
                            @error('old_password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_password">Mật khẩu mới</label>
                            <div class="input-group">
                                <input type="password" class="form-control" placeholder="Mật khẩu mới" id="new_password"
                                       name="new_password">
                                <span class="input-group-text ml-1">
                                    <i class="fas fa-eye toggle-password" data-target="new_password"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Xác nhận mật khẩu mới</label>
                            <div class="input-group">
                                <input type="password" class="form-control" placeholder="Xác nhận mật khẩu mới"
                                       id="confirm_password" name="confirm_password">
                                <span class="input-group-text ml-1">
                                    <i class="fas fa-eye toggle-password" data-target="confirm_password"></i>
                                </span>
                            </div>
                            @error('confirm_password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary w-100">Đổi mật khẩu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <style>
        .input-group-text {
            cursor: pointer;
        }
    </style>
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
