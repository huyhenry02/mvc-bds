@extends('admin.layouts.main')
@section('content')
    <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
    >
        <div>
            <h3 class="fw-bold mb-3">Thêm mới dự án</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{ route('project.postCreate') }}" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Thông tin cần lưu</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="name">Tên dự án <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" required />
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="category_id">Loại dự án <span class="text-danger">*</span></label>
                                    <select class="form-control" id="category_id" name="category_id" required>
                                        <option value="">-- Chọn loại dự án --</option>
                                        @foreach( $categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="status">Trạng thái <span class="text-danger">*</span></label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="">-- Chọn trạng thái --</option>
                                        <option value="on_sale">Đang bán</option>
                                        <option value="completed">Hoàn thành</option>
                                        <option value="upcoming">Sắp diễn ra</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="image_project">Ảnh dự án <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="image_project" name="image_project" accept="image/*" required onchange="previewImage(event, 'imagePreview')" />
                                    <img id="imagePreview" src="#" alt="Preview" class="img-fluid mt-2 d-none" style="max-height: 150px;" />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">Mô tả</label>
                                    <textarea class="form-control" id="description" name="description" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="city_id">Tỉnh/Thành phố <span class="text-danger">*</span></label>
                                    <select class="form-control" id="city_id" name="city_id" required>
                                        <option value="">-- Chọn tỉnh/thành phố --</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="district_id">Quận/Huyện <span class="text-danger">*</span></label>
                                    <select class="form-control" id="district_id" name="district_id" required>
                                        <option value="">-- Chọn quận/huyện --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="specific_address">Địa chỉ cụ thể <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="specific_address" name="specific_address" required />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="start_date">Ngày khởi công <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" required />
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="end_date">Ngày hoàn thành <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" required />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="hidden" name="investor_ids[]" id="investorIdsInput">
                                    <label for="investor_id">Nhà đầu tư <span class="text-danger">*</span></label>
                                    <div class="dropdown" style="margin-right: 5px">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="projectDropdown"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            Chọn nhà đầu tư
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="investorDropdown">
                                            <ul id="investorList" class="list-unstyled mt-2">
                                                @foreach( $investors as $investor )
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="{{ $investor->id }}"/>
                                                            <label class="form-check-label">{{ $investor->full_name ?? '' }}</label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="account_holder">Chủ tài khoản <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="account_holder" name="account_holder" required />
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="account_number">Số tài khoản <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="account_number" name="account_number" required />
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="bank">Tên ngân hàng <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="bank" name="bank" required />
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="qr_code">Mã QR <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="qr_code" name="qr_code" accept="image/*" onchange="previewImage(event, 'qrPreview')" />
                                    <img id="qrPreview" src="#" alt="QR Code Preview" class="img-fluid mt-2 d-none" style="max-height: 150px;" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-action text-end">
                    <button class="btn btn-outline-secondary">Hủy</button>
                    <button class="btn btn-warning">Thêm dự án</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('city_id').addEventListener('change', function () {
            const cityId = this.value;
            const districtSelect = document.getElementById('district_id');

            districtSelect.innerHTML = '<option value="">-- Chọn quận/huyện --</option>';

            if (cityId) {
                fetch(`/admin/project/get-districts?city_id=${cityId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(district => {
                            const option = document.createElement('option');
                            option.value = district.id;
                            option.textContent = district.name;
                            districtSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching districts:', error));
            }
        });
        document.addEventListener('DOMContentLoaded', function () {
            const investorList = document.querySelectorAll('#investorList .form-check-input');
            const investorIdsInput = document.getElementById('investorIdsInput');

            investorList.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    updateInvestorIds();
                });
            });

            function updateInvestorIds() {
                console.log(investorList);
                const selectedIds = Array.from(investorList)
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.value);
                investorIdsInput.value = selectedIds.join(',');
            }
        });
        function previewImage(event, previewId) {
            const file = event.target.files[0];
            const preview = document.getElementById(previewId);
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
