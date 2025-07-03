@foreach ($orders as $order)
<tr>
    <td class="w-60 checkbox">
        <label class="table-custom-checkbox">
            <input type="checkbox" name="ids[]" class="table-hidden-checkbox checkbox-item"
               value=""  data-url="">
            <span class="table-custom-checkmark custom-checkmark td"></span>
        </label>
    </td>
    <td>{{ $loop->iteration}}</td>
    <td>#{{ $order->id }}</td>
    <td>{{ $order->service->user->name }}</td>
    <td>{{ Str::limit($order->service->title, 15 ,'...') }}</td>
    <td>{{ currency_format($order->total_amount) }}</td>
    <td>{{ formatted_date($order->end_date) }} - {{ $order->end_time }}</td>

    @if ($order->status == 'awaiting')
    <td class="text-primary">{{ __('Awaiting') }}</td>
    @elseif ($order->status == 'active')
    <td class="text-danger">{{ __('Active') }}</td>
    @elseif ($order->status == 'complete')
    <td class="text-warning">{{ __('Complete') }}</td>
    @elseif ($order->status == 'canceled')
    <td class="text-warning">{{ __('Canceled') }}</td>
    @endif
</tr>
@endforeach

