@foreach ($services as $service)
<tr>
    <td class="w-60 checkbox">
        <label class="table-custom-checkbox">
            <input type="checkbox" name="ids[]" class="table-hidden-checkbox checkbox-item"
               value="{{ $service->id }}"  data-url="{{ route('admin.services.deleteAll') }}">
            <span class="table-custom-checkmark custom-checkmark td"></span>
        </label>
    </td>
    <td>{{ $loop->iteration }}</td>
    <td>{{ \Carbon\Carbon::parse($service->created_at)->format('d/m/y') }}</td>
    <td>{{$service->user->name}}</td>
    <td>{{$service->category->name}}</td>
    <td>{{Str::limit($service->title, 25, '...') }}</td>
    <td>{{ currency_format($service->price) }}({{ ($service->discount_type == 'percentage') ? $service->discount.'% off' : 'fixed' }})</td>
    <td>{{ $service->total_orders }}</td>
    <td>{{ $service->completed_orders }}</td>

    @if ($service->status == 'pending')
    <td class="text-warning">{{ __('Pending') }}</td>
    @elseif ($service->status == 'complete')
    <td class="text-success">{{ __('Completed') }}</td>
    @elseif ($service->status == 'active')
    <td class="text-success">{{ __('Active') }}</td>
    @elseif ($service->status == 'rejected')
    <td class="text-danger">{{ __('Rejected') 
        }}</td>
    @endif
    <td>
        <div class="dropdown table-action">
            <button type="button" data-bs-toggle="dropdown">
                <i class="far fa-ellipsis-v"></i>
            </button>
            <ul class="dropdown-menu">

                <li><a href="" class="service-view-btn" data-service-title="{{ $service->title }}" data-service-category="{{ $service->category->name }}" data-service-price="{{ $service->price }}" data-service-discount="{{ $service->discount }}" data-service-status="{{ $service->status }}" data-service-description="{{ $service->description }}" data-service-total-order="{{ $service->orders_count }}" data-service-completed-order="{{ $service->completed_orders }}"
                data-service-image="{{ asset($service['images'][0] ?? '') }}"
                data-service-features='@json($service['features'])' data-bs-toggle="modal" data-bs-target="#service-modal">
                        <i class="fal fa-eye"></i>
                        {{ __('View') }}
                    </a>
                </li>
                @can('services-update')
                <li>
                    <a href="" data-url="{{ route('admin.services.update', $service->id) }}" data-price="{{$service->admin_price}}" data-bs-toggle="modal" data-bs-target="#price-modal" class="price-update submit-btn">
                        <i class="fas fa-ban"></i>
                        Edit
                    </a>
                </li>
                <li>
                @if($service->status === 'pending' || $service->status === 'active')
                    <a href="" data-url="{{ route('admin.services.reject', $service->id) }}"  data-bs-toggle="modal" data-bs-target="#reject-modal" class="service-reject submit-btn">
                        <i class="fas fa-ban"></i>
                        {{ __('Reject') }}
                    </a>
                @else
                <a href="" data-url="{{ route('admin.services.reject', $service->id) }}"  data-bs-toggle="modal" data-bs-target="#reject-modal" class="service-reject submit-btn">
                    <i class="fas fa-check-circle"></i>
                    {{ __('Approved') }}
                </a>
                @endif

                </li>
                @endcan
            </ul>
        </div>
    </td>
</tr>

@endforeach
