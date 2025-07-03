@foreach ($orders as $order)
<tr>
    <td class="w-60 checkbox">
        <label class="table-custom-checkbox">
            <input type="checkbox" name="ids[]" class="table-hidden-checkbox checkbox-item"
               value="{{ $order->id}}"  data-url="{{ route('admin.orders.deleteAll') }}">
            <span class="table-custom-checkmark custom-checkmark td"></span>
        </label>
    </td>
    <td>{{ $loop->iteration}}</td>
    <td>{{ formatted_date($order->created_at) }}</td>
    <td>{{ $order->influencer->name }}</td>
    <td>{{ Str::limit($order->service->title, 25, '...') }}</td>
    <td>{{ currency_format($order->total_amount) }}</td>
    <td>{{ formatted_date($order->end_date) }}</td>

    @if ($order->payment_status == 'paid')
    <td class="text-success">{{ __('Paid') }}</td>
    @elseif($order->payment_status == 'unpaid')
    <td class="text-danger">{{ __('Unpaid') }}</td>
    @elseif($order->payment_status == 'rejected')
    <td class="text-danger">{{ __('Rejected') }}</td>
    @endif

    @if ($order->status == 'awaiting')
    <td class="text-primary">{{ __('Awaiting') }}</td>
    @elseif ($order->status == 'active')
    <td class="text-success">{{ __('Active') }}</td>
    @elseif ($order->status == 'canceled')
    <td class="text-warning">{{ __('Canceled') }}</td>
    @elseif ($order->status == 'complete')
    <td class="text-warning">{{ __('Completed') }}</td>
    @endif
    <td>
        <div class="dropdown table-action">
            <button type="button" data-bs-toggle="dropdown">
                <i class="far fa-ellipsis-v"></i>
            </button>
            <ul class="dropdown-menu">
                @can('orders-update')
                <li>
                    <a href="" data-url="{{ route('admin.orders.reject', $order->id) }}"  data-bs-toggle="modal" data-bs-target="#manage-order-reject-modal" class="manage-order-reject-modal-btn submit-btn">
                        <i class="fal fa-trash-alt"></i>
                        {{ __('Cancel') }}
                    </a>
                </li>
                @endcan
                @can('orders-update')
                <li>
                    <a href="" data-url="{{ route('admin.orders.paid', $order->id) }}"  data-bs-toggle="modal" data-bs-target="#manage-order-paid-modal" class="manage-order-paid-modal-btn submit-btn">
                        <i class="fas fa-money-bill"></i>
                        {{ __('Paid') }}
                    </a>
                </li>
                @endcan
                @can('orders-delete')
                <li>
                    <a href="{{ route('admin.orders.destroy', $order->id) }}" class="confirm-action"
                        data-method="DELETE">
                        <i class="fal fa-trash-alt"></i>
                        {{ __('Delete') }}
                    </a>
                </li>
            @endcan
            </ul>
        </div>
    </td>
</tr>

@endforeach
