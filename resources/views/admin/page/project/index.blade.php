@php use App\Models\Project; @endphp
@extends('admin.layouts.main')
@section('content')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Danh sách Dự án</h3>
            <div class="d-flex w-100">
                <label>
                    <input
                        type="text"
                        placeholder="Tìm kiếm"
                        class="form-control search-input"
                        id="search-input"
                    />
                </label>
                <select class="form-control w-50" id="status" name="status">
                    <option value="">-- Chọn trạng thái --</option>
                        <option value="{{ Project::STATUS_ON_SALE }}">Đang bán</option>
                        <option value="{{ Project::STATUS_COMPLETED }}">Hoàn thành</option>
                        <option value="{{ Project::STATUS_UPCOMING }}">Sắp diễn ra</option>
                </select>
            </div>
        </div>
        <div class="ms-md-auto py-2 py-md-0">
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-stats card-round">
                <table class="table table-bordered" id="project-table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col" width="10%">STT</th>
                        <th scope="col">Tên dự án</th>
                        <th scope="col" width="15%" class="text-center">Số lượng phân khu</th>
                        <th scope="col">Nhà đầu tư</th>
                        <th scope="col" width="10%">Trạng thái</th>
                        <th class="text-center" scope="col" width="10%">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $projects as $key => $project)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $project->name }}</td>
                            <td class="text-center">{{ $project->zones()->count() }}</td>
                            <td>
                                @foreach( $project->investors as $investor)
                                    - {{ $investor->full_name }} <br/>
                                @endforeach
                            </td>
                            <td class="text-center">
                                @switch( $project->status )
                                    @case( Project::STATUS_ON_SALE )
                                        <span class="badge bg-success">Đang bán</span>
                                        @break
                                    @case( Project::STATUS_COMPLETED )
                                        <span class="badge bg-primary">Hoàn thành</span>
                                        @break
                                    @case( Project::STATUS_UPCOMING )
                                        <span class="badge bg-warning">Sắp mở bán</span>
                                        @break
                                @endswitch
                            </td>
                            <td class="text-center">
                                <a href="{{ route('project.showUpdate', $project->id) }}"
                                   class="btn btn-sm btn-secondary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-sm btn-danger"
                                        onclick="confirmDelete('{{ route('project.delete', $project->id) }}')">
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
            if (confirm('Bạn có chắc chắn muốn xóa dự án này không?')) {
                window.location.href = url;
            }
        }

        $(document).ready(function () {
            $('#search-input, #status').on('change keyup', function () {
                var query = $('#search-input').val();
                var status = $('#status').val();
                $.ajax({
                    url: '{{ route('admin.searchProjects') }}',
                    method: 'GET',
                    data: { query: query, status: status },
                    success: function (response) {
                        $('#project-table tbody').html(response);
                    },
                    error: function (error) {
                        console.error('AJAX Error:', error);
                    }
                });
            });
        });
    </script>
@endsection
