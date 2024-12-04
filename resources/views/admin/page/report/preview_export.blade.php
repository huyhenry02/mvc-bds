@extends('admin.layouts.main')
@section('content')
    <div class="text-center mb-4">
        <button class="btn btn-info"><i class="fas fa-download me-2"></i>Xuất PDF</button>
    </div>
    <div class="container pt-4" style="background-color: white">
        <div class="text-center mb-4">
            <h2 class="fw-bold">HLC Group</h2>
            <h4 class="text-uppercase">Báo cáo giao dịch đặt cọc theo dự án và phân khu</h4>
            <p>Thời gian: <strong>Từ ngày 20/11/2024</strong> đến <strong>20/11/2025</strong></p>
        </div>
        <div class="table-container" style="max-width: 90%; margin: auto;">
            <table class="table table-bordered text-center">
                <thead class="thead-light">
                <tr>
                    <th>Dự án</th>
                    <th>Phân khu</th>
                    <th>Mã khu đất</th>
                    <th>Tên khu đất</th>
                    <th>Thời gian giao dịch</th>
                    <th>Số tiền đặt cọc</th>
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
                    <td>PK1-02</td>
                    <td>Nhà phố</td>
                    <td>2021-10-11 11:00:00</td>
                    <td>1,500,000,000</td>
                </tr>
                <tr>
                    <td>PK1-03</td>
                    <td>Shophouse</td>
                    <td>2021-10-12 12:00:00</td>
                    <td>2,000,000,000</td>
                </tr>
                <tr>
                    <td>Phân khu 2</td>
                    <td>PK2-01</td>
                    <td>Chung cư</td>
                    <td>2021-10-13 13:00:00</td>
                    <td>1,000,000,000</td>
                </tr>
                <tr class="bg-secondary text-white">
                    <td colspan="5">Tổng tiền</td>
                    <td>5,500,000,000</td>
                </tr>
                <tr>
                    <td rowspan="4">Project 2</td>
                    <td rowspan="3">Phân khu 1</td>
                    <td>PK2-01</td>
                    <td>Biệt thự</td>
                    <td>2021-10-15 10:00:00</td>
                    <td>2,000,000,000</td>
                </tr>
                <tr>
                    <td>PK2-02</td>
                    <td>Nhà phố</td>
                    <td>2021-10-16 11:00:00</td>
                    <td>1,800,000,000</td>
                </tr>
                <tr>
                    <td>PK2-03</td>
                    <td>Shophouse</td>
                    <td>2021-10-17 12:00:00</td>
                    <td>2,500,000,000</td>
                </tr>
                <tr>
                    <td>Phân khu 2</td>
                    <td>PK2-04</td>
                    <td>Chung cư</td>
                    <td>2021-10-18 13:00:00</td>
                    <td>1,200,000,000</td>
                </tr>
                <tr class="bg-secondary text-white">
                    <td colspan="5">Tổng tiền</td>
                    <td>7,500,000,000</td>
                </tr>
                </tbody>
            </table>
            <div class="text-end mt-3">
                <p><strong>Tổng giao dịch:</strong> 13,000,000,000 VND</p>
            </div>
        </div>
    </div>
@endsection
