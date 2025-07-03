@foreach ($influencer_reports as $influencer_report)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ formatted_date($influencer_report->created_at) }}</td>
    <td>{{ $influencer_report->name }}</td>
    <td>{{ $influencer_report->email }}</td>
    <td>{{ $influencer_report->services_count }}</td>
    <td>{{ $influencer_report->orders_count }}</td>
    <td>{{ $influencer_report->completed_orders }}</td>
    <td>{{ currency_format($influencer_report->balance) }}</td>

    @if ($influencer_report->status == 'active')
    <td class="text-success">{{ __('Active') }}</td>
    @elseif($influencer_report->status == 'inactive')
    <td class="text-danger">{{ __('Inactive') }}</td>
    @endif
</tr>

@endforeach

