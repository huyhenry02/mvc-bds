@php use App\Models\Transaction @endphp
@foreach( $transactions as $key => $transaction)
    <tr>
        <td>{{ $key + 1 }}</td>
        <td class="text-center">{{ $transaction->plot->zone->code ?? '' }}</td>
        <td>{{ $transaction->plot->zone->name ?? '' }}</td>
        <td>{{ $transaction->plot->name ?? '' }}</td>
        <td>{{ $transaction->plot->zone->project->name ?? '' }}</td>
        <td>{{ $transaction->created_at ?? '' }}</td>
        <td>{{ $transaction->user->full_name ?? '' }}</td>
        <td>{{ $transaction->user->phone_number ?? '' }}</td>
        <td>
            @switch( $transaction->status )
                @case( Transaction::STATUS_PENDING )
                    <span class="badge bg-warning">Chờ xác nhận</span>
                    @break
                @case( Transaction::STATUS_SUCCESS )
                    <span class="badge bg-success">Giao dịch thành công</span>
                    @break
                @case( Transaction::STATUS_REJECT )
                    <span class="badge bg-danger">Giao dịch thất bại</span>
                    @break
            @endswitch
        </td>
        <td class="text-center">
            <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#transactionModal"
                    data-id="{{ $transaction->id }}"
                    data-date="{{ $transaction->created_at }}"
                    data-price="{{ $transaction->plot->deposit ?? '' }}"
                    data-account_holder="{{ $transaction->plot->zone?->project?->account_holder }}"
                    data-account_number="{{ $transaction->plot->zone?->project?->account_number }}"
                    data-bank="{{ $transaction->plot->zone?->project?->bank }}"
                    data-project_name="{{ $transaction->plot->zone->project->name ?? '' }}"
                    data-zone_name="{{ $transaction->plot->zone->name ?? '' }}"
                    data-status="{{ $transaction->status }}"
                    data-notes="{{ $transaction->notes }}"
                    data-project_image="{{ $transaction->plot->zone->project->image_project ?? '' }}">
                <i class="fas fa-edit"></i>
            </button>
        </td>
    </tr>
@endforeach
