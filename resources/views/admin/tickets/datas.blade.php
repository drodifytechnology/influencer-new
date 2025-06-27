@foreach ($supports as $support)
    <tr>
        @can('supports-delete')
            <td class="w-60 checkbox">
                <label class="table-custom-checkbox">
                    <input type="checkbox" name="ids[]" class="table-hidden-checkbox checkbox-item"
                        value="{{ $support->id }}" data-url="{{ route('admin.supports.deleteAll') }}">
                    <span class="table-custom-checkmark custom-checkmark td"></span>
                </label>
            </td>
        @endcan

        <td>{{ $loop->iteration }}</td>
        <td>{{ \Carbon\Carbon::parse($support->created_at)->format('d/m/y') }}</td>
        <td>{{ $support->ticket_no }}</td>
        <td>{{ $support->user->name }}</td>
        <td>{{ $support->user->role }}</td>
        <td>{{ $support->subject }}</td>

        @if ($support->priority == 'high')
            <td class="text-danger">{{ __('High') }}</td>
        @elseif ($support->priority == 'medium')
            <td class="text-success">{{ __('Medium') }}</td>
        @elseif ($support->priority == 'low')
            <td class="text-primary">{{ __('Low') }}</td>
        @else
            <td>{{ __('null') }}</td>
        @endif
        <td>{{ $support->messages_count }}</td>

        @if ($support->status == 'progress')
            <td class="text-primary">{{ __('Progress') }}</td>
        @elseif ($support->status == 'closed')
            <td class="text-danger">{{ __('Closed') }}</td>
        @elseif($support->status == 'pending')
            <td class="text-success">{{ __('Pending') }}</td>
        @else
        <td>{{ __('null') }}</td>
        @endif
        <td>
            <div class="dropdown table-action">
                <button type="button" data-bs-toggle="dropdown">
                    <i class="far fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu">
                    @can('supports-read')
                        <li><a href="{{ route('admin.supports.show', $support->id) }}">
                                <i class="fal fa-eye"></i>
                                {{ __('View') }}
                            </a>
                        </li>
                    @endcan
                    @can('supports-update')
                        <li>
                            <a href="" class="reject-view-btn" data-bs-toggle="modal"
                                data-bs-target="#ticket-reject-modal">
                                <i class="fal fa-trash-alt"></i>
                                {{ __('Reject') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </div>
        </td>
    </tr>
@endforeach
