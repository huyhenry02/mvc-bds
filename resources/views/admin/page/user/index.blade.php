@extends('admin.layouts.main')
@section('content')
    <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
    >
        <div class="w-100">
            <h3 class="fw-bold mb-3">Danh sách Người dùng</h3>
            <div class="position-relative w-100">
                <label>
                    <input
                        type="text"
                        placeholder="Tìm kiếm"
                        class="form-control search-input w-100"
                        id="search-input"
                    />
                </label>
            </div>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-stats card-round">
                <table class="table table-bordered" id="user-table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col" width="10%">STT</th>
                        <th scope="col">Họ và Tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Số điện thoại</th>
                        <th class="text-center" scope="col" width="5%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $users as $key => $val)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $val->full_name }}</td>
                            <td>{{ $val->email }}</td>
                            <td>{{ $val->phone_number }}</td>
                            <td class="d-flex">
                                <a href="{{ route('user.showUpdate', $val->id) }}" class="btn btn-secondary btn-sm ms-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#search-input').on('keyup', function () {
                var query = $(this).val();

                $.ajax({
                    url: '{{ route('admin.searchUsers') }}',
                    method: 'GET',
                    data: { query: query },
                    success: function (response) {
                        $('#user-table tbody').html(response);
                    },
                    error: function (error) {
                        console.error('AJAX Error:', error);
                    }
                });
            });
        });
    </script>
@endsection
