@extends('admin.layouts.main')
@section('content')
    <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
    >
        <div>
            <h3 class="fw-bold mb-3">Thêm mới khu đất</h3>
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
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="title">Dự án <span class="text-danger">*</span></label>
                                    <select class="form-control" id="project_id" name="project_id" required>
                                        <option value="">-- Chọn dự án --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="title">Phân khu <span class="text-danger">*</span></label>
                                    <select class="form-control" id="zone_id" name="zone_id" required>
                                        <option value="">-- Chọn phân khu --</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="title">Tên khu đất <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" required/>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="title">Trạng thái <span class="text-danger">*</span></label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="empty">Trống</option>
                                        <option value="deposited">Đã đặt cọc</option>
                                        <option value="sold">Đã bán</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="title">Giá <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="price" name="price" required/>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="title">Tiền cọc <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="deposit" name="deposit" required/>
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="title">Diện tích( mét vuông) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="size" name="size" step="0.01"
                                           required/>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="title">Địa chỉ cụ thể <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="specific_address"
                                           name="specific_address" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="content">Mô tả</label>
                                    <div class="input-group">
                                        <textarea class="form-control" id="description" name="description"
                                                  rows="5"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="content">Ảnh bìa<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="main_image" name="main_image"
                                           accept="image/*" required/>
                                    <div id="main_image_preview" class="mt-2"></div>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <label for="content">Hình ảnh</label>
                                    <div class="row">
                                        <div class="col-4">
                                            <input type="file" class="form-control" id="sub_image_1" name="sub_image_1"
                                                   accept="image/*"/>
                                            <div id="sub_image_preview_1" class="mt-2"></div>
                                        </div>
                                        <div class="col-4">
                                            <input type="file" class="form-control" id="sub_image_2" name="sub_image_2"
                                                   accept="image/*"/>
                                            <div id="sub_image_preview_2" class="mt-2"></div>
                                        </div>
                                        <div class="col-4">
                                            <input type="file" class="form-control" id="sub_image_3" name="sub_image_3"
                                                   accept="image/*"/>
                                            <div id="sub_image_preview_3" class="mt-2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-action text-end">
                    <button class="btn btn-outline-secondary">Hủy</button>
                    <button class="btn btn-warning">Thêm khu đất</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function previewImage(input, previewId) {
            const previewContainer = document.getElementById(previewId);
            previewContainer.innerHTML = ''; // Xóa preview cũ
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '100%';
                    img.style.maxHeight = '150px';
                    img.className = 'img-thumbnail';
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        document.getElementById('main_image').addEventListener('change', function () {
            previewImage(this, 'main_image_preview');
        });

        @for ($i = 1; $i <= 4; $i++)
        document.getElementById('sub_image_{{ $i }}').addEventListener('change', function () {
            previewImage(this, 'sub_image_preview_{{ $i }}');
        });
        @endfor
    </script>
@endsection
