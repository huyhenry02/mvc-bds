@php use App\Models\Plot; @endphp
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
