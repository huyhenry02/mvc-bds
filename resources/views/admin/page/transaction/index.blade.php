@php use App\Models\Transaction @endphp
@extends('admin.layouts.main')
@section('content')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Danh sách Giao dịch</h3>
            <div class="d-flex">
                <select class="form-control" id="search_status" name="status">
                    <option value="">-- Chọn Tình trạng --</option>
                    <option value="pending">Chờ xác nhận</option>
                    <option value="success">Giao dịch thành công</option>
                    <option value="reject">Giao dịch thất bại</option>

                </select>
            </div>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-stats card-round">
                <table class="table table-bordered" id="transaction-table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col" width="5%">STT</th>
                        <th scope="col">Mã phân khu</th>
                        <th scope="col">Phân khu</th>
                        <th scope="col">Tên khu đất</th>
                        <th scope="col">Dự án</th>
                        <th scope="col">Thời gian giao dịch</th>
                        <th scope="col">Tên người dùng</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Tình trạng</th>
                        <th class="text-center" scope="col" width="10%">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $transactions as $key => $transaction)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td class="text-center">{{ $transaction->plot->zone->code ?? '' }}</td>
                            <td>{{ $transaction->plot->zone->name ?? '' }}</td>
                            <td>{{ $transaction->plot->name ?? '' }}</td>
                            <td>{{ $transaction->plot->zone->project->name ?? '' }}</td>
                            <td>{{ $transaction->created_at ?? '' }}</td>
                            <td>{{ $transaction->user->full_name ?? '' }}</td>
                            <td>{{ $transaction->user->phone_number ?? '' }}</td>
                            <td>
                                @switch( $transaction->status )
                                    @case( Transaction::STATUS_PENDING )
                                        <span class="badge bg-warning">Chờ xác nhận</span>
                                        @break
                                    @case( Transaction::STATUS_SUCCESS )
                                        <span class="badge bg-success">Giao dịch thành công</span>
                                        @break
                                    @case( Transaction::STATUS_REJECT )
                                        <span class="badge bg-danger">Giao dịch thất bại</span>
                                        @break
                                @endswitch
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#transactionModal"
                                        data-id="{{ $transaction->id }}"
                                        data-date="{{ $transaction->created_at }}"
                                        data-price="{{ $transaction->plot->deposit ?? '' }}"
                                        data-account_holder="{{ $transaction->plot->zone?->project?->account_holder }}"
                                        data-account_number="{{ $transaction->plot->zone?->project?->account_number }}"
                                        data-bank="{{ $transaction->plot->zone?->project?->bank }}"
                                        data-project_name="{{ $transaction->plot->zone->project->name ?? '' }}"
                                        data-zone_name="{{ $transaction->plot->zone->name ?? '' }}"
                                        data-status="{{ $transaction->status }}"
                                        data-notes="{{ $transaction->notes }}"
                                        data-project_image="{{ $transaction->plot->zone->project->image_project ?? '' }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transactionModalLabel">Chi tiết giao dịch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <img id="project_image" src="" alt="Project Image" class="img-fluid">
                            <form action="{{ route('transaction.updateStatus') }}" method="post">
                                @csrf
                                <input type="hidden" id="id" name="transaction_id" value="">
                                <div class="form-group">
                                    <div class="input-group">
                                        <textarea class="form-control" id="notes" rows="3" name="notes" placeholder="Nhập ghi chú"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <select class="form-control" name="status">
                                            <option value="" id="status" selected></option>
                                            <option value="{{ Transaction::STATUS_PENDING }}">Chờ xác nhận</option>
                                            <option value="{{ Transaction::STATUS_SUCCESS }}">Giao dịch thành công</option>
                                            <option value="{{ Transaction::STATUS_REJECT }}">Giao dịch thất bại</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary w-50" data-bs-dismiss="modal">Lưu</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Thời gian giao dịch</th>
                                    <td id="date"></td>
                                </tr>
                                <tr>
                                    <th>Giá đặt cọc</th>
                                    <td id="price"></td>
                                </tr>
                                <tr>
                                    <th>Tên người nhận</th>
                                    <td id="account_holder"></td>
                                </tr>
                                <tr>
                                    <th>Số tài khoản</th>
                                    <td id="account_number"></td>
                                </tr>
                                <tr>
                                    <th>Ngân hàng</th>
                                    <td id="bank"></td>
                                </tr>
                                <tr>
                                    <th>Dự án</th>
                                    <td id="project_name"></td>
                                </tr>
                                <tr>
                                    <th>Phân khu</th>
                                    <td id="zone_name"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const transactionModal = document.getElementById('transactionModal');
        transactionModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const date = button.getAttribute('data-date');
            const price = button.getAttribute('data-price');
            const account_holder = button.getAttribute('data-account_holder');
            const account_number = button.getAttribute('data-account_number');
            const bank = button.getAttribute('data-bank');
            const project_name = button.getAttribute('data-project_name');
            const zone_name = button.getAttribute('data-zone_name');
            const status = button.getAttribute('data-status');
            const notes = button.getAttribute('data-notes');
            const project_image = button.getAttribute('data-project_image');

            const priceFormatted = new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(price);
            document.getElementById('id').value = id;
            document.getElementById('date').textContent = date;
            document.getElementById('price').textContent = priceFormatted;
            document.getElementById('account_holder').textContent = account_holder;
            document.getElementById('account_number').textContent = account_number;
            document.getElementById('bank').textContent = bank;
            document.getElementById('project_name').textContent = project_name;
            document.getElementById('zone_name').textContent = zone_name;
            document.getElementById('notes').textContent = notes;
            document.getElementById('project_image').src = project_image;

            const statusSelect = document.getElementById('status');
            statusSelect.value = status;
            document.getElementById('status').innerHTML = getStatusText(status);
        });
        function getStatusText(status) {
            switch (status) {
                case '{{ Transaction::STATUS_PENDING }}':
                    return 'Chờ xác nhận';
                case '{{ Transaction::STATUS_SUCCESS }}':
                    return 'Giao dịch thành công';
                case '{{ Transaction::STATUS_REJECT }}':
                    return 'Giao dịch thất bại';
                default:
                    return 'Unknown';
            }
        }
        $(document).ready(function () {
            $('#search_status').on('change keyup', function () {
                var search_status = $('#search_status').val();

                $.ajax({
                    url: '{{ route('admin.searchTransactions') }}',
                    method: 'GET',
                    data: { status: search_status },
                    success: function (response) {
                        $('#transaction-table tbody').html(response);
                    },
                    error: function (error) {
                        console.error('AJAX Error:', error);
                    }
                });
            });
        });
    </script>
    <style>
        #transaction-table {
            width: 100%;
            table-layout: fixed;
            overflow-x: auto;
            display: block;
        }

        #transaction-table th, #project-table td {
            white-space: nowrap;
        }

        #transaction-table th:last-child,
        #transaction-table td:last-child {
            position: sticky;
            right: 0;
            background-color: #fff;
            z-index: 1;
        }
    </style>
@endsection
