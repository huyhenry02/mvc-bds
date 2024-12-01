@foreach($users as $key => $val)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $val->full_name }}</td>
        <td>{{ $val->email }}</td>
        <td>{{ $val->phone_number }}</td>
        <td class="d-flex">
            <a href="#" class="btn btn-secondary btn-sm ms-1">
                <i class="fas fa-edit"></i>
            </a>
        </td>
    </tr>
@endforeach
