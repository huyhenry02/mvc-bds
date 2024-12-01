@php use App\Models\Plot; @endphp
@extends('admin.layouts.main')
@section('content')
    <div
        class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Danh sách Khu đất</h3>
            <div class="d-flex w-100">
                <input
                    type="text"
                    placeholder="Tìm kiếm"
                    class="form-control search-input w-100"
                    id="search-input"
                />
                <select class="form-control" id="project_id" name="project_id">
                    <option value="">-- Chọn dự án --</option>
                    @foreach( $projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>
                <select class="form-control" id="zone_id" name="zone_id">
                    <option value="">-- Chọn phân khu --</option>
                    @foreach( $zones as $zone)
                        <option value="{{ $zone->id }}">{{ $zone->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-stats card-round">
                <table class="table table-bordered" id="plot-table">
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
        $(document).ready(function () {
            $('#search-input, #project_id, #zone_id').on('change keyup', function () {
                var query = $('#search-input').val();
                var project_id = $('#project_id').val();
                var zone_id = $('#zone_id').val();

                $.ajax({
                    url: '{{ route('admin.searchPlots') }}',
                    method: 'GET',
                    data: { query: query, project_id: project_id, zone_id: zone_id },
                    success: function (response) {
                        $('#plot-table tbody').html(response);
                    },
                    error: function (error) {
                        console.error('AJAX Error:', error);
                    }
                });
            });
        });
    </script>
@endsection
