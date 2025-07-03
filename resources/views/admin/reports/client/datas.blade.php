@foreach ($client_reports as $client_report)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ formatted_date($client_report->created_at) }}</td>
    <td>{{ $client_report->name }}</td>
    <td>{{ $client_report->email }}</td>
    <td>{{ $client_report->country }}</td>
    <td>{{ $client_report->orders_count }}</td>

    @if ($client_report->status == 'pending')
    <td class="text-success">{{ __('Pending') }}</td>
    @elseif($client_report->status == 'inactive')
    <td class="text-danger">{{ __('Inactive') }}</td>
    @endif
</tr>

@endforeach
