@foreach($investors as $key => $investor)
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
