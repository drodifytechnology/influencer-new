@foreach ($refunds as $refund)
<tr>
    <td>{{ $loop->iteration}}</td>
    <td>{{ formatted_date($refund->created_at) }}</td>
    <td>{{ $refund->order->user->name }}</td>
    <td>{{ Str::limit($refund->order->service->title, 25, '...') }}</td>
    <td>{{ $refund->meta['admin_reject_reason'] ?? '' }}</td>
    <td>{{ $refund->reason }}</td>

    @if ($refund->status == 'pending')
    <td class="text-warning">{{ __('Pending') }}</td>
    @elseif ($refund->status == 'approve')
    <td class="text-success">{{ __('Approve') }}</td>
    @elseif ($refund->status == 'rejected')
    <td class="text-danger">{{ __('Rejected') }}</td>
    @endif
    <td>
        <div class="dropdown table-action">
            <button type="button" data-bs-toggle="dropdown">
                <i class="far fa-ellipsis-v"></i>
            </button>
            <ul class="dropdown-menu">
                @can('refunds-update')
                <li>
                    <a href="" data-url="{{ route('admin.refunds.approve', $refund->id) }}"  data-bs-toggle="modal" data-bs-target="#refunds-approve-modal" class="refunds-approve submit-btn">
                        <i class="fas fa-check-square"></i>
                        {{ __('Approve') }}
                    </a>
                </li>
                @endcan
                @can('refunds-update')
                <li>
                    <a href="" data-url="{{ route('admin.refunds.reject', $refund->id) }}"  data-bs-toggle="modal" data-bs-target="#refunds-reject-modal" class="refunds-reject submit-btn">
                        <i class="fas fa-ban"></i>
                        {{ __('Reject') }}
                    </a>
                </li>
                @endcan
            </ul>
        </div>
    </td>
</tr>
@endforeach
