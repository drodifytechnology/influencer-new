@foreach ($income_reports as $income_report)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ formatted_date($income_report->created_at) }}</td>
    <td>{{ Str::limit($income_report->service->title, 25, '...') }}</td>
    <td>{{ $income_report->gateway->name ?? '' }}</td>
    <td>{{ currency_format($income_report->charge) }}</td>
    <td>{{ currency_format($income_report->amount) }}</td>

    @if ($income_report->payment_status == 'paid')
    <td class="text-success">{{ __('Paid') }}</td>
    @elseif($income_report->payment_status == 'unpaid')
    <td class="text-danger">{{ __('Unpaid') }}</td>
    @endif

    @if ($income_report->status == 'awaiting')
    <td class="text-primary">{{ __('Awaiting') }}</td>
    @elseif ($income_report->status == 'active')
    <td class="text-info">{{ __('Active') }}</td>
    @elseif ($income_report->status == 'rejected')
    <td class="text-danger">{{ __('Rejected') }}</td>
    @elseif ($income_report->status == 'canceled')
    <td class="text-danger">{{ __('Canceled') }}</td>
    @elseif ($income_report->status == 'complete')
    <td class="text-success">{{ __('Completed') }}</td>
    @endif
</tr>

@endforeach
