@foreach ($influencers as $influencer)
    <tr>
        @can('influencers-delete')
        <td class="w-60 checkbox">
            <label class="table-custom-checkbox">
                <input type="checkbox" name="ids[]" class="table-hidden-checkbox checkbox-item"
                value="{{ $influencer->id }}"  data-url="{{ route('admin.influencers.deleteAll') }}">
                <span class="table-custom-checkmark custom-checkmark td"></span>
            </label>
        </td>
        @endcan

        <td>{{ $loop->iteration }}</td>
        <td>{{ \Carbon\Carbon::parse($influencer->created_at)->format('d M Y') }}</td>
        <td>{{ $influencer->name }}</td>
        <td>{{ $influencer->email }}</td>
        <td>{{ $influencer->services_count }}</td>
        <td>{{ $influencer->orders_count }}</td>
        <td>{{ $influencer->completed_orders }}</td>
        <td>{{ currency_format($influencer->balance) }}</td>

        @if ($influencer->status == 'pending')
            <td class="text-primary">{{ __('Pending') }}</td>
        @elseif ($influencer->status == 'active')
            <td class="text-success">{{ __('Active') }}</td>
        @elseif ($influencer->status == 'rejected')
            <td class="text-warning">{{ __('Rejected') }}</td>
            @elseif ($influencer->status == 'approved')
            <td class="text-success">{{ __('Approved') }}</td>
        @elseif ($influencer->status == 'banned')
            <td class="text-danger">{{ __('Banned') }}</td>
        @endif
        <td>
            <div class="dropdown table-action">
                <button type="button" data-bs-toggle="dropdown">
                    <i class="far fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('admin.influencers.show', $influencer->id) }}" class="">
                            <i class="fal fa-eye"></i>
                            {{ __('View') }}
                        </a>
                    </li>

                    @if ($influencer->status == 'approved')
                        @can('influencers-update')
                            <li>
                                <a href="" data-url="{{ route('admin.influencers.banned', $influencer->id) }}"
                                    data-bs-target="#influencer-banned-modal" data-bs-toggle="modal" class="influencer-banned">
                                    <i class="fas fa-ban"></i>
                                    {{ __('Banned') }}
                                </a>
                            </li>
                        @endcan
                    @elseif($influencer->status == 'banned' || $influencer->status == 'pending')
                        @can('influencers-update')
                            <li>
                                <a href="" data-url="{{ route('admin.influencers.approve', $influencer->id) }}"
                                    data-bs-target="#influencer-approve-modal" data-bs-toggle="modal" class="influencer-approve">
                                    <i class="fas fa-check"></i>
                                    {{ __('approve') }}
                                </a>
                            </li>
                        @endcan
                    @endif

                    @can('influencers-create')
                    <li>
                        <a href="" data-url="{{ route('admin.influencers.send-email') }}"
                            data-influencer-email="{{ $influencer->email }}"
                            data-bs-target="#influencer-send-email-modal" data-bs-toggle="modal"
                            class="influencer-send-email">
                            <i class="fal fa-envelope"></i>
                            {{ __('Send Email') }}
                        </a>
                    </li>

                    @can('influencers-delete')
                    <li>
                        <a href="{{ route('admin.influencers.destroy', $influencer->id) }}" class="confirm-action"
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
    @include('admin.influencers.details.email')
@endpush
