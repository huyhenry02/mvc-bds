@php use App\Models\Project; @endphp
@foreach($projects as $key => $project)
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
