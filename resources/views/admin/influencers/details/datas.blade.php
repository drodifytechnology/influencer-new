@foreach ($services as $service)
<tr>
    <td class="w-60 checkbox">
        <label class="table-custom-checkbox">
            <input type="checkbox" name="ids[]" class="table-hidden-checkbox checkbox-item"
               value=""  data-url="">
            <span class="table-custom-checkmark custom-checkmark td"></span>
        </label>
    </td>
    <td>{{ $loop->iteration }}</td>
    <td>{{ formatted_date($service->created_at) }}</td>
    <td>{{ $service->category->name }}</td>
    <td>{{ Str::limit($service->title, 25, '...') }}</td>
    <td>{{ currency_format($service->price) }}</td>

    @if ($service->status == 'pending')
    <td class="text-primary">{{ __('Pending') }}</td>
    @elseif ($service->status == 'active')
    <td class="text-success">{{ __('Active') }}</td>
    @elseif ($service->status == 'rejected')
    <td class="text-warning">{{ __('Rejected') }}</td>
    @elseif ($service->status == 'banned')
    <td class="text-danger">{{ __('Banned') }}</td>
    @endif
    <td>
        <div class="dropdown table-action">
            <button type="button" data-bs-toggle="dropdown">
                <i class="far fa-ellipsis-v"></i>
            </button>
            <ul class="dropdown-menu">
                @can('influencers-read')
                <li><a href="" class="influencer-service-view-btn" data-influencer-service-title="{{ $service->title }}" data-influencer-service-category="{{ $service->category->name }}" data-influencer-service-price="{{ $service->price }}" data-influencer-service-discount="{{ $service->discount }}" data-influencer-service-status="{{ $service->status }}" data-influencer-service-description="{{ $service->description }}"
                data-influencer-service-image="{{ asset($service['images'][0] ?? '') }}"
                data-influencer-service-features='@json($service['features'])' data-bs-toggle="modal" data-bs-target="#service-modal">
                <i class="fal fa-eye"></i>
                    {{ __('View') }}
                 </a>
                </li>
                @endcan

                @can('influencers-update')
                <li>
                    <a href="" type="submit" data-url="{{ route('admin.influencers.service-reject', $service->id)}}" class="influencer-service-reject submit-btn" data-bs-toggle="modal" data-bs-target="#service-reject-modal">
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

