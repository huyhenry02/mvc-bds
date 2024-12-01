@php use App\Models\Project; @endphp
@extends('admin.layouts.main')
@section('content')
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
        <div>
            <h3 class="fw-bold mb-3">Danh sách Dự án</h3>
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
                <table class="table table-bordered" id="project-table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col" width="10%">STT</th>
                        <th scope="col">Tên dự án</th>
                        <th scope="col">Số lượng phân khu</th>
                        <th scope="col">Trạng thái</th>
                        <th class="text-center" scope="col" width="10%">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $projects as $key => $project)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->zones()->count() }}</td>
                            <td>
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
            $('#search-input').on('keyup', function () {
                var query = $(this).val();

                $.ajax({
                    url: '{{ route('admin.searchProjects') }}',
                    method: 'GET',
                    data: { query: query },
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
