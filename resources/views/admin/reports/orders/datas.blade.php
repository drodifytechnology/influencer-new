@foreach ($orders as $order)
<tr>
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
</tr>

@endforeach
