@extends('admin.layouts.main')
@section('content')
    <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
    >
        <div>
            <h3 class="fw-bold mb-3">Chỉnh sửa người dùng</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{ route('user.postUpdate', $user->id) }}"
                  enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Thông tin cần lưu</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="full_name">Họ và tên <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="full_name" name="full_name"
                                               value="{{ $user->full_name }}"
                                               placeholder="Họ và tên">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="phone_number">Số điện thoại <span class="text-danger">*</span> </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                                               value="{{ $user->phone_number }}"
                                               placeholder="Số điện thoại">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="email" name="email"
                                               value="{{ $user->email }}"
                                               placeholder="Email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="description">Mật khẩu</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password"
                                               placeholder="Mật khẩu">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email">Địa chỉ <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="address" name="address"
                                               value="{{ $user->address }}"
                                               placeholder="Địa chỉ">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="description">Ngày sinh</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                               value="{{ $user->date_of_birth }}"
                                               placeholder="Ngày sinh">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-action text-end">
                    <button class="btn btn-outline-secondary">Hủy</button>
                    <button class="btn btn-warning">Lưu</button>
                </div>
            </form>
        </div>
    </div>
@endsection
