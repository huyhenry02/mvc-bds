@php use App\Models\Plot; @endphp
@extends('admin.layouts.main')
@section('content')
    <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4"
    >
        <div>
            <h3 class="fw-bold mb-3">Danh sách Khu đất</h3>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-stats card-round">
                <table class="table table-bordered">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col" width="10%">STT</th>
                        <th scope="col">Tên phân khu</th>
                        <th scope="col">Khu đất</th>
                        <th scope="col">Dự án</th>
                        <th scope="col">Tình trạng</th>
                        <th class="text-center" scope="col" width="10%">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $plots as $key => $plot)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $plot->name ?? '' }}</td>
                            <td>{{ $plot->zone?->name ?? '' }}</td>
                            <td>{{ $plot->zone?->project?->name ?? '' }}</td>
                            <td>
                                @switch( $plot->status )
                                    @case( Plot::STATUS_DEPOSITED )
                                        <span class="badge bg-success">Đã đặt cọc</span>
                                        @break
                                    @case( Plot::STATUS_EMPTY )
                                        <span class="badge bg-primary">Trống</span>
                                        @break
                                    @case( Plot::STATUS_SOLD )
                                        <span class="badge bg-warning">Đã bán</span>
                                        @break
                                @endswitch
                            </td>
                            <td class="text-center">
                                <a href="{{ route('plot.showUpdate', $plot->id) }}"
                                   class="btn btn-sm btn-secondary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-sm btn-danger"
                                        onclick="confirmDelete('{{ route('plot.delete', $plot->id) }}')">
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
            if (confirm('Bạn có chắc chắn muốn xóa khu đất này không?')) {
                window.location.href = url;
            }
        }
    </script>
@endsection
