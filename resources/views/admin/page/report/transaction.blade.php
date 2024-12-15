@extends('admin.layouts.main')
@section('content')
    <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2">
        <div>
            <h3 class="fw-bold mb-3">Báo cáo giao dịch đặt cọc</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-6 d-flex">
            <div class="dropdown" style="margin-right: 5px">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="projectDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    Chọn dự án
                </button>
                <div class="dropdown-menu" aria-labelledby="projectDropdown"
                     style="width: 300px; max-height: 200px; overflow-y: auto;">
                    <ul id="projectList" class="list-unstyled mt-2">
                        @foreach($projects as $project)
                            <li>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $project->id }}"/>
                                    <label class="form-check-label">{{ $project->name }}</label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <input
                type="date"
                placeholder="Từ ngày"
                class="form-control"
                id="start_date"
            />
            <input
                type="date"
                placeholder="Đến ngày"
                class="form-control"
                id="end_date"
            />
            <select class="form-control" id="search_status" name="status">
                <option value="">-- Chọn Tình trạng --</option>
                <option value="pending">Chờ xác nhận</option>
                <option value="success">Giao dịch thành công</option>
                <option value="reject">Giao dịch thất bại</option>

            </select>
            <button class="btn btn-info ms-2"><i class="fas fa-search"></i></button>
        </div>
        <div class="col-3">
        </div>
        <div class="col-3 d-flex ms-auto justify-content-end">
            <a id="previewBtn" class="btn btn-outline-secondary me-2" href="#">
                <i class="fas fa-eye me-2"></i>Xem file tải xuống
            </a>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card card-stats card-round">
                <table class="table table-bordered" id="transaction-table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Dự án</th>
                        <th scope="col">Mã phân khu</th>
                        <th scope="col">Phân khu</th>
                        <th scope="col">Tên khu đất</th>
                        <th scope="col">Thời gian giao dịch</th>
                        <th scope="col" class="text-center">Số tiền đặt cọc</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="6" class="text-center">Không có dữ liệu</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.btn-info').on('click', function (e) {
                e.preventDefault();

                const selectedProjects = [];
                $('#projectList .form-check-input:checked').each(function () {
                    selectedProjects.push($(this).val());
                });

                const startDate = $('input[type="date"]').eq(0).val();
                if (!startDate) {
                    alert('Vui lòng chọn ngày bắt đầu');
                    return;
                }
                const endDate = $('input[type="date"]').eq(1).val();
                if (!endDate) {
                    alert('Vui lòng chọn ngày kết thúc');
                    return;
                }

                const status = $('#search_status').val();

                $.ajax({
                    url: '{{ route('report.showDataTransaction') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        projects: selectedProjects,
                        start_date: startDate,
                        end_date: endDate,
                        status: status
                    },
                    success: function (response) {
                        let rows = '';
                        let lastProject = null;
                        let lastZone = null;

                        for (let projectName in response) {
                            const zones = response[projectName];
                            let projectRowSpan = 0;
                            let totalDeposit = 0;

                            for (let zoneCode in zones) {
                                projectRowSpan += zones[zoneCode].length;
                                zones[zoneCode].forEach((transaction) => {
                                    totalDeposit += transaction.deposit;
                                });
                            }

                            for (let zoneCode in zones) {
                                const zone = zones[zoneCode];
                                let zoneRowSpan = zone.length;

                                zone.forEach((transaction) => {
                                    if (transaction.project_name !== lastProject) {
                                        rows += `
                                        <tr>
                                            <td rowspan="${projectRowSpan}">${transaction.project_name}</td>
                                            <td rowspan="${zoneRowSpan}">${zoneCode}</td>
                                            <td rowspan="${zoneRowSpan}">${transaction.zone_name}</td>
                                            <td>${transaction.plot_name}</td>
                                            <td>${transaction.transaction_date}</td>
                                            <td  class="text-center">${transaction.deposit.toLocaleString()}</td>
                                        </tr>
                                    `;
                                        lastProject = transaction.project_name;
                                        lastZone = zoneCode;
                                    } else if (zoneCode !== lastZone) {
                                        rows += `
                                        <tr>
                                            <td rowspan="${zoneRowSpan}">${zoneCode}</td>
                                            <td rowspan="${zoneRowSpan}">${transaction.zone_name}</td>
                                            <td>${transaction.plot_name}</td>
                                            <td>${transaction.transaction_date}</td>
                                            <td  class="text-center">${transaction.deposit.toLocaleString()}</td>
                                        </tr>
                                    `;
                                        lastZone = zoneCode;
                                    } else {
                                        rows += `
                                        <tr>
                                            <td>${transaction.plot_name}</td>
                                            <td>${transaction.transaction_date}</td>
                                            <td  class="text-center">${transaction.deposit.toLocaleString()}</td>
                                        </tr>
                                    `;
                                    }
                                });
                            }

                            rows += `
                            <tr class="fw-bold text-end">
                                <td colspan="5" class="text-center">Tổng tiền:</td>
                                <td class="text-center">${totalDeposit.toLocaleString()}</td>
                            </tr>
                        `;
                        }

                        if (rows === '') {
                            rows = `<tr><td colspan="6" class="text-center">Không có dữ liệu</td></tr>`;
                        }

                        $('#transaction-table tbody').html(rows);
                    },
                    error: function () {
                        alert('Đã có lỗi xảy ra. Vui lòng thử lại.');
                    },
                });
            });
        });
        $(document).ready(function () {
            $('#previewBtn').on('click', function (e) {
                e.preventDefault();
                const selectedProjects = [];
                $('#projectList .form-check-input:checked').each(function () {
                    selectedProjects.push($(this).val());
                });

                console.log(111);
                const startDate = $('#start_date').val();
                if (!startDate) {
                    alert('Vui lòng chọn ngày bắt đầu');
                    return;
                }
                const endDate = $('#end_date').val();
                if (!endDate) {
                    alert('Vui lòng chọn ngày kết thúc');
                    return;
                }
                const status = $('#search_status').val();
                const queryParams = new URLSearchParams({
                    start_date: startDate,
                    end_date: endDate,
                    projects: selectedProjects.join(','),
                    status: status
                });
                window.location.href = `{{ route('report.showPreviewExport') }}?${queryParams.toString()}`;
            });
        });
    </script>
@endsection
