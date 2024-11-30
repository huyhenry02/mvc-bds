@extends('admin.layouts.main')
@section('content')
    <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
    >
        <div>
            <h3 class="fw-bold mb-3">Chỉnh sửa khu đất</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{ route('plot.postUpdate', $plot->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Thông tin cần lưu</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="project_id">Dự án <span class="text-danger">*</span></label>
                                    <select class="form-control" id="project_id" name="project_id" required>
                                        <option value="">-- Chọn dự án --</option>
                                        @foreach($projects as $project)
                                            <option value="{{ $project->id }}"
                                                {{ $plot->zone->project_id == $project->id ? 'selected' : '' }}>
                                                {{ $project->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="zone_id">Phân khu <span class="text-danger">*</span></label>
                                    <select class="form-control" id="zone_id" name="zone_id" required>
                                        <option value="">-- Chọn phân khu --</option>
                                        @foreach($zones as $zone)
                                            <option value="{{ $zone->id }}"
                                                {{ $plot->zone_id == $zone->id ? 'selected' : '' }}>
                                                {{ $zone->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="name">Tên khu đất <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ $plot->name }}" required/>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="status">Trạng thái <span class="text-danger">*</span></label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="empty" {{ $plot->status === 'empty' ? 'selected' : '' }}>Trống
                                        </option>
                                        <option value="deposited" {{ $plot->status === 'deposited' ? 'selected' : '' }}>
                                            Đã đặt cọc
                                        </option>
                                        <option value="sold" {{ $plot->status === 'sold' ? 'selected' : '' }}>Đã bán
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="price">Giá <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="price" name="price"
                                           value="{{ $plot->price }}" required/>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="deposit">Tiền cọc <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="deposit" name="deposit"
                                           value="{{ $plot->deposit }}" required/>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="size">Diện tích (m²) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="size" name="size"
                                           value="{{ $plot->size }}" step="0.01" required/>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="specific_address">Địa chỉ cụ thể <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="specific_address"
                                           name="specific_address" value="{{ $plot->specific_address }}" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">Mô tả</label>
                                    <textarea class="form-control" id="description" name="description"
                                              rows="5">{{ $plot->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="main_image">Ảnh bìa <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="main_image" name="main_image"
                                           accept="image/*"
                                           onchange="previewImage(event, 'main_image_preview')"/>
                                    <img id="main_image_preview" src="{{ $plot->main_image ?? '#' }}"
                                         alt="Preview"
                                         class="img-fluid mt-2 {{ $plot->main_image ? '' : 'd-none' }}"
                                    />
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="form-group">
                                    <label for="content">Hình ảnh phụ</label>
                                    <div class="row">
                                        <div class="col-3">
                                            <input type="file" class="form-control" name="sub_image_1"
                                                   accept="image/*"
                                                   onchange="previewImage(event, 'sub_image_1_preview')"/>
                                            <img id="sub_image_1_preview" src="{{ $plot->sub_image_1 ?? '#' }}"
                                                 alt="Preview"
                                                 class="img-fluid mt-2 {{ $plot->sub_image_1 ? '' : 'd-none' }}"
                                            />
                                        </div>
                                        <div class="col-3">
                                            <input type="file" class="form-control" name="sub_image_2"
                                                   accept="image/*"
                                                   onchange="previewImage(event, 'sub_image_2_preview')"/>
                                            <img id="sub_image_2_preview" src="{{ $plot->sub_image_2 ?? '#' }}"
                                                 alt="Preview"
                                                 class="img-fluid mt-2 {{ $plot->sub_image_2 ? '' : 'd-none' }}"
                                            />
                                        </div>
                                        <div class="col-3">
                                            <input type="file" class="form-control" name="sub_image_3"
                                                   accept="image/*"
                                                   onchange="previewImage(event, 'sub_image_3_preview')"/>
                                            <img id="sub_image_3_preview" src="{{ $plot->sub_image_3 ?? '#' }}"
                                                 alt="Preview"
                                                 class="img-fluid mt-2 {{ $plot->sub_image_3 ? '' : 'd-none' }}"
                                            />
                                        </div>
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
    <script>
        document.getElementById('project_id').addEventListener('change', function () {
            const projectId = this.value;
            const zoneSelect = document.getElementById('zone_id');

            zoneSelect.innerHTML = '<option value="">-- Chọn phân khu --</option>';

            if (projectId) {
                fetch(`/admin/plot/get-zones-of-project?project_id=${projectId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(zone => {
                            const option = document.createElement('option');
                            option.value = zone.id;
                            option.textContent = zone.name;
                            zoneSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching districts:', error));
            }
        });

        function previewImage(event, previewId) {
            const file = event.target.files[0];
            const preview = document.getElementById(previewId);
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
