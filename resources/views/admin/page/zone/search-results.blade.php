@foreach($zones as $key => $zone)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $zone->code ?? '' }}</td>
        <td>{{ $zone->name ?? '' }}</td>
        <td>{{ $zone->project?->name ?? '' }}</td>
        <td class="text-center">
            <a href="{{ route('zone.showUpdate', $zone->id) }}"
               class="btn btn-sm btn-secondary">
                <i class="fas fa-edit"></i>
            </a>
            <button class="btn btn-sm btn-danger"
                    onclick="confirmDelete('{{ route('zone.delete', $zone->id) }}')">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    </tr>
@endforeach
