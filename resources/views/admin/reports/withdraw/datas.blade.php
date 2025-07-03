@foreach ($withdraws as $withdraw)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ formatted_date($withdraw->created_at) }}</td>
    <td class="text-primary">{{ $withdraw->user->name }}</td>
    <td>{{ $withdraw->withdraw_method->name }}</td>
    <td>{{ currency_format($withdraw->amount) }}</td>
    <td>{{ currency_format($withdraw->charge) }}</td>
    <td>{{ currency_format($withdraw->amount - $withdraw->charge) }}</td>
    @if ($withdraw->status == 'approve')
    <td class="text-success">{{ __('Success') }}</td>
    @elseif($withdraw->status == 'pending')
    <td class="text-danger">{{ __('Pending') }}</td>
    @elseif($withdraw->status == 'rejected')
    <td class="text-danger">{{ __('Rejected') }}</td>
    @endif
</tr>
@endforeach
