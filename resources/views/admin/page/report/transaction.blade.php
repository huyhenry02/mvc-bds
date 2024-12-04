@extends('admin.layouts.main')
@section('content')
    <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2">
        <div>
            <h3 class="fw-bold mb-3">Báo cáo giao dịch</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-6 d-flex">
            <input
                type="date"
                placeholder="Từ ngày"
                class="form-control"
            />
            <input
                type="date"
                placeholder="Đến ngày"
                class="form-control"
            />
            <select class="form-control" id="project_id" name="project_id">
                <option value="">-- Chọn dự án --</option>
            </select>
            <button class="btn btn-info ms-2"><i class="fas fa-search"></i></button>
        </div>
        <div class="col-3">
        </div>
        <div class="col-3 d-flex ms-auto justify-content-end">
            <a class="btn btn-outline-secondary me-2" href="{{ route('report.showPreviewExport') }}"><i class="fas fa-eye me-2"></i>Xem Trước</a>
            <button class="btn btn-info"><i class="fas fa-download me-2"></i>Xuất báo cáo</button>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card card-stats card-round">
                <table class="table table-bordered" id="user-table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">Dự án</th>
                        <th scope="col" width="10%" class="text-center">Phân khu</th>
                        <th scope="col" width="10%" class="text-center">Mã khu đất</th>
                        <th scope="col">Tên khu đất</th>
                        <th scope="col" width="15%" class="text-center">Thời gian giao dịch</th>
                        <th scope="col" width="12%" class="text-center">Số tiền đặt cọc</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td rowspan="4">Project 1</td>
                        <td rowspan="3">Phân khu 1</td>
                        <td>PK1-01</td>
                        <td>Biệt thự</td>
                        <td>2021-10-10 10:00:00</td>
                        <td>1,000,000,000</td>
                    </tr>
                    <tr>
                        <td >PK1-01</td>
                        <td>Biệt thự</td>
                        <td>2021-10-10 10:00:00</td>
                        <td>1,000,000,000</td>
                    </tr>
                    <tr>
                        <td>PK1-01</td>
                        <td>Biệt thự</td>
                        <td>2021-10-10 10:00:00</td>
                        <td>1,000,000,000</td>
                    </tr>
                    <tr>
                        <td>Phân khu 2</td>
                        <td>PK1-01</td>
                        <td>Biệt thự</td>
                        <td>2021-10-10 10:00:00</td>
                        <td>1,000,000,000</td>
                    </tr>
                    <tr style="background-color: grey">
                        <td colspan="5" class="text-center">Tổng tiền</td>
                        <td>4,000,000,000</td>
                    </tr>
                    <tr>
                        <td rowspan="4">Project 2</td>
                        <td rowspan="3">Phân khu 1</td>
                        <td>PK1-01</td>
                        <td>Biệt thự</td>
                        <td>2021-10-10 10:00:00</td>
                        <td>1,000,000,000</td>
                    </tr>
                    <tr>
                        <td >PK1-01</td>
                        <td>Biệt thự</td>
                        <td>2021-10-10 10:00:00</td>
                        <td>1,000,000,000</td>
                    </tr>
                    <tr>
                        <td>PK1-01</td>
                        <td>Biệt thự</td>
                        <td>2021-10-10 10:00:00</td>
                        <td>1,000,000,000</td>
                    </tr>
                    <tr>
                        <td>Phân khu 2</td>
                        <td>PK1-01</td>
                        <td>Biệt thự</td>
                        <td>2021-10-10 10:00:00</td>
                        <td>1,000,000,000</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-center">Tổng tiền</td>
                        <td>4,000,000,000</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
