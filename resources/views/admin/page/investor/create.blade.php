@extends('admin.layouts.main')
@section('content')
    <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
    >
        <div>
            <h3 class="fw-bold mb-3">Thêm mới nhà đầu tư</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Thông tin cần lưu</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="full_name">Họ và tên <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="full_name" name="full_name"
                                               placeholder="Họ và tên">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="phone_number">Số điện thoại <span class="text-danger">*</span> </label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                                               placeholder="Số điện thoại">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="email" name="email"
                                               placeholder="Email">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="content">Mô tả</label>
                                    <div class="input-group">
                                        <textarea class="form-control" id="content" rows="5" name="content"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-action text-end">
                    <button class="btn btn-outline-secondary">Hủy</button>
                    <button class="btn btn-warning">Thêm chủ đầu tư</button>
                </div>
            </form>
        </div>
    </div>
@endsection
