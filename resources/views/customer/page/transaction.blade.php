@php use App\Models\Transaction; @endphp
@extends('customer.layouts.main')
@section('content')
    <section class="hero-wrap hero-wrap-2 ftco-degree-bg js-fullheight"
             style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="overlay-2"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate pb-5 mb-5 text-center">
                    <h1 class="mb-3 bread">Giao dịch của bạn</h1>
                    <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('customer.showIndex') }}">Trang chủ <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span>Giao dịch</span></p>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section">
        <div class="container">
            <div class="row block-9 justify-content-center mb-5">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên khu đất</th>
                            <th>Giá đặt cọc (VND)</th>
                            <th>Trạng thái</th>
                            <th width="10%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $transactions as $key => $transaction)
                            <tr>
                                <th>{{ $key + 1 }}</th>
                                <td>{{ $transaction->plot?->name ?? '' }}</td>
                                <td>{{ number_format($transaction->plot->deposit) ?? '' }}</td>
                                <td>
                                    @switch( $transaction->status )
                                        @case( Transaction::STATUS_PENDING )
                                            <span class="text-warning">Chờ xác nhận</span>
                                            @break
                                        @case( Transaction::STATUS_REJECT )
                                            <span class="text-danger">Từ chối</span>
                                            @break
                                        @case( Transaction::STATUS_SUCCESS )
                                            <span class="text-success">Thành công</span>
                                            @break
                                    @endswitch
                                </td>
                                <td class="text-center">
                                    <button
                                        type="button"
                                        class="btn btn-secondary w-50 ml-2 view-details"
                                        data-bs-toggle="modal"
                                        data-project_name="{{ $transaction->plot->zone?->project?->name }}"
                                        data-project_image="{{ $transaction->plot->main_image ?? '' }}"
                                        data-zone_name="{{ $transaction->plot->zone?->name }}"
                                        data-date="{{ $transaction->transaction_date }}"
                                        data-account_holder="{{ $transaction->plot->zone?->project?->account_holder }}"
                                        data-account_number="{{ $transaction->plot->zone?->project?->account_number }}"
                                        data-status="{{ $transaction->status }}"
                                        data-bank="{{ $transaction->plot->zone?->project?->bank }}"
                                        data-deposit="{{ $transaction->plot->deposit }}"
                                        data-bs-target="#detailModal">
                                        <i class="ion-ios-eye"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Chi tiết đặt cọc</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6">
                                <img id="transaction-project_image" src="" alt="main_image" class="img-fluid">
                                <div class="mt-1 text-start">
                                    <p><strong>Giá đặt cọc:</strong> <span id="transaction-deposit"></span></p>
                                    <p style="margin-top: -15px"><strong>Dự án:</strong> <span
                                            id="transaction-project_name"></span></p>
                                    <p style="margin-top: -15px"><strong>Phân khu:</strong> <span
                                            id="transaction-zone_name"></span></p>
                                </div>
                            </div>
                            <div class="col-6">
                                <p><strong>Chuyển cọc vào lúc:</strong> <span id="transaction-date"></span></p>
                                <p><strong>Chủ tài khoản:</strong> <span id="transaction-account_holder"></span></p>
                                <p><strong>Số tài khoản:</strong> <span id="transaction-account_number"></span></p>
                                <p><strong>Ngân hàng:</strong> <span id="transaction-bank"></span></p>
                                <p><strong>Trạng thái:</strong> <span id="transaction-status"></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.view-details').forEach(button => {
            button.addEventListener('click', function () {
                const project_name = this.getAttribute('data-project_name');
                const project_image = this.getAttribute('data-project_image');
                const zone_name = this.getAttribute('data-zone_name');
                const date = this.getAttribute('data-date');
                const account_holder = this.getAttribute('data-account_holder');
                const account_number = this.getAttribute('data-account_number');
                const status = this.getAttribute('data-status');
                const bank = this.getAttribute('data-bank');
                const deposit = this.getAttribute('data-deposit');

                const depositFormatted = new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(deposit);
                document.getElementById('transaction-project_name').textContent = project_name;
                document.getElementById('transaction-project_image').src = project_image;
                document.getElementById('transaction-zone_name').textContent = zone_name;
                document.getElementById('transaction-date').textContent = date;
                document.getElementById('transaction-account_holder').textContent = account_holder;
                document.getElementById('transaction-account_number').textContent = account_number;
                document.getElementById('transaction-status').textContent = status;
                document.getElementById('transaction-bank').textContent = bank;
                document.getElementById('transaction-deposit').textContent = depositFormatted;

                const statusElement = document.getElementById('transaction-status');
                let statusHTML = '';
                switch (status) {
                    case "{{ Transaction::STATUS_PENDING }}":
                        statusHTML = '<span class="text-warning">Chờ xác nhận</span>';
                        break;
                    case "{{ Transaction::STATUS_REJECT }}":
                        statusHTML = '<span class="text-danger">Từ chối</span>';
                        break;
                    case "{{ Transaction::STATUS_SUCCESS }}":
                        statusHTML = '<span class="text-success">Thành công</span>';
                        break;
                    default:
                        statusHTML = '<span class="text-muted">Không xác định</span>';
                        break;
                }
                statusElement.innerHTML = statusHTML;
            });
        });
    </script>
@endsection
