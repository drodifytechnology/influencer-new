@foreach ($clients as $client)
    <tr>
        <td class="w-60 checkbox">
            <label class="table-custom-checkbox">
                <input type="checkbox" name="ids[]" class="table-hidden-checkbox checkbox-item"
                    value="{{ $client->id }}" data-url="{{ route('admin.clients.deleteAll') }}">
                <span class="table-custom-checkmark custom-checkmark td"></span>
            </label>
        </td>
        <td>{{ $loop->iteration }}</td>
        <td>{{ \Carbon\Carbon::parse($client->created_at)->format('d M Y') }}</td>
        <td>{{ $client->name }}</td>
        <td>{{ $client->email }}</td>
        <td>{{ $client->country }}</td>
        <td>{{ $client->completed_orders }}</td>

        @if ($client->status == 'pending')
            <td class="text-primary">{{ __('Pending') }}</td>
        @elseif ($client->status == 'active')
            <td class="text-success">{{ __('Active') }}</td>
        @elseif ($client->status == 'rejected')
            <td class="text-warning">{{ __('Rejected') }}</td>
        @elseif ($client->status == 'approved')
            <td class="text-success">{{ __('Approved') }}</td>
        @elseif ($client->status == 'banned')
            <td class="text-danger">{{ __('Banned') }}</td>
        @endif

        <td>
            <div class="dropdown table-action">
                <button type="button" data-bs-toggle="dropdown">
                    <i class="far fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu">
                    @can('clients-read')
                        <li><a href="{{ route('admin.clients.show', $client->id) }}" class="">
                                <i class="fal fa-eye"></i>
                                {{ __('View') }}
                            </a>
                        </li>
                    @endcan

                    @can('clients-create')
                        <li>
                            <a href="" data-url="{{ route('admin.clients.send-email') }}"
                                data-client-email="{{ $client->email }}" data-bs-target="#client-send-email-modal"
                                data-bs-toggle="modal" class="client-send-email">
                                <i class="fal fa-envelope"></i>
                                {{ __('Send Email') }}
                            </a>
                        </li>
                    @endcan
                    @if ($client->status == 'approved')
                        @can('clients-update')
                            <li>
                                <a href="" data-url="{{ route('admin.clients.banned', $client->id) }}"
                                    data-bs-target="#client-banned-modal" data-bs-toggle="modal" class="client-banned">
                                    <i class="fas fa-ban"></i>
                                    {{ __('Banned') }}
                                </a>
                            </li>
                        @endcan
                    @elseif($client->status == 'banned' || $client->status == 'pending')
                        @can('clients-update')
                            <li>
                                <a href="" data-url="{{ route('admin.clients.approved', $client->id) }}"
                                    data-bs-target="#client-approved-modal" data-bs-toggle="modal" class="client-approve">
                                    <i class="fas fa-check"></i>
                                    {{ __('approve') }}
                                </a>
                            </li>
                        @endcan
                    @endif

                    @can('clients-delete')
                        <li>
                            <a href="{{ route('admin.clients.destroy', $client->id) }}" class="confirm-action"
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

@push('modal')
    @include('admin.clients.details.email')
    @include('admin.clients.details.banned')
    @include('admin.clients.details.approved')
@endpush
