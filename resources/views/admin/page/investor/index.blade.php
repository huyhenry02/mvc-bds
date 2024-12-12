@extends('admin.layouts.main')
@section('content')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Danh sách Nhà đầu tư</h3>
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
                <table class="table table-bordered" id="investor-table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col" width="10%">STT</th>
                        <th scope="col">Họ và Tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Mô tả</th>
                        <th class="text-center" scope="col" width="10%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $investors as $key => $investor )
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $investor->full_name }}</td>
                            <td>{{ $investor->email }}</td>
                            <td>{{ $investor->phone_number }}</td>
                            <td>{{ $investor->description }}</td>
                            <td class="text-center">
                                <a href="{{ route('investor.showUpdate', $investor->id) }}"
                                   class="btn btn-sm btn-secondary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('investor.delete', $investor->id) }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(url) {
            if (confirm('Bạn có chắc chắn muốn xóa nhà đầu tư này không?')) {
                window.location.href = url;
            }
        }

        $(document).ready(function () {
            $('#search-input').on('keyup', function () {
                var query = $(this).val();

                $.ajax({
                    url: '{{ route('admin.searchInvestors') }}',
                    method: 'GET',
                    data: { query: query },
                    success: function (response) {
                        $('#investor-table tbody').html(response);
                    },
                    error: function (error) {
                        console.error('AJAX Error:', error);
                    }
                });
            });
        });
    </script>

@endsection
