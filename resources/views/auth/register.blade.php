@extends('customer.layouts.main')
@section('content')
    <section class="ftco-section contact-section">
        <div class="container">
            <div class="row d-flex mb-10 contact-info justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="mb-2">Đăng ký</h2>
                    <p>Vui lòng đăng ký để tiếp tục sử dụng các dịch vụ của chúng tôi.</p>
                </div>
            </div>

            <div class="row block-9 justify-content-center mb-5">
                <div class="col-md-6">
                    <form action="{{ route('auth.postRegister') }}" method="POST" class="bg-light p-5 contact-form">
                        @csrf

                        <div class="form-group">
                            <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" placeholder="Họ và tên" value="{{ old('full_name') }}">
                            @error('full_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email của bạn" value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mật khẩu">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Xác nhận mật khẩu">
                        </div>

                        <div class="form-group">
                            <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Số điện thoại" value="{{ old('phone_number') }}">
                            @error('phone_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Địa chỉ" value="{{ old('address') }}">
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth') }}">
                            @error('date_of_birth')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group text-center">
                            <input type="submit" value="Đăng ký" class="btn btn-primary w-100">
                        </div>
                    </form>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <p>
                        Bạn đã có tài khoản?
                        <a href="{{ route('auth.showLogin') }}" class="text-primary font-weight-bold">Đăng nhập ngay</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
